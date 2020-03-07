<?php

namespace PhpLab\Sandbox\Proto\Libs;

use PhpBundle\Crypt\Domain\Libs\Encoders\EncoderInterface;
use PhpLab\Core\Domain\Helpers\EntityHelper;
use PhpLab\Core\Enums\Http\HttpMethodEnum;
use PhpLab\Core\Enums\Http\HttpServerEnum;
use PhpLab\Core\Legacy\Yii\Helpers\ArrayHelper;
use PhpLab\Sandbox\Proto\Entities\RequestEntity;
use Symfony\Component\HttpFoundation\Response;

class RestProto
{

    const CRYPT_SERVER_NAME = 'HTTP_X_CRYPT';
    const CRYPT_HEADER_NAME = 'X-Crypt';
    const CRYPT_CONTENT_TYPE = 'application/x-base64';

    private $encoderInstance;
    private $originalServer;

    public function __construct(EncoderInterface $encoder, array $server)
    {
        $this->encoderInstance = $encoder;
        $this->originalServer = $server;
    }

    public function encodeResponse(Response $response): Response
    {
        if ( ! $this->isCryptRequest()) {
            return $response;
        }
        $headers = [];
        $encodedResponse = new Response;
        foreach ($response->headers->all() as $headerKey => $headerValue) {
            $headers[$headerKey] = ArrayHelper::first($headerValue);
        }
        $payload = [
            'statusCode' => $response->getStatusCode(),
            'headers' => $headers,
            'content' => $response->getContent(),
        ];
        $encodedContent = $this->encoderInstance->encode($payload);
        $encodedResponse->headers->set(self::CRYPT_HEADER_NAME, 1);
        $encodedResponse->setContent($encodedContent);
        return $encodedResponse;
    }

    public function prepareRequest()
    {
        global $_POST;
        if ( ! $this->isCryptRequest()) {
            return;
        }
        $requestEntity = $this->decodeRequest($_POST['data']);
        $this->applyToEnv($requestEntity);
    }

    private function isCryptRequest(): bool
    {
        $isPostMethod = strtolower($this->originalServer[HttpServerEnum::REQUEST_METHOD]) == 'post';
        $isCryptRequest = $isPostMethod && ! empty($this->originalServer[self::CRYPT_SERVER_NAME]);
        return $isCryptRequest;
    }

    private function decodeRequest(string $encodedData): RequestEntity
    {
        $payload = $this->encoderInstance->decode($encodedData);
        $requestEntity = new RequestEntity;
        EntityHelper::setAttributes($requestEntity, $payload);

        /*$uri = new Uri($payload['uri']);
        $request = new Request($payload['method'], $uri, $payload['headers']);*/
        return $requestEntity;
    }

    private function applyToEnv(RequestEntity $requestEntity)
    {
        global $_SERVER, $_GET, $_POST, $_FILES;
        $server = $this->forgeServer($requestEntity);
        $_SERVER = array_merge($_SERVER, $server);
        $_GET = $requestEntity->getQuery() ?? [];
        $_POST = $requestEntity->getBody() ?? [];
    }

    private function forgeServer(RequestEntity $requestEntity): array
    {
        $server = [];
        if ($requestEntity->getHeaders()) {
            foreach ($requestEntity->getHeaders() as $headerKey => $headerValue) {
                $headerKey = strtoupper($headerKey);
                $headerKey = str_replace('-', '_', $headerKey);
                $headerKey = 'HTTP_' . $headerKey;
                $server[$headerKey] = $headerValue;
            }
        }
        $server[HttpServerEnum::REQUEST_METHOD] = HttpMethodEnum::value($requestEntity->getMethod(), HttpMethodEnum::GET);
        $server[HttpServerEnum::REQUEST_URI] = $requestEntity->getUri();
        return $server;
    }

}
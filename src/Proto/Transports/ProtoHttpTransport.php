<?php

namespace PhpLab\Sandbox\Proto\Transports;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use PhpLab\Core\Enums\Http\HttpMethodEnum;
use PhpLab\Sandbox\Proto\Interfaces\TransportInterface;
use PhpLab\Sandbox\Proto\Libs\RestProto;

class ProtoHttpTransport implements TransportInterface
{

    private $endpoint;

    public function __construct(string $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function sendRequest($encodedRequest)
    {
        $client = new Client;
        $options = $this->getRequestOptions($encodedRequest);
        $response = $client->request(HttpMethodEnum::POST, $this->endpoint, $options);
        $encodedContent = $response->getBody()->getContents();
        return $encodedContent;
    }

    private function getRequestOptions($encodedRequest)
    {
        return [
            RequestOptions::HEADERS => [
                RestProto::CRYPT_HEADER_NAME => 1,
            ],
            RequestOptions::FORM_PARAMS => [
                'data' => $encodedRequest,
            ],
        ];
    }

}
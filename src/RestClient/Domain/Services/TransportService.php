<?php

namespace PhpLab\Sandbox\RestClient\Domain\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use PhpLab\Core\Domain\Base\BaseService;
use PhpLab\Core\Domain\Helpers\EntityHelper;
use PhpLab\Core\Domain\Libs\Query;
use PhpLab\Core\Exceptions\NotFoundException;
use PhpLab\Sandbox\RestClient\Domain\Entities\ProjectEntity;
use PhpLab\Sandbox\RestClient\Domain\Interfaces\Services\AuthorizationServiceInterface;
use PhpLab\Sandbox\RestClient\Domain\Interfaces\Services\TransportServiceInterface;
use PhpLab\Test\Libs\AuthAgent;
use PhpLab\Test\Libs\RestClient;
use Psr\Http\Message\ResponseInterface;
use PhpLab\Sandbox\RestClient\Yii\Web\helpers\AdapterHelper;
use PhpLab\Sandbox\RestClient\Yii\Web\models\RequestForm;
use Symfony\Component\PropertyAccess\PropertyAccess;

class TransportService extends BaseService implements TransportServiceInterface
{

    private $authorizationService;

    public function __construct(AuthorizationServiceInterface $authorizationService)
    {
        $this->authorizationService = $authorizationService;
    }

    public function send(ProjectEntity $projectEntity, RequestForm $model): ResponseInterface
    {
        $config = [
            'base_uri' => $projectEntity->getUrl() . '/',
        ];
        $guzzleClient = new Client($config);
        $authAgent = new AuthAgent($guzzleClient);
        $restClient = new RestClient($guzzleClient, $authAgent);
        if ($model->authorization) {
            try {
                $authEntity = $this->authorizationService->oneByUsername($projectEntity->getId(), $model->authorization, 'bearer');
                $restClient->auth()->authByLogin($authEntity->getUsername(), $authEntity->getPassword());
            } catch (NotFoundException $e) {}
        }
        $options = $this->extractOptions($model);
        $response = $restClient->sendRequest($model->method, $model->endpoint, $options);
        return $response;
    }

    private function extractOptions(RequestForm $model): array {
        $options = [];
        $query = AdapterHelper::collapseFields($model, 'query');
        if ($query) {
            $options[RequestOptions::QUERY] = $query;
        }
        $header = AdapterHelper::collapseFields($model, 'header');
        if ($header) {
            $options[RequestOptions::HEADERS] = $header;
        }
        $body = AdapterHelper::collapseFields($model, 'body');
        if ($body) {
            $options[RequestOptions::FORM_PARAMS] = $body;
        }
        return $options;
    }

}


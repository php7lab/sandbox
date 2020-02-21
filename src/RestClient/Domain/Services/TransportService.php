<?php

namespace PhpLab\Sandbox\RestClient\Domain\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use PhpLab\Core\Domain\Base\BaseService;
use PhpLab\Sandbox\RestClient\Domain\Entities\ProjectEntity;
use PhpLab\Sandbox\RestClient\Domain\Interfaces\Services\TransportServiceInterface;
use PhpLab\Test\Libs\RestClient;
use Psr\Http\Message\ResponseInterface;
use yii2tool\restclient\web\helpers\AdapterHelper;
use yii2tool\restclient\web\models\RequestForm;

class TransportService extends BaseService implements TransportServiceInterface
{

    /*public function __construct(\PhpLab\Sandbox\RestClient\Domain\Interfaces\Repositories\TransportRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }*/

    public function send(ProjectEntity $projectEntity, RequestForm $model): ResponseInterface
    {
        $config = [
            'base_uri' => $projectEntity->getUrl() . '/',
        ];
        $guzzleClient = new Client($config);
        $restClient = new RestClient($guzzleClient);

        if ($model->authorization) {
            $restClient->authByLogin($model->authorization);
        }

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

        //dd($options);

        $response = $restClient->sendRequest($model->method, $model->endpoint, $options);
        return $response;
    }

}


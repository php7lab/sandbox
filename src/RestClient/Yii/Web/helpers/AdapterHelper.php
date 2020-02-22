<?php

namespace PhpLab\Sandbox\RestClient\Yii\Web\helpers;

use PhpLab\Core\Domain\Helpers\EntityHelper;
use PhpLab\Sandbox\RestClient\Domain\Entities\BookmarkEntity;
use yii2bundle\rest\domain\entities\RequestEntity;
use PhpLab\Sandbox\RestClient\Yii\Web\models\RequestForm;
use GuzzleHttp\Psr7\Response;

class AdapterHelper
{

    public static function guzzleResponseToResponseRecord(Response $response): ResponseRecord
    {

    }

    public static function bookmarkEntityToForm(BookmarkEntity $bookmarkEntity): RequestForm
    {
        /** @var RequestForm $model */
        $model = \Yii::createObject(RequestForm::class);
        $model->endpoint = $bookmarkEntity->getUri();
        $model->method = $bookmarkEntity->getMethod();
        $model->authorization = $bookmarkEntity->getAuthorization();
        $model->description = $bookmarkEntity->getDescription();

        if ($bookmarkEntity->getQuery()) {
            foreach ($bookmarkEntity->getQuery() as $key => $value) {
                $model->queryKeys[] = $key;
                $model->queryValues[] = $value;
                $model->queryActives[] = true;
            }
        }

        if ($bookmarkEntity->getBody()) {
            foreach ($bookmarkEntity->getBody() as $key => $value) {
                $model->bodyKeys[] = $key;
                $model->bodyValues[] = $value;
                $model->bodyActives[] = true;
            }
        }

        if ($bookmarkEntity->getHeader()) {
            foreach ($bookmarkEntity->getHeader() as $key => $value) {
                $model->headerKeys[] = $key;
                $model->headerValues[] = $value;
                $model->headerActives[] = true;
            }
        }
        return $model;
    }

    public static function formToBookmarkEntityData(RequestForm $model): BookmarkEntity
    {
        $data = [
            'method' => $model->method,
            'uri' => $model->endpoint,
            'query' => [],
            'body' => [],
            'header' => [],
            'authorization' => $model->authorization,
            'description' => $model->description,
        ];

        foreach ($model->queryKeys as $i => $key) {
            $data['query'][$key] = $model->queryValues[$i];
        }

        foreach ($model->bodyKeys as $i => $key) {
            $data['body'][$key] = $model->bodyValues[$i];
        }

        foreach ($model->headerKeys as $i => $key) {
            $data['header'][$key] = $model->headerValues[$i];
        }
        $bookmarkEntity = new BookmarkEntity;
        EntityHelper::setAttributes($bookmarkEntity, $data);
        return $bookmarkEntity;
    }

    public static function collapseFields(RequestForm $model, string $attributeName) {
        $data = [];
        $keys = $model->{$attributeName.'Keys'};
        $values = $model->{$attributeName.'Values'};
        $actives = $model->{$attributeName.'Actives'};
        foreach ($keys as $i => $key) {
            if(!empty($actives[$i])) {
                $data[$key] = $values[$i];
            }
        }
        return $data;
    }




    public static function createRequestEntityFromForm(RequestForm $model)
    {
        $requestData = self::prepareRequest($model);
        $requestEntity = new RequestEntity($requestData);
        return $requestEntity;
    }

    private static function prepareRequest(RequestForm $model)
    {
        $query = self::prepareRequestData($model->queryKeys, $model->queryValues, $model->queryActives);
        $request = [
            'method' => $model->method,
            'uri' => self::getUri($model->endpoint, $query),
            'description' => $model->description,
            'authorization' => $model->authorization,
            'data' => self::prepareRequestData($model->bodyKeys, $model->bodyValues, $model->bodyActives),
            'headers' => self::prepareRequestData($model->headerKeys, $model->headerValues, $model->headerActives),
        ];
        return $request;
    }

    private static function prepareRequestData($keys, $values, $actives)
    {
        $result = [];
        foreach ($keys as $index => $key) {
            if ($actives[$index]) {
                $result[$key] = $values[$index];
            }
        }
        return $result;
    }

    private static function getUri($uri, $data)
    {
        $query = self::buildQuery($data);
        if ( ! empty($query)) {
            return $uri . '?' . $query;
        }
        return $uri;
    }

    private static function buildQuery($data)
    {
        $couples = [];
        foreach ($data as $key => $value) {
            $couples[] = self::encodeQueryKey($key) . '=' . urlencode($value);
        }
        $query = join('&', $couples);
        $query = trim($query);
        return $query;
    }

    private static function encodeQueryKey($key)
    {
        $encodedKey = urlencode($key);
        return str_replace(['%5B', '%5D'], ['[', ']'], $encodedKey);
    }
}
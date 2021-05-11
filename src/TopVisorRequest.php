<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 02.04.21 05:15:11
 */

declare(strict_types = 1);
namespace dicr\topvisor;

use dicr\helper\Log;
use dicr\validate\ValidateException;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\httpclient\Request;

/**
 * Запрос TopVisor
 */
abstract class TopVisorRequest extends Entity
{
    /** @var TopVisorApi */
    protected $api;

    /**
     * TopVisorRequest constructor.
     *
     * @param TopVisorApi $api
     * @param array $config
     */
    public function __construct(TopVisorApi $api, array $config = [])
    {
        $this->api = $api;

        parent::__construct($config);
    }

    /**
     * Метод запроса.
     *
     * @return string
     * @noinspection PhpMethodMayBeStaticInspection
     */
    public function method(): string
    {
        return 'POST';
    }

    /**
     * URL запроса.
     *
     * @return string
     */
    abstract public function url(): string;

    /**
     * Создает HTTP-запрос.
     *
     * @return Request
     * @throws InvalidConfigException
     */
    protected function httpRequest(): Request
    {
        $request = $this->api->httpClient->createRequest()
            ->setMethod($this->method())
            ->setUrl($this->url())
            ->setData($this->json);

        if (! empty($this->api->userId) && empty($request->headers->get('User-Id'))) {
            $request->headers->set('User-Id', $this->api->userId);
        }

        if (! empty($this->api->apiKey) && empty($request->headers->get('Authorization'))) {
            $request->headers->set('Authorization', 'bearer ' . $this->api->apiKey);
        }

        return $request;
    }

    /**
     * Создает ответ.
     *
     * @param array $json
     * @return TopVisorResponse
     */
    protected function createResponse(array $json): TopVisorResponse
    {
        return new TopVisorResponse([
            'json' => $json
        ]);
    }

    /**
     * Отправка запроса.
     *
     * @return TopVisorResponse (переопределяется в наследнике)
     * @throws Exception
     */
    public function send(): TopVisorResponse
    {
        if (! $this->validate()) {
            throw new ValidateException($this);
        }

        $req = $this->httpRequest();
        Log::debug('Запрос: ' . $req->toString());

        $res = $req->send();
        Log::debug('Ответ: ' . $res->toString());

        if (! $res->isOk) {
            throw new Exception('HTTP-error: ' . $res->statusCode);
        }

        $response = $this->createResponse($res->data);
        if (! empty($response->errors)) {
            throw new Exception((string)$response->errors[0]);
        }

        return $response;
    }
}


<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 02.04.21 05:15:11
 */

declare(strict_types = 1);
namespace dicr\topvisor;

use dicr\http\CachingClient;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\di\Instance;
use yii\httpclient\Client;
use yii\httpclient\CurlTransport;

use const CURLOPT_ENCODING;

/**
 * API TopVisor
 *
 * @link https://topvisor.com/ru/api/v2/
 */
class TopVisorApi extends Component
{
    /** @var int UserID */
    public $userId;

    /** @var string ключ API */
    public $apiKey;

    /** @var Client */
    public $httpClient = [
        'class' => CachingClient::class,
        'cacheDuration' => 86400,
        'transport' => CurlTransport::class,
        'baseUrl' => 'https://api.topvisor.com/v2/json',
        'requestConfig' => [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
            'options' => [
                'userAgent' => 'dicr/yii2-topvisor',
                'followLocation' => false,
                CURLOPT_ENCODING => ''
            ],
            'format' => Client::FORMAT_JSON
        ],
        'responseConfig' => [
            'format' => Client::FORMAT_JSON
        ]
    ];

    /**
     * @inheritDoc
     * @throws InvalidConfigException
     */
    public function init(): void
    {
        parent::init();

        $this->httpClient = Instance::ensure($this->httpClient, Client::class);
    }

    /**
     * Создает запрос из конфига.
     *
     * @param array $config
     * @return TopVisorRequest
     * @throws InvalidConfigException
     */
    public function request(array $config): TopVisorRequest
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return Yii::createObject($config, [$this]);
    }
}

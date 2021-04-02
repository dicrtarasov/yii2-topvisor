<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 02.04.21 05:15:11
 */

declare(strict_types = 1);
namespace dicr\topvisor\entity;

use dicr\topvisor\GetRequest;
use dicr\topvisor\TopVisor;

use function array_merge;

/**
 * Запрос списка ключевых фраз.
 *
 * @link https://topvisor.com/ru/api/v2-services/keywords_2/keywords/
 */
class GetKeywordsRequest extends GetRequest
{
    /** @var int ID проекта */
    public $projectId;

    /** @var ?string (Currency) Валюта цены клика */
    public $currency;

    /** @var ?int (bool) Отображать ключевые фразы из временной корзины */
    public $showTrash;

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            ['projectId', 'required'],
            ['projectId', 'integer', 'min' => 1],
            ['projectId', 'filter', 'filter' => 'intval'],

            ['currency', 'default'],
            ['currency', 'in', 'range' => array_keys(TopVisor::CURRENCY)],

            ['showTrash', 'default'],
            ['showTrash', 'boolean'],
            ['showTrash', 'filter', 'filter' => 'intval', 'skipOnEmpty' => true],
        ]);
    }

    /**
     * @inheritDoc
     */
    public function url(): string
    {
        return 'get/keywords_2/keywords';
    }

    /**
     * @inheritDoc
     */
    protected function createResponse(array $json): GetKeywordsResponse
    {
        return new GetKeywordsResponse([
            'json' => $json
        ]);
    }

    /**
     * @inheritDoc
     * @return GetKeywordsResponse
     */
    public function send(): GetKeywordsResponse
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return parent::send();
    }
}

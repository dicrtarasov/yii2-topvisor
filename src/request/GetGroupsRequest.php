<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 11.05.21 12:45:17
 */

declare(strict_types = 1);
namespace dicr\topvisor\request;

use dicr\topvisor\GetDataRequest;

use function array_merge;

/**
 * Запрос на получение списка групп проекта.
 *
 * @link https://topvisor.com/ru/api/v2-services/keywords_2/groups/get/
 */
class GetGroupsRequest extends GetDataRequest
{
    /** @var int ID проекта */
    public $projectId;

    /** @var ?int (bool) Отображать группы из временной корзины (по-умолчанию 0) */
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

            ['showTrash', 'default'],
            ['showTrash', 'boolean'],
            ['showTrash', 'filter', 'filter' => 'intval', 'skipOnEmpty' => true]
        ]);
    }

    /**
     * @inheritDoc
     */
    public function url(): string
    {
        return 'get/keywords_2/groups';
    }

    /**
     * @inheritDoc
     */
    protected function createResponse(array $json): GetGroupsResponse
    {
        return new GetGroupsResponse([
            'json' => $json
        ]);
    }

    /**
     * @inheritDoc
     * @return GetGroupsResponse
     */
    public function send(): GetGroupsResponse
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return parent::send();
    }
}

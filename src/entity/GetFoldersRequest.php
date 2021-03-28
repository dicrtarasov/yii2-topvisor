<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.03.21 02:20:34
 */

declare(strict_types = 1);
namespace dicr\topvisor\entity;

use dicr\topvisor\GetRequest;

use function array_keys;

/**
 * Запрос списка папок.
 *
 * @link https://topvisor.com/ru/api/v2-services/keywords_2/folders/get/
 */
class GetFoldersRequest extends GetRequest
{
    /** @var string стандартный массив результатов */
    public const VIEW_FLAT = 'flat';

    /** @var string вместо массива возвращается объект с элементами - объектами папок и с ключами, равными parent_id этих папок */
    public const VIEW_TREE = 'tree';

    /** @var string[] */
    public const VIEW = [
        self::VIEW_FLAT => 'flat',
        self::VIEW_TREE => 'tree'
    ];

    /** @var int ID проекта */
    public $projectId;

    /**
     * @var ?string Формат результата (VIEW). По-умолчанию flat.
     * - flat - стандартный массив результатов
     * - tree - вместо массива возвращается объект с элементами - объектами папок и с ключами, равными parent_id этих
     *     папок
     */
    public $view;

    /** @var int (bool) Отображать папки из временной корзины (по-умолчанию 0) */
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

            ['view', 'default'],
            ['view', 'in', 'range' => array_keys(self::VIEW)],

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
        return 'get/keywords_2/folders';
    }

    /**
     * @inheritDoc
     */
    protected function createResponse(array $json): GetFoldersResponse
    {
        return new GetFoldersResponse([
            'json' => $json
        ]);
    }

    /**
     * @inheritDoc
     * @return GetFoldersResponse
     */
    public function send(): GetFoldersResponse
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return parent::send();
    }
}

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

use function array_merge;

/**
 * Запрос списка проектов.
 *
 * @link https://topvisor.com/ru/api/v2-services/projects_2/projects/
 */
class GetProjectsRequest extends GetRequest
{
    /**
     * @var int (bool) Добавить в результат дополнительную информацию (кол-во страниц в индексе, кол-во ссылок, тИЦ,
     *     ...)
     */
    public $showSiteStat;

    /** @var int (bool) Добавить в результат список ПС и регионов, привязанных к проекту */
    public $showSearchersAndRegions;

    /**
     * @var int[]|null Добавить в результат сводку с указанными параметрами.
     * Возможные ключи массива см. в параметрах метода: get/positions_2/summary
     * Пример: ['show_dynamics' => 1, 'show_tops' => 1]
     */
    public $includePositionsSummaryParams;

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            [['showSiteStat', 'showSearchersAndRegions'], 'default'],
            [['showSiteStat', 'showSearchersAndRegions'], 'boolean'],
            [['showSiteStat', 'showSearchersAndRegions'], 'filter', 'filter' => 'intval', 'skipOnEmpty' => true],

            ['includePositionsSummaryParams', 'default'],
            ['includePositionsSummaryParams', 'each', 'rule' => ['boolean']],
            ['includePositionsSummaryParams', 'each', 'rule' => ['filter', 'filter' => 'intval']],
        ]);
    }

    /**
     * @inheritDoc
     */
    public function url(): string
    {
        return 'get/projects_2/projects';
    }

    /**
     * @inheritDoc
     */
    protected function createResponse(array $json): GetProjectsResponse
    {
        return new GetProjectsResponse([
            'json' => $json
        ]);
    }

    /**
     * @inheritDoc
     * @return GetProjectsResponse
     */
    public function send(): GetProjectsResponse
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return parent::send();
    }
}

<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.03.21 18:57:42
 */

declare(strict_types = 1);
namespace dicr\topvisor\entity;

use dicr\topvisor\TopVisorEntity;

/**
 * Информация о поисковике.
 * Возвращается в GetProjectsRequest при show_searchers_and_regions = 1.
 */
class Searcher extends TopVisorEntity
{
    /** @var int какой-то id (вероятно набора параметров) */
    public $id;

    /** @var int id проекта */
    public $projectId;

    /** @var int код поисковой системы (SEARCHER) */
    public $searcher;

    /** @var int (bool) включено */
    public $enabled;

    /** @var int порядок сортировки */
    public $ord;

    /** @var int код поисковой системы (SEARCHER) */
    public $key;

    /** @var string название поисковой системы */
    public $name;

    /** @var Region[] настройки регионов поиска */
    public $regions;

    /**
     * @inheritDoc
     */
    public function attributeEntities(): array
    {
        return array_merge(parent::attributeEntities(), [
            'regions' => [Region::class]
        ]);
    }
}

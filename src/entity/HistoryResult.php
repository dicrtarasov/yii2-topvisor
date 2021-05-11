<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 11.05.21 13:01:51
 */

declare(strict_types = 1);
namespace dicr\topvisor\entity;

use dicr\topvisor\Entity;

use function array_merge;

/**
 * Результат в ответе GetHistoryResponse.
 *
 * @link https://topvisor.com/ru/api/v2-services/positions_2/get-history/
 */
class HistoryResult extends Entity
{
    /** @var Keyword[] поисковые фразы с PositionsData */
    public $keywords;

    /** @var ?array структура данных Заголовки результатов (если show_headers = 1) */
    public $headers;

    /** @var string[]|null массив дат Y-m-d, Даты, в которых были проверки (если show_exists_dates = 1) */
    public $existsDates;

    /**
     * @var int[]|null [Y-d-m:project_id:region_index => int] Количество визитов по определителю
     * Данные об общем количество визитов по каждой проверке (если show_visitors = 1)
     */
    public $visitors;

    /**
     * @var int[]|null [Y-d-m:project_id:region_index => int] Процент ключевых фраз в ТОП-N по определителю
     * Данные по ТОПу указанной глубины по каждой проверке (если show_top_by_depth = N)
     */
    public $top;

    /**
     * @inheritDoc
     */
    public function attributeEntities(): array
    {
        return array_merge(parent::attributeEntities(), [
            'keywords' => [Keyword::class]
        ]);
    }
}

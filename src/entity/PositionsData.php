<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.03.21 02:20:34
 */

declare(strict_types = 1);
namespace dicr\topvisor\entity;

use dicr\topvisor\TopVisorEntity;

/**
 * Данные о позиции поисковой фразы.
 *
 * @link https://topvisor.com/ru/api/v2-services/positions_2/get-history/
 */
class PositionsData extends TopVisorEntity
{
    /** @var int|string Позиция запроса или "--" */
    public $position;

    /** @var ?string релевантная страница */
    public $relevantUrl;

    /** @var ?int Количество визитов */
    public $visitors;
}

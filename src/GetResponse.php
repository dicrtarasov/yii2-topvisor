<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.03.21 02:20:34
 */

declare(strict_types = 1);
namespace dicr\topvisor;

/**
 * Ответ за запрос получения данных.
 */
abstract class GetResponse extends TopVisorResponse
{
    /** @var ?int общее количество результатов */
    public $total;

    /** @var ?int значение offset для выборки следующей страницы */
    public $nextOffset;
}

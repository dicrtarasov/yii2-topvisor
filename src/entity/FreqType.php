<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.03.21 02:20:34
 */

declare(strict_types = 1);
namespace dicr\topvisor\entity;

/**
 * Номер формы частоты.
 *
 * @link https://topvisor.com/ru/api/v2/fields/
 */
interface FreqType
{
    /** @var string[] значения для Yandex */
    public const YANDEX = [
        1 => 'Частота',
        2 => '"Частота"',
        3 => '"!Частота"',
        5 => '[Частота]',
        6 => '"[!Частота]"'
    ];

    /** @var string[] значения для Google */
    public const GOOGLE = [
        3 => 'Частота'
    ];

    /** @var string[] значения для go.Mail */
    public const GO_MAIL = [
        2 => 'Частота'
    ];
}

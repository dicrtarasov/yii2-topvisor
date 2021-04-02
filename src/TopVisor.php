<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 02.04.21 05:17:09
 */

declare(strict_types = 1);
namespace dicr\topvisor;

/**
 * Значения-константы
 */
interface TopVisor
{
    /** @var int настольный компьютер */
    public const DEVICE_PC = 0;

    /** @var int планшет */
    public const DEVICE_TABLET = 1;

    /** @var int мобильное устройство */
    public const DEVICE_MOBILE = 2;

    /** @var string[] типы устройств */
    public const DEVICE = [
        self::DEVICE_PC => 'компьютер',
        self::DEVICE_TABLET => 'планшет',
        self::DEVICE_MOBILE => 'смартфон'
    ];

    /** @var int */
    public const SEARCHER_YANDEX = 0;

    /** @var int */
    public const SEARCHER_GOOGLE = 1;

    /** @var int */
    public const SEARCHER_GO_MAIL = 2;

    /** @var int */
    public const SEARCHER_YOUTUBE = 4;

    /** @var int */
    public const SEARCHER_BING = 5;

    /** @var int */
    public const SEARCHER_YAHOO = 6;

    /** @var int */
    public const SEARCHER_SEZNAM = 7;

    /** @var int */
    public const SEARCHER_APP_STORE = 8;

    /** @var int */
    public const SEARCHER_GOOGLE_PLAY = 9;

    /** @var int */
    public const SEARCHER_YANDEX_COM = 20;

    /** @var int */
    public const SEARCHER_YANDEX_COM_TR = 21;

    /** @var string[] */
    public const SEARCHER = [
        self::SEARCHER_YANDEX => 'Yandex',
        self::SEARCHER_GOOGLE => 'Google',
        self::SEARCHER_GO_MAIL => 'go.Mail',
        self::SEARCHER_YOUTUBE => 'Youtube',
        self::SEARCHER_BING => 'Bing',
        self::SEARCHER_YAHOO => 'Yahoo',
        self::SEARCHER_SEZNAM => 'Seznam',
        self::SEARCHER_APP_STORE => 'AppStore',
        self::SEARCHER_GOOGLE_PLAY => 'GooglePlay',
        self::SEARCHER_YANDEX_COM => 'Yandex.com',
        self::SEARCHER_YANDEX_COM_TR => 'Yandex.com.tr'
    ];

    /** @var string */
    public const CURRENCY_RUB = 'RUB';

    /** @var string */
    public const CURRENCY_USD = 'USD';

    /** @var string[] валюты */
    public const CURRENCY = [
        self::CURRENCY_RUB => 'рубль',
        self::CURRENCY_USD => 'доллар'
    ];

    /** @var string[][] типы частотности */
    public const FREQ_TYPE = [
        // типы частот для Яндекс
        self::SEARCHER_YANDEX => [
            1 => 'Частота',
            2 => '"Частота"',
            3 => '"!Частота"',
            5 => '"[Частота]"',
            6 => '"[!Частота]"'
        ],

        // типы частотности для Google
        self::SEARCHER_GOOGLE => [
            3 => 'Частота'
        ],

        self::SEARCHER_GO_MAIL => [
            2 => 'Частота'
        ]
    ];
}

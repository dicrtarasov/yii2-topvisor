<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.03.21 15:30:08
 */

declare(strict_types = 1);
namespace dicr\topvisor\entity;

use dicr\topvisor\TopVisorEntity;

/**
 * Проект.
 *
 * Дополнительное поле 'COUNT(*)' для запроса общего кол-ва.
 *
 * @link https://topvisor.com/ru/api/v2-services/projects_2/projects/
 */
class Project extends TopVisorEntity
{
    /** @var int ID проекта */
    public $id;

    /** @var int ID пользователя */
    public $userId;

    /** @var string Имя проекта */
    public $name;

    /** @var string URL сайта */
    public $url;

    /**
     * @var int Статус проекта:
     * 0 - обычный проект
     * -1 - в архиве
     */
    public $on;

    /** @var string datetime Время создания проекта */
    public $date;

    /** @var string Права на проект */
    public $right;

    /** @var int (bool) Избранный проект */
    public $favorite;

    /** @var array set(от 1 до 10) Номер тега */
    public $tags;

    /** @var string Email владельца */
    public $userEmail;

    // === Статусы =============================================

    /** @var int enum(0,1,2,3) Статус проверки позиций */
    public $statusPositions;

    /** @var string datetime Время последней проверки позиций */
    public $positionsTime;

    /** @var int Процент завершенности проверки позиций */
    public $positionsPercent;

    /** @var int (bool) Статус проверки частоты */
    public $statusVolumes;

    /** @var int (bool) Статус кластеризации */
    public $statusClaster;

    // === Настройки проверки позиций =========================

    /** @var int (bool) Учитывать/не учитывать поддомены */
    public $subdomains;

    /**
     * @var int Фильтр:
     * - 0 - без ограничений
     * - 1 - умеренный фильтр
     * - 2 - семейный поиск
     */
    public $filter;

    /** @var int (bool) Исправлять/не исправлять опечатки */
    public $autoCorrect;

    /** @var int (bool) Собирать/не собирать сниппеты */
    public $withSnippets;

    /**
     * @var int Снимки выдачи:
     * - 0 - не собирать снимки выдачи
     * - 2 - собирать снимки выдачи ТОП20
     * - 3 - собирать снимки выдачи ТОП30
     * - 5 - собирать снимки выдачи ТОП50
     * - 9 - собирать снимки выдачи ТОП100
     */
    public $doSnapshots;

    // === Дополнительные настройки =============================

    /** @var int (bool) Трафик 0 - трафик по регионам, 1 - общий трафик */
    public $commonTraffic;

    /** @var string Опции гостевой ссылки */
    public $guestLinkRight;

    // === Дополнительные ======================================

    /** @var int Количество загруженных рекламных кампаний */
    public $brokerCountCampaigns;

    /** @var int Количество активных объявлений */
    public $brokerCountBanners;

    /** @var int Количество неактивных объявлений */
    public $brokerCountBannersOff;

    /** @var array Информация о домене */
    public $domainExpire;

    /** @var ?array поисковики-регионы (если задано showSearchersAndRegions) */
    public $searchers;
}

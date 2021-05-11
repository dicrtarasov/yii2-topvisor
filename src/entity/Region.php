<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 30.03.21 18:52:39
 */

declare(strict_types = 1);
namespace dicr\topvisor\entity;

use dicr\topvisor\Entity;

/**
 * Информация о регине поиска.
 * Возвращается в GetProjectsRequest при show_searchers_and_regions = 1)
 *
 * {
 * 'id':3124721,
 * 'key':2,
 * 'lang':'ru',
 * 'device':0,
 * 'depth':1,
 * 'index':3,
 * 'enabled':1,
 * 'searcher_key':0,
 * 'type':'CITY',
 * 'countryCode':'RU',
 * 'name':'Санкт-Петербург',
 * 'areaName':'Санкт-Петербург и Ленинградская область',
 * 'domain':'.ru'
 * }
 */
class Region extends Entity
{
    /** @var int ID набора параметров поиска */
    public $id;

    /** @var int ID региона */
    public $key;

    /** @var string язык поиска (например "ru") */
    public $lang;

    /** @var int код устройства (DEVICE) */
    public $device;

    /** @var int глубина поиска (1 - 100, 2- 200, ...) */
    public $depth;

    /**
     * @var int индекс региона
     * Определяется набором параметров: поисковик, регион, язык
     * Используется в запросе позиций (GetHistoryRequest)
     */
    public $index;

    /** @var int (bool) */
    public $enabled;

    /** @var int код поисковой системы (SEARCHER) */
    public $searcherKey;

    /** @var string тип региона (например "CITY") */
    public $type;

    /** @var string код страны (например "RU") */
    public $countryCode;

    /** @var string название региона (например 'Санкт-Петербург') */
    public $name;

    /** @var string название области (например 'Санкт-Петербург и Ленинградская область') */
    public $areaName;

    /** @var string домен верхнего уровня (например '.ru') */
    public $domain;
}

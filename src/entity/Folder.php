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
 * Папка групп запросов.
 *
 * Дополнительное поле для запроса общего кол-ва: COUNT(*)
 *
 * @link https://topvisor.com/ru/api/v2-services/keywords_2/folders/
 */
class Folder extends TopVisorEntity
{
    /** @var int ID папки */
    public $id;

    /** @var int ID проекта */
    public $projectId;

    /** @var int ID родительской папки */
    public $parentId;

    /** @var string Имя папки */
    public $name;

    /** @var int Количество под-папок (1-го уровня) */
    public $countFolders;

    /** @var int Количество групп в папке (не считая под-папки) */
    public $countGroups;

    /** @var int Порядковый номер сортировки */
    public $ord;
}

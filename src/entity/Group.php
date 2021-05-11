<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.03.21 02:20:34
 */

declare(strict_types = 1);
namespace dicr\topvisor\entity;

use dicr\topvisor\Entity;

/**
 * Группа поисковых фраз.
 *
 * Группа обязательно должна быть привязана к одной папке. Если папка не указана,
 * группа будет добавляться в корневую папку проекта.
 *
 * Дополнительное поле для запроса общего кол-ва: COUNT(*)
 *
 * @link https://topvisor.com/ru/api/v2-services/keywords_2/groups/
 */
class Group extends Entity
{
    /** @var int ID группы */
    public $id;

    /** @var int ID проекта */
    public $projectId;

    /** @var int ID папки */
    public $folderId;

    /** @var string Имя группы */
    public $name;

    /** @var int (bool) Активность группы */
    public $on;

    /** @var int (bool) Статус подбора */
    public $status;

    /** @var int Порядковый номер сортировки */
    public $ord;

    // === Дополнительные

    /** @var ?string Путь к группе */
    public $folderPath;

    /** @var ?int Количество ключевых фраз */
    public $countKeywords;

    /**
     * @var ?int Частот является составным полем.
     * Определители поля:
     * - region_key - ключ региона
     * - searcher_key - ключ ПС
     * - type - форма частоты (FreqType), возможные значения:
     *   - Для Яндекс: 1, 2, 3, 5, 6 (Ч, 'Ч', '!Ч', '[Ч]', '[!Ч]')
     *   - Для Google: 3
     *   - Для go.Mail: 2
     */
    public $volume;
}

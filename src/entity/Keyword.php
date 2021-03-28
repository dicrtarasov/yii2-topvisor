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
 * Ключевая фраза.
 *
 * Дополнительное поле 'COUNT(*)' для запроса общего кол-ва.
 *
 * @link https://topvisor.com/ru/api/v2-services/keywords_2/keywords/
 */
class Keyword extends TopVisorEntity
{
    /** @var int ID ключевой фразы */
    public $id;

    /** @var int ID проекта */
    public $projectId;

    /** @var int ID группы */
    public $groupId;

    /** @var string Имя ключевой фразы */
    public $name;

    /** @var array set (от 1 до 10) Номер тега */
    public $tags;

    /** @var string Целевая ссылка */
    public $target;

    /** @var int Порядковый номер сортировки */
    public $org;

    // === Дополнительные

    /** @var ?string */
    public $groupName;

    /** @var ?int (bool) Активность группы, в которой находится ключевая фраза */
    public $groupOn;

    /** @var ?int Порядковый номер сортировки группы, в которой находится ключевая фраза */
    public $groupOrd;

    /**
     * @var ?int ID папки, в которой находится группа с ключевой фразой.
     * При фильтрации может использоваться в связке с дополнительным параметром запроса group_folder_id_depth:
     * - 0 - не искать в под-папках (по умолчанию)
     * - 1 - искать в под-папках
     */
    public $groupFolderId;

    /** @var ?string Путь к группе, в которой находится ключевая фраза (без имени группы) */
    public $groupFolderPath;

    /**
     * @var ?int enum(NULL, -1, 0, 1) Статус целевой ссылки, является составным полем.
     * Определители поля:
     * - region_index - индекс региона
     * Описание значений:
     * - 1 - целевая ссылка совпадает с релевантной
     * - 0 - целевая ссылка не совпадает с релевантной
     * - -1 - релевантная страница не определена
     * - NULL - целевая ссылка не указана
     */
    public $targetStatus;

    /**
     * @var int|string|null позиция сайта или "--"
     * Позиция сайта, является составным полем.
     * - date - дата проверки
     * - project_id - id проекта / конкурента
     * - region_index - индекс региона
     * В методах get будет возвращаться строка '--' в случаях, если сайт не был найден в выдаче.
     */
    public $position;

    /**
     * @var ?int Релевантная страница, является составным полем.
     * Определители поля такие же, как у поля position.
     */
    public $relevantUrl;

    /**
     * @var ?string Заголовок сниппета, является составным полем.
     * Определители поля такие же, как у поля position.
     */
    public $snippetTitle;

    /**
     * @var ?string Описание сниппета, является составным полем.
     * Определители поля такие же, как у поля position.
     */
    public $snippetBody;

    /**
     * @var ?int Визиты являются составным полем.
     * Определители поля такие же, как у поля position.
     * Визиты собираются автоматически в момент проверки позиций, если в проекте интегрированы Яндекс Метрика или
     *     Google Analytics.
     */
    public $visitors;

    /**
     * @var ?int Частота, является составным полем.
     * Определители поля:
     * - region_key - ключ региона
     * - searcher_key - ключ ПС
     * - type - форма частоты, возможные значения:
     *   - Для Яндекс: 1, 2, 3, 5, 6 (Ч, 'Ч', '!Ч', '[Ч]', '[!Ч]')
     *   - Для Google: 3
     *   - Для go.Mail: 2
     */
    public $volume;

    /**
     * @var ?int Прогнозируемая цена клика, является составным полем.
     * Определители поля:
     * - position - Место показа, возможные значения:
     *   Для Яндекс:
     *   - P11 - 1 спец. размещение
     *   - P12 - 2 спец. размещение
     *   - P13 - 3 спец. размещение
     *   - P1L - Вход в спец. размещение
     *   - P21 - Гарантированные показы
     *   - P2L - Вход в гарантированные показы
     *   Для Google:
     *   - P11 - 1 место
     *   - P1L - Верх страницы
     *   - P2L - 1 страница
     * - region_key - ключ региона
     * - searcher_key - ключ ПС
     */
    public $costForecast;

    /**
     * @var PositionsData[]|null данные позиций в ответе history [date:projectId:regionIndex => PositionsData]
     * Индекс массива - составное поле date:projectId:regionIndex, значение - PositionsData
     */
    public $positionsData;

    /**
     * @inheritDoc
     */
    public function attributeEntities(): array
    {
        return array_merge(parent::attributeEntities(), [
            'positionsData' => [PositionsData::class]
        ]);
    }
}

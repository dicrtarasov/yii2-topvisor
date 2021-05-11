<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 11.05.21 12:45:17
 */

declare(strict_types = 1);
namespace dicr\topvisor\request;

use dicr\topvisor\GetDataRequest;

use function array_keys;
use function count;
use function is_array;
use function is_numeric;

/**
 * Запрос истории проверки позиций.
 *
 * @link https://topvisor.com/ru/api/v2-services/positions_2/get-history/
 */
class GetHistoryRequest extends GetDataRequest
{
    /** @var int весь период без ограничений */
    public const TYPE_RANGE_ALL = 0;

    /** @var int только обновления Яндекса */
    public const TYPE_RANGE_UPDATES = 1;

    /** @var int период до 31 даты */
    public const TYPE_RANGE_PERIOD31 = 2;

    /** @var int две даты */
    public const TYPE_RANGE_TWO_DATE = 3;

    /** @var int одна дата */
    public const TYPE_RANGE_ONE_DATE = 4;

    /** @var int последняя дата каждого месяца */
    public const TYPE_RANGE_LAST_MON = 5;

    /** @var int даты через равные промежутки */
    public const TYPE_RANGE_PERIOD = 6;

    /** @var int две последние даты проверок */
    public const TYPE_RANGE_TWO_LAST = 7;

    /** @var int произвольные даты (используется только с параметром dates) */
    public const TYPE_RANGE_DATES = 100;

    /** @var string[] тип выбора дат из диапазона */
    public const TYPE_RANGE = [
        self::TYPE_RANGE_ALL => 'весь период без ограничений',
        self::TYPE_RANGE_UPDATES => 'только обновления Яндекса',
        self::TYPE_RANGE_PERIOD31 => 'период до 31 даты',
        self::TYPE_RANGE_TWO_DATE => 'две даты',
        self::TYPE_RANGE_ONE_DATE => 'одна дата',
        self::TYPE_RANGE_LAST_MON => 'последняя дата каждого месяца',
        self::TYPE_RANGE_PERIOD => 'даты через равные промежутки',
        self::TYPE_RANGE_TWO_LAST => 'две последние даты проверок',
        self::TYPE_RANGE_DATES => 'произвольные даты'
    ];

    /** @var string позиция запроса */
    public const POSITION_FIELD_POSITION = 'position';

    /** @var string сниппет */
    public const POSITION_FIELD_SNIPPET = 'snippet';

    /** @var string релевантная страница */
    public const POSITION_FIELD_RELEVANT_URL = 'relevant_url';

    /** @var string количество визитов */
    public const POSITION_FIELD_VISITORS = 'visitors';

    /** @var string[] поля данных результатов проверки */
    public const POSITION_FIELD = [
        self::POSITION_FIELD_POSITION => 'позиция запроса',
        self::POSITION_FIELD_SNIPPET => 'сниппет',
        self::POSITION_FIELD_RELEVANT_URL => 'релевантная страница',
        self::POSITION_FIELD_VISITORS => 'количество визитов'
    ];

    /** @var string позиции поднялись */
    public const DYNAMIC_UP = '>';

    /** @var string позиции упали */
    public const DYNAMIC_DOWN = '<';

    /** @var string позиции не изменились */
    public const DYNAMIC_NONE = '=';

    /** @var string[] динамика позиций */
    public const DYNAMIC = [
        self::DYNAMIC_UP => 'поднялись',
        self::DYNAMIC_DOWN => 'упали',
        self::DYNAMIC_NONE => 'не изменились'
    ];

    /** @var int ID проекта */
    public $projectId;

    /**
     * @var int[] Индексы регионов.
     * Индекс региона определяет уникальный набор параметров searcher_key, region_key и region_lang.
     * Индекс региона можно узнать в настройках регионов проекта, используя метод get/projects_2/projects.
     * project->searcher->region->index
     */
    public $regionsIndexes;

    /** @var string[]|null список дат проверки позиций (в Y-m-d) */
    public $dates;

    /** @var ?string (Y-m-d) начальная дата (обязательна если не заданы dates) */
    public $date1;

    /** @var ?string (Y-m-d) конечная дата (обязательна если не заданы dates) */
    public $date2;

    /** @var int[]|null ID конкурентов (или ID проекта), добавленных в настройках проекта */
    public $competitorsIds;

    /** @var ?int (TYPE_RANGE) тип выбора дат из периода (по-умолчанию 2) */
    public $typeRange;

    /** @var ?int Максимальное число возвращаемых дат (не более 31) */
    public $countDates;

    /** @var ?int (bool) Отображать только ключевые фразы, присутствующие в первой проверке указанного периода (по-ум. 0) */
    public $onlyExistsFirstDate;

    /** @var ?int (bool) Добавить в результат заголовки результатов (по-ум. 0) */
    public $showHeaders;

    /** @var ?int (bool) Добавить в результат даты, в которых были проверки (по-ум. 0) */
    public $showExistsDates;

    /** @var ?int (bool) Добавить в результат данные об общем количество визитов по каждой проверке (по-ум. 0) */
    public $showVisitors;

    /** @var string[]|null (POSITION_FIELD) Выбор столбцов данных с результатами проверки */
    public $positionsFields;

    /**
     * @var ?string (DYNAMIC) Фильтр по ключевым фразам, позиции которых поднялись/упали/не изменились за крайние даты
     * периода. работает при получении позиций по одному проекту, одному региону для более чем одной даты
     */
    public $filterByDynamic;

    /** @var int[][]|null array of array(int, int) Фильтр по ключевым фразам, позиции которых входят в указанные промежутки */
    public $filterByPositions;

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            ['projectId', 'required'],
            ['projectId', 'integer'],
            ['projectId', 'filter', 'filter' => 'intval'],

            ['regionsIndexes', 'required'],
            ['regionsIndexes', 'each', 'rule' => ['integer', 'min' => 1]],

            ['dates', 'default'],
            ['dates', 'each', 'rule' => ['date', 'format' => 'php:Y-m-d']],

            [['date1', 'date2'], 'default'],
            [['date1', 'date2'], 'required', 'when' => fn(): bool => empty($this->dates)],
            [['date1', 'date2'], 'date', 'format' => 'php:Y-m-d'],

            ['competitorsIds', 'default'],
            ['competitorsIds', 'each', 'rule' => ['integer', 'min' => 1]],
            ['competitorsIds', 'each', 'rule' => ['filter', 'filter' => 'intval']],

            ['typeRange', 'default'],
            ['typeRange', 'in', 'range' => array_keys(self::TYPE_RANGE)],
            ['typeRange', 'filter', 'filter' => 'intval', 'skipOnEmpty' => true],

            ['countDates', 'default'],
            ['countDates', 'integer', 'min' => 1, 'max' => 31],
            ['countDates', 'filter', 'filter' => 'intval', 'skipOnEmpty' => true],

            [['onlyExistsFirstDate', 'showHeaders', 'showExistsDates', 'showVisitors'], 'default'],
            [['onlyExistsFirstDate', 'showHeaders', 'showExistsDates', 'showVisitors'], 'boolean'],
            [['onlyExistsFirstDate', 'showHeaders', 'showExistsDates', 'showVisitors'], 'filter', 'filter' => 'intval',
                'skipOnEmpty' => true],

            ['positionsFields', 'default'],
            ['positionsFields', 'each', 'rule' => ['in', 'range' => array_keys(self::POSITION_FIELD)]],

            ['filterByDynamic', 'default'],
            ['filterByDynamic', 'in', 'range' => array_keys(self::DYNAMIC)],

            ['filterByPositions', 'default'],
            ['filterByPositions', function(string $attribute) {
                if (empty($this->filterByPositions)) {
                    $this->filterByPositions = null;
                } elseif (is_array($this->filterByPositions)) {
                    foreach ($this->filterByPositions as $positions) {
                        if (is_array($positions) && count($positions) === 2 && isset($positions[0], $positions[1])) {
                            foreach ($positions as $pos) {
                                if (! is_numeric($pos) || $pos < 0) {
                                    $this->addError($attribute, 'Некорректная позиция: ' . $pos);
                                }
                            }
                        } else {
                            $this->addError($attribute, 'Некорректное значение позиций');
                        }
                    }
                } else {
                    $this->addError($attribute, 'Должен быть массивом массивов');
                }
            }],
        ]);
    }

    /**
     * @inheritDoc
     */
    public function url(): string
    {
        return 'get/positions_2/history';
    }

    /**
     * @inheritDoc
     */
    protected function createResponse(array $json): GetHistoryResponse
    {
        return new GetHistoryResponse([
            'json' => $json
        ]);
    }

    /**
     * @inheritDoc
     * @return GetHistoryResponse
     */
    public function send(): GetHistoryResponse
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return parent::send();
    }
}

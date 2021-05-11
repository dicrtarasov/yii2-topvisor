<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 13.04.21 09:43:43
 */

declare(strict_types = 1);
namespace dicr\topvisor\entity;

use dicr\topvisor\Entity;

use function count;
use function in_array;
use function is_array;

/**
 * Фильтр возвращаемых данных.
 *
 * Значения фильтра может содержать числа, строки или имена полей.
 * Для указания поля в качестве значения фильтра, его необходимо указывать в таком формате: 'Field:{Имя_поля}'.
 * При сравнении с другим полем нельзя использовать операторы BETWEEN, REGEXP и NOT_REGEXP.
 *
 * @link https://topvisor.com/ru/api/v2/basic-params/filters/
 */
class Filter extends Entity
{
    /** @var string равно указанному значению (=) */
    public const OP_EQUALS = 'EQUALS';

    /** @var string не равно указанному значению (!=) */
    public const OP_NOT_EQUALS = 'NOT_EQUALS';

    /** @var string есть в указанных значениях (IN()) */
    public const OP_IN = 'IN';

    /** @var string нет в указанных значениях (NOT IN()) */
    public const OP_NOT_IN = 'NOT_IN';

    /** @var string больше, чем указанное значение (>) */
    public const OP_GREATER_THAN = 'GREATER_THAN';

    /** @var string больше или равно указанному значению (>=) */
    public const OP_GREATER_THAN_EQUALS = 'GREATER_THAN_EQUALS';

    /** @var string меньше, чем указанное значение (<) */
    public const OP_LESS_THAN = 'LESS_THAN';

    /** @var string меньше или равно указанному значению (<=) */
    public const OP_LESS_THAN_EQUALS = 'LESS_THAN_EQUALS';

    /**
     * @var string в промежутке между значениями 1 и 2 (BETWEEN).
     * Последовательно можно перечислять несколько промежутков:
     * [10,20,50,100]; // 10..20 или 50..100
     */
    public const OP_BETWEEN = 'BETWEEN';

    /** @var string начинается с указанного значения (LIKE '%_') */
    public const OP_STARTS_WITH = 'STARTS_WITH';

    /** @var string содержит подстроку с указанным значением (LIKE '%_%') */
    public const OP_CONTAINS = 'CONTAINS';

    /** @var string не содержит подстроку с указанным значением NOT LIKE '%_%' */
    public const OP_DOES_NOT_CONTAIN = 'DOES_NOT_CONTAIN';

    /** @var string удовлетворяет указанному регулярному выражению (REGEXP()) */
    public const OP_REGEXP = 'REGEXP';

    /** @var string не удовлетворяет указанному регулярному выражению (NOT REGEXP()) */
    public const OP_NOT_REGEXP = 'NOT_REGEXP';

    /** @var string поле установлено в NULL (IS NULL) */
    public const OP_IS_NULL = 'IS_NULL';

    /** @var string поле не установлено в NULL (IS NOT NULL) */
    public const OP_IS_NOT_NULL = 'IS_NOT_NULL';

    /** @var string[] */
    public const OP = [
        self::OP_EQUALS => '=',
        self::OP_NOT_EQUALS => '!=',
        self::OP_IN => 'in',
        self::OP_NOT_IN => 'not in',
        self::OP_GREATER_THAN => '>',
        self::OP_GREATER_THAN_EQUALS => '>=',
        self::OP_LESS_THAN => '<',
        self::OP_LESS_THAN_EQUALS => '<=',
        self::OP_BETWEEN => 'between',
        self::OP_STARTS_WITH => 'starts',
        self::OP_CONTAINS => 'contains',
        self::OP_DOES_NOT_CONTAIN => '!contains',
        self::OP_REGEXP => '=~',
        self::OP_NOT_REGEXP => '!~',
        self::OP_IS_NULL => 'null',
        self::OP_IS_NOT_NULL => '!null'
    ];

    /** @var string имя поля */
    public $name;

    /** @var string оператор сравнения */
    public $operator;

    /** @var string[]|string массив со значениями фильтра */
    public $values;

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            ['name', 'trim'],
            ['name', 'required'],

            ['operator', 'required'],
            ['operator', 'in', 'range' => array_keys(self::OP)],

            ['values', 'default', 'value' => []],
            ['values', function(string $attribute) {
                static $opNoOperand = [
                    self::OP_IS_NULL, self::OP_IS_NOT_NULL
                ];

                static $opSingleOperand = [
                    self::OP_EQUALS, self::OP_NOT_EQUALS, self::OP_GREATER_THAN, self::OP_GREATER_THAN_EQUALS,
                    self::OP_LESS_THAN, self::OP_LESS_THAN_EQUALS, self::OP_CONTAINS, self::OP_DOES_NOT_CONTAIN,
                    self::OP_REGEXP, self::OP_NOT_REGEXP
                ];

                if ($this->values === null || $this->values === '') {
                    $this->values = [];
                } elseif (! is_array($this->values)) {
                    $this->values = [$this->values];
                }

                if (in_array($this->operator, $opNoOperand)) {
                    /** @noinspection NotOptimalIfConditionsInspection */
                    if (! empty($this->values)) {
                        $this->addError($attribute, 'Оператор не требует операндов');
                    }
                } elseif (in_array($this->operator, $opSingleOperand)) {
                    if (count($this->values) !== 1) {
                        $this->addError($attribute, 'Оператор требует один операнд');
                    }
                } elseif (empty($this->values)) {
                    $this->addError($attribute, 'Оператор требует наличие операндов');
                }
            }]
        ];
    }
}

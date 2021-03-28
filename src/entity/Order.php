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

use const SORT_ASC;
use const SORT_DESC;

/**
 * Порядок сортировки.
 *
 * @link https://topvisor.com/ru/api/v2/basic-params/orders/?activeTab=fields-2
 */
class Order extends TopVisorEntity
{
    /** @var string по возрастанию */
    public const DIRECTION_ASC = 'ASC';

    /** @var string по убыванию */
    public const DIRECTION_DESC = 'DESC';

    /** @var string название поля */
    public $name;

    /** @var string направление сортировки */
    public $direction;

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            ['name', 'trim'],
            ['name', 'required'],

            ['direction', 'default', 'value' => self::DIRECTION_ASC],
            ['direction', 'filter', 'filter' => static fn($val) => $val === SORT_ASC ? self::DIRECTION_ASC :
                ($val === SORT_DESC ? self::DIRECTION_DESC : $val)],
            ['direction', 'in', 'range' => [self::DIRECTION_ASC, self::DIRECTION_DESC]]
        ];
    }
}

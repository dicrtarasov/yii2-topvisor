<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.03.21 02:20:34
 */

declare(strict_types = 1);
namespace dicr\topvisor;

use dicr\json\EntityValidator;
use dicr\topvisor\entity\Filter;
use dicr\topvisor\entity\Order;

use function array_map;
use function array_merge;
use function array_unique;
use function is_array;

/**
 * Запрос списка данных TopVisor
 */
abstract class GetRequest extends TopVisorRequest
{
    /** @var ?int фильтр объектов по id */
    public $id;

    /** @var string[]|null список полей в select для возврата */
    public $fields;

    /** @var Filter[]|null список фильтров запроса */
    public $filters;

    /** @var Order[]|null порядок сортировки */
    public $orders;

    /** @var ?int смещение данных (по-умолчанию 0) */
    public $offset;

    /** @var ?int лимит данных (по-умолчанию 10 000) */
    public $limit;

    /**
     * @inheritDoc
     */
    public function attributeEntities(): array
    {
        return array_merge(parent::attributeEntities(), [
            'filters' => [Filter::class],
            'orders' => [Order::class]
        ]);
    }

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            ['id', 'default'],
            ['id', 'integer', 'min' => 1],
            ['id', 'filter', 'filter' => 'intval', 'skipOnEmpty' => true],

            ['fields', 'default'],
            ['fields', function(string $attribute) {
                if (empty($this->fields)) {
                    $this->fields = null;
                } elseif (is_array($this->fields)) {
                    $this->fields = array_unique(array_map('\strval', $this->fields));
                    sort($this->fields); // для кэширование подобных запросов выравниваем данные
                } else {
                    $this->addError($attribute, 'Должен быть массивом');
                }
            }],

            [['filters', 'orders'], 'default'],
            [['filters', 'orders'], EntityValidator::class, 'skipOnEmpty' => true],

            ['offset', 'default'],
            ['offset', 'integer', 'min' => 0],
            ['offset', 'filter', 'filter' => 'intval', 'skipOnEmpty' => true],

            ['limit', 'default'],
            ['limit', 'integer', 'min' => 1, 'max' => 10000],
            ['limit', 'filter', 'filter' => 'intval', 'skipOnEmpty' => true]
        ]);
    }
}

<?php /*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.03.21 02:23:35
 */

/** @noinspection ClassOverridesFieldOfSuperClassInspection */

declare(strict_types = 1);
namespace dicr\topvisor;

use dicr\topvisor\entity\Error;

/**
 * Ответ TopVisor
 */
class TopVisorResponse extends Entity
{
    /** @var ?array результат запроса */
    public $result;

    /** @var Error[]|null массив ошибок */
    public $errors;

    /**
     * @inheritDoc
     */
    public function attributeEntities(): array
    {
        return array_merge(parent::attributeEntities(), [
            'errors' => [Error::class]
        ]);
    }
}

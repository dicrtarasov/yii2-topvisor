<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 11.05.21 12:45:17
 */

declare(strict_types = 1);
namespace dicr\topvisor\request;

use dicr\topvisor\entity\Group;
use dicr\topvisor\GetDataResponse;

/**
 * Ответ на запрос списка групп.
 *
 * @property Group[]|null $result
 */
class GetGroupsResponse extends GetDataResponse
{
    /**
     * @inheritDoc
     */
    public function attributeEntities(): array
    {
        return array_merge(parent::attributeEntities(), [
            'result' => [Group::class]
        ]);
    }
}

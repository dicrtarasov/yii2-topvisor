<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 29.03.21 02:20:34
 */

declare(strict_types = 1);
namespace dicr\topvisor\entity;

use dicr\topvisor\GetResponse;

/**
 * Ответ на запрос списка папок.
 *
 * @property Folder[]|null $result
 */
class GetFoldersResponse extends GetResponse
{
    /**
     * @inheritDoc
     */
    public function attributeEntities(): array
    {
        return array_merge(parent::attributeEntities(), [
            'result' => [Folder::class]
        ]);
    }
}

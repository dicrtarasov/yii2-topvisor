<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 11.05.21 12:45:17
 */

declare(strict_types = 1);
namespace dicr\topvisor\request;

use dicr\topvisor\entity\HistoryResult;
use dicr\topvisor\GetDataResponse;

use function array_merge;

/**
 * Class GetHistoryResponse
 *
 * @property ?HistoryResult $result
 */
class GetHistoryResponse extends GetDataResponse
{
    /**
     * @inheritDoc
     */
    public function attributeEntities(): array
    {
        return array_merge(parent::attributeEntities(), [
            'result' => HistoryResult::class
        ]);
    }
}

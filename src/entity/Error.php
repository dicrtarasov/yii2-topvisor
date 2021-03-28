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
 * Информация об ошибке.
 */
class Error extends TopVisorEntity
{
    /** @var int */
    public $code;

    /** @var string текст ошибки */
    public $string;

    /** @var ?string подробное описание */
    public $detail;

    /**
     * Преобразование в строку.
     *
     * @return string
     */
    public function __toString(): string
    {
        $s = $this->code . ': ' . $this->string;
        if (! empty($this->detail)) {
            $s .= ': ' . $this->detail;
        }

        return $s;
    }
}

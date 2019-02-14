<?php
/**
 * Created by PhpStorm.
 * User: mt
 * Date: 13.02.2019
 * Time: 23:46
 */

namespace App\Abstracts;


interface APInterface
{
    public function getAmountFromSymbol(string $symbol): float ;

    public function getUsd(): float;

    public function getGbp(): float;

    public function getEuro(): float;

    public function setProvider(string $provider): void;

}

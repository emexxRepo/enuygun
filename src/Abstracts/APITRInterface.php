<?php
/**
 * Created by PhpStorm.
 * User: mt
 * Date: 13.02.2019
 * Time: 23:46
 */

namespace App\Abstracts;


interface APITRInterface
{
    public function getirKod(string $symbol): float ;

    public function getirDolar(): float;

    public function getirSterlin(): float;

    public function getirAvro(): float;

    public function varsayilanSaglayici(string $provider): void;



}

<?php
/**
 * Created by PhpStorm.
 * User: mt
 * Date: 14.02.2019
 * Time: 04:00
 */

namespace App\Adapter;


use App\Abstracts\APInterface;
use App\Abstracts\APITRInterface;

class TRMoneyAdapter implements APInterface
{
    private $service;

    /**
     * TRMoneyAdapter constructor.
     * @param APITRInterface $serviceTurkish
     */
    public function __construct(APITRInterface $serviceTurkish)
    {
        $this->service = $serviceTurkish;
    }

    /**
     * @param string $symbol
     * @return float
     */
    public function getAmountFromSymbol(string $symbol): float
    {
        return $this->service->getirKod($symbol);
    }

    /**
     * @return float
     */
    public function getUsd(): float
    {
        return $this->service->getirDolar();
    }

    /**
     * @return float
     */
    public function getGbp(): float
    {
        return $this->service->getirSterlin();
    }

    /**
     * @return float
     */
    public function getEuro(): float
    {
        return $this->service->getirAvro();
    }

    /**
     * @param string $provider
     */
    public function setProvider(string $provider): void
    {
         $this->service->varsayilanSaglayici($provider);
    }
}

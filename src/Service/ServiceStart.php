<?php
/**
 * Created by PhpStorm.
 * User: murat
 * Date: 14.02.2019
 * Time: 14:30
 */

namespace App\Service;


use App\Adapter\TRMoneyAdapter;

class ServiceStart
{
    private $services;
    /**
     * @param MoneyServiceTurkish $trservice
     * @param MoneyServiceTurkishv2 $trservice2
     * @param MoneyServiceEnglish $enservice
     */
    public function __construct(
        MoneyServiceTurkish $trservice,
        MoneyServiceTurkishv2 $trservice2,
        MoneyServiceEnglish $enservice)
    {
        $trServiceAdapter = new TRMoneyAdapter($trservice);
        $trServiceAdapter->setProvider('5a74524e2d0000430bfe0fa3');

        $trServiceV2Adapter = new TRMoneyAdapter($trservice2);
        $trServiceV2Adapter->setProvider('5c650a893300007812b99a8d');

        $enservice->setProvider('5a74519d2d0000430bfe0fa0');

        $this->services = [
            'trService1' => $trServiceAdapter,
            'trService2' => $trServiceV2Adapter,
            'enService' => $enservice,
        ];

    }

    public function getServices(): array
    {
        return $this->services;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: murat
 * Date: 14.02.2019
 * Time: 14:34
 */

namespace App\Service;

class ServiceFacade
{
    private $serviceStart;

    private $comparisonService;

    private $httpRequestService;

    public function __construct()
    {
        $this->httpRequestService = new HttpRequestService();
        $moneyServiceTurkish = new MoneyServiceTurkish($this->httpRequestService);
        $moneyServiceTurkishv2 = new MoneyServiceTurkishv2($this->httpRequestService);
        $moneyServiceEnglish = new MoneyServiceEnglish($this->httpRequestService);
        $this->serviceStart = new ServiceStart($moneyServiceTurkish, $moneyServiceTurkishv2, $moneyServiceEnglish);
        $this->comparisonService = new ComparisonService();
        $this->comparisonService->setServices($this->serviceStart->getServices());
    }

    public function comparision(): array
    {
        return $this->comparisonService->comparision();
    }

}
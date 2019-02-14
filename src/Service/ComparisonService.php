<?php
/**
 * Created by PhpStorm.
 * User: murat
 * Date: 14.02.2019
 * Time: 12:11
 */

namespace App\Service;

use App\Abstracts\APInterface;
use App\Abstracts\ServiceInterface;
use App\Adapter\TRMoneyAdapter;

class ComparisonService
{
    private $cheapsets = [];

    private $services = [];

    public function comparision(): array
    {
        $this->setTempData();

        foreach ($this->services as $key => $service) {

            if ($service->getUsd() < $this->cheapsets['usd']){
                $this->cheapsets['usd'] = $service->getUsd();
            }

            if ($service->getEuro() < $this->cheapsets['euro']){
                $this->cheapsets['euro'] = $service->getEuro();
                $this->cheapsets['eurofrom'] = $key;
            }

            if ($service->getGbp() < $this->cheapsets['gbp']){
                $this->cheapsets['gbp'] = $service->getGbp();
                $this->cheapsets['gbpfrom'] = $key;
            }

        }

        return $this->cheapsets;
    }

    private function setTempData(): void
    {
        $this->cheapsets['usd'] = $this->services['trService1']->getUsd();
        $this->cheapsets['usdfrom'] = 'trService1';
        $this->cheapsets['euro'] = $this->services['trService1']->getEuro();
        $this->cheapsets['eurofrom'] = 'trService1';
        $this->cheapsets['gbp'] = $this->services['trService1']->getGbp();
        $this->cheapsets['gbpfrom'] = 'trService1';

    }

    public function setServices(array $services): void
    {
        if(!empty($services)){
            foreach ($services as $key => $service){
                if (!($service instanceof ServiceInterface)){
                    throw new \Exception('Has to implement Service Interface');
                }
            }
        }
        $this->services = $services;
    }
}
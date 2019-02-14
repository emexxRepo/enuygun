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
            if ($key === 'trService1')
                continue;

            foreach ($this->cheapsets as $keyCheapsets => $cheapsets) {

                if ($cheapsets['name'] === 'usd' && $service->getUsd() < $cheapsets['value']) {
                    $this->cheapsets[$keyCheapsets]['value'] = $service->getUsd();
                    $this->cheapsets[$keyCheapsets]['from'] = $key;
                }

                if ($cheapsets['name'] === 'gbp' && $service->getUsd() < $cheapsets['value']) {
                    $this->cheapsets[$keyCheapsets]['value'] = $service->getGbp();
                    $this->cheapsets[$keyCheapsets]['from'] = $key;
                }

                if ($cheapsets['name'] === 'euro' && $service->getUsd() < $cheapsets['value']) {
                    $this->cheapsets[$keyCheapsets]['value'] = $service->getEuro();
                    $this->cheapsets[$keyCheapsets]['from'] = $key;
                }
            }

        }

        return $this->cheapsets;
    }

    private function setTempData(): void
    {
        $this->cheapsets[] = ['name' => 'usd', 'value' => $this->services['trService1']->getUsd(), 'from' => 'trService1'];
        $this->cheapsets[] = ['name' => 'euro', 'value' => $this->services['trService1']->getEuro(), 'from' => 'trService1'];
        $this->cheapsets[] = ['name' => 'gbp', 'value' => $this->services['trService1']->getGbp(), 'from' => 'trService1'];

    }

    public function setServices(array $services): void
    {
        if (!empty($services)) {
            foreach ($services as $key => $service) {
                if (!($service instanceof ServiceInterface)) {
                    throw new \Exception('Has to implement Service Interface');
                }
            }
        }
        $this->services = $services;
    }


    public function other()
    {

        if ($service->getUsd() < $this->cheapsets['usd']) {
            $this->cheapsets['usd'] = $service->getUsd();
        }

        if ($service->getEuro() < $this->cheapsets['euro']) {
            $this->cheapsets['euro'] = $service->getEuro();
            $this->cheapsets['eurofrom'] = $key;
        }

        if ($service->getGbp() < $this->cheapsets['gbp']) {
            $this->cheapsets['gbp'] = $service->getGbp();
            $this->cheapsets['gbpfrom'] = $key;
        }
    }
}

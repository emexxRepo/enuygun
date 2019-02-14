<?php
/**
 * Created by PhpStorm.
 * User: mt
 * Date: 13.02.2019
 * Time: 23:54
 */

namespace App\Service;


use App\Abstracts\APInterface;

class MoneyServiceEnglish implements APInterface
{
    private $data;
    private $provider;
    private $client;
    private $keys = ['USDTRY','EURTRY','GBPTRY'];

    /**
     * MoneyServiceTurkish constructor.
     * @param HttpRequestService $client
     */
    public function __construct(HttpRequestService $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $symbol
     * @return float
     * @throws \Exception
     */
    public function getAmountFromSymbol(string $symbol): float
    {
        $symbol = trim($symbol);

        if (!in_array($symbol,$this->keys))
            throw new \Exception('please enter the correct name');

        $key = array_search($symbol, $this->keys, true);

        return $this->data['result'][$key]['amount'];
    }

    /**
     * @return float
     */
    public function getEuro(): float
    {
        return $this->data['result'][1]['amount'];
    }

    /**
     * @return float
     */
    public function getGbp(): float
    {
        return $this->data['result'][2]['amount'];
    }

    /**
     * @return float
     */
    public function getUsd(): float
    {
        return $this->data['result'][0]['amount'];
    }

    /**
     * @throws \Exception
     */
    private function sendRequest(): void
    {
        $this->data =  $this->client->getData($this->getProvider());
    }

    /**
     * @param string $provider
     */
    public function setProvider(string $provider): void
    {
        $this->provider = $provider;
        $this->sendRequest();
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function getProvider(): string
    {
        if (empty($this->provider))
            throw new \Exception("Please Set the provider");
        return $this->provider;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: mt
 * Date: 13.02.2019
 * Time: 23:54
 */

namespace App\Service;


use App\Abstracts\APITRInterface;

class MoneyServiceTurkishv2 implements APITRInterface
{
    private $data;
    private $provider;
    private $client;
    private $keys = ['dollar-tr','euro-tr','sterlin-tr'];

    /**
     * MoneyServiceTurkishv2 constructor.
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
    public function getirKod(string $symbol): float
    {
        $symbol = trim($symbol);

        if (!in_array($symbol,$this->keys))
            throw new \Exception('please enter the correct name');

        $key = array_search($symbol, $this->keys, true);

        return $this->data[$key]['mn'];
    }

    /**
     * @return float
     */
    public function getirAvro(): float
    {
        return $this->data[1]['mn'];
    }

    /**
     * @return float
     */
    public function getirSterlin(): float
    {
        return $this->data[2]['mn'];
    }
        
    /**
     * @return float
     */
    public function getirDolar(): float
    {
        return $this->data[0]['mn'];
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
    public function varsayilanSaglayici(string $provider): void
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
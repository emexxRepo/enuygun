<?php
/**
 * Created by PhpStorm.
 * User: mt
 * Date: 14.02.2019
 * Time: 02:18
 */

namespace App\Service;

use GuzzleHttp\Client;

class HttpRequestService
{
    private $client;

    //KUSURA BAKMAYIN GUZZLE DEPENDENCY INJECTION YAPAMADIM ÇOK AZ SYMFONY BİLİYORUM

    /**
     * HttpRequestService constructor.
     */
    public function __construct()
    {
        $this->client =  new Client([
            'base_uri' => 'http://www.mocky.io/v2/',
            'timeout'  => 2.0,
        ]);
    }

    /**
     * @param string $url
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getData(string $url): array
    {
        $response = $this->client->request('GET', $url);
        return \GuzzleHttp\json_decode($response->getBody(),true);
    }

}

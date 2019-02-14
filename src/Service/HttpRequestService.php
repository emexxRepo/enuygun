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

    private $data = [];


    //KUSURA BAKMAYIN GUZZLE DEPENDENCY INJECTION YAPAMADIM ÇOK AZ SYMFONY BİLİYORUM

    /**
     * HttpRequestService constructor.
     */
    public function __construct()
    {
        $this->client =  new Client([
            'base_uri' => 'http://www.mocky.io/v2/',
            'timeout'  => 5.5,
        ]);
    }

    /**
     * @param string $url
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getData(string $url): array
    {
        $promise = $this->client->request('GET', $url);
        return \GuzzleHttp\json_decode($promise->getBody(),true);

        /*$promise = $this->client->requestAsync('GET',$url)->then(function (Response $response) {
             $this->data =  \GuzzleHttp\json_decode($response->getBody(),true);
        });
        $promise->wait();
        return $this->data;*/

    }

}

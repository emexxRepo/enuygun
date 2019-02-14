<?php
namespace App\Controller;

use App\Adapter\TRMoneyAdapter;
use App\Service\MoneyServiceEnglish;
use App\Service\MoneyServiceTurkish;
use App\Service\MoneyServiceTurkishv2;
use App\Service\ServiceFacade;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    /**
     * @Route("/provider1", name="p1")
     */
    public function index(MoneyServiceEnglish $service,MoneyServiceTurkish $trservice)
    {
        echo "<hr>";
        $service->setProvider('5a74519d2d0000430bfe0fa0');
        var_dump($service->getUsd());
        var_dump($service->getGbp());
        var_dump($service->getEuro());
        echo "<hr>";
        $trservice->varsayilanSaglayici('5a74524e2d0000430bfe0fa3');
        echo "<hr>";
        var_dump($trservice->getirKod('AVRO'));
        var_dump($trservice->getirKod('İNGİLİZ STERLİNİ'));
        var_dump($trservice->getirKod('DOLAR'));
        echo "<hr>";

        echo "<hr> <br> <h1>TEST</h1>";
        echo "<hr>";
        return new Response('');
        }

     /**
     * @Route("/provider2", name="provider2")
     */
    public function index2(MoneyServiceTurkish $moneyServiceTurkish)
    {
        $service = new TRMoneyAdapter($moneyServiceTurkish);

        $service->setProvider('5a74524e2d0000430bfe0fa3');
        var_dump($service->getUsd());
        var_dump($service->getEuro());
        var_dump($service->getGbp());
        return new Response('');
    }


    /**
     * @Route("/provider3", name="provider3")
     */
    public function index3(MoneyServiceTurkishv2 $moneyServiceTurkishv2)
    {
        $service = new TRMoneyAdapter($moneyServiceTurkishv2);
        $service->setProvider('5c650a893300007812b99a8d');
        var_dump($service->getEuro());
        var_dump($service->getGbp());
        var_dump($service->getUsd());
        return new Response('');
    }


    /**
     * @Route("/testservice", name="testservice")
     */
    public function testservice(ServiceFacade $serviceFacade)
    {
       print_r($serviceFacade->comparision());

       return new Response('');

    }
}
<?php
namespace App\Controller;

use App\Adapter\TRMoneyAdapter;
use App\Service\MoneyServiceEnglish;
use App\Service\MoneyServiceTurkish;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    /**
     * @Route("/index1", name="1")
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
     * @Route("/index2", name="index2")
     */
    public function index2(TRMoneyAdapter $moneyServiceTurkish)
    {
        $moneyServiceTurkish->setProvider('5a74524e2d0000430bfe0fa3');
        var_dump($moneyServiceTurkish->getUsd());
        var_dump($moneyServiceTurkish->getEuro());
        var_dump($moneyServiceTurkish->getGbp());

        return new Response('');

    }
}

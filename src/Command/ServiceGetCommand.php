<?php

namespace App\Command;

use App\Entity\ExchangeRate;
use App\Service\ServiceFacade;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ServiceGetCommand extends Command
{
    protected static $defaultName = 'app:service:get';

    private $entityManager;

    public function __construct(?string $name = null, EntityManagerInterface $entityManager)
    {
        parent::__construct($name);

        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Konsol yardımıyla servisten veri çekebilir ve veritabanına yazabilirsiniz');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {


        $io = new SymfonyStyle($input, $output);
        $val = $io->choice('Servislerden kurları getirmek istermisin ? ', ['hayır', 'evet'], 'hayır');

        if ($val !== 'evet') {
            $io->error('NO DATA');
            exit;
        }

        $serviceFacade = new ServiceFacade();
        $data = $serviceFacade->comparision();
        $newData = [];
        $newKey = [];

        if (count($data) < 1) {
            $io->error('Servislerden Data gelmedi');
        }

        $io->title('Servislerdeki en ucuz Kur Listesi');

        foreach ($data as $key => $value) {

            $exchangeRate = new ExchangeRate();
            foreach ($value as $vkey => $val) {
                if ($vkey === 'name') {
                    $exchangeRate->setName($val);
                }

                if ($vkey === 'value') {
                    $newData[] = $val;
                    $exchangeRate->setValue($val);
                }

                if ($vkey === 'from') {
                    $exchangeRate->setService($val);
                    $newKey[] = $val;
                }

            }

            $this->entityManager->persist($exchangeRate);
            $this->entityManager->flush();
        }


        $io->table(['USD', 'EURO', 'GBP'], [$newKey, $newData]);

        $io->success('Success');


    }

}

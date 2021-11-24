<?php

namespace App\Command;

use App\Service\WeatherUtil;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class IdCommand extends Command
{
    protected static $defaultName = 'id:command';
    protected static $defaultDescription = 'Add a short description for your command';

    private $weatherUtil;

    public function __construct(WeatherUtil $weatherUtil)
    {
        $this->weatherUtil = $weatherUtil;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('cityId', InputArgument::REQUIRED, 'City ID')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $city = $input->getArgument('cityId');

        $measurements = $this->weatherUtil->getWeatherForLocation($city);

        foreach($measurements as $m)
        {
            $output->writeln($m->getDate()->format('Y-m-d') . ": " . $m->getTemperature());
        }

        return 0;
    }
}


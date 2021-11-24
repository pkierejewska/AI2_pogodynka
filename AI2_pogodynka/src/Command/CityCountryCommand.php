<?php

namespace App\Command;

use App\Service\WeatherUtil;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CityCountryCommand extends Command
{
    protected static $defaultName = 'city_country:command';
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
            ->addArgument('countryCode', InputArgument::REQUIRED, 'Country code')
            ->addArgument('cityName', InputArgument::REQUIRED, 'City name')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $countryCode = $input->getArgument('countryCode');
        $cityName = $input->getArgument('cityName');

        $measurements = $this->weatherUtil->getWeatherForCountryAndCity($countryCode, $cityName);

        $output->writeln('Temperatures:');

        foreach($measurements as $m)
        {
            $output->writeln($m->getDate()->format('Y-m-d') . ": " . $m->getTemperature());
        }

        return 0;
    }
}

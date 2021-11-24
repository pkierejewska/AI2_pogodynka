<?php

namespace App\Service;

use App\Repository\CityRepository;
use App\Entity\City;
use App\Repository\MeasurementRepository;
use App\Entity\Measurement;


class WeatherUtil
{
    private CityRepository $cityRepository;
    private MeasurementRepository $measurementRepository;

    function __construct(CityRepository $cityRepository, MeasurementRepository $measurementRepository)
    {
        $this->cityRepository = $cityRepository;
        $this->measurementRepository = $measurementRepository;
    }

    public function getWeatherForLocation(City $city)
    {
        return $this->measurementRepository->findByLocation($city);
    }

    public function getWeatherForCountryAndCity(string $country, string $city_name)
    {
        $city = $this->cityRepository->findByName($country, $city_name);
        return $this->getWeatherForLocation($city);
    }
}

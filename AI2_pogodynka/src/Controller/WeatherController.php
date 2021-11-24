<?php
namespace App\Controller;

use App\Repository\CityRepository;
use App\Service\WeatherUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\City;
use App\Repository\MeasurementRepository;

class WeatherController extends AbstractController
{
    public function indexAction(): Response
    {
        return $this->render('base.html.twig');
    }

    //service
    public function weatherUtilCityCountryAction(string $country, string $city_name, WeatherUtil $util): Response
    {
        return $this->render('weather/city.html.twig', [
            'name' => $city_name,
            'country' => $country,
            'measurements' => $util->getWeatherForCountryAndCity($country, $city_name),
        ]);
    }

    public function weatherUtilCityAction(City $city, WeatherUtil $util): Response
    {
        return $this->render('weather/city.html.twig', [
            'name' => $city->getName(),
            'country' => $city->getCountry(),
            'measurements' => $util->getWeatherForLocation($city),
        ]);
    }

    //doctrine
    public function defaultCityAction(City $city, MeasurementRepository $measurementRepository): Response
    {
        $measurements = $measurementRepository->findByLocation($city);

        return $this->render('weather/city.html.twig', [
            'location' => $city,
            'measurements' => $measurements,
        ]);
    }

    public function cityAction(string $country, string $city_name, MeasurementRepository $measurementRepository, CityRepository $cityRepository): Response
    {
        $city = $cityRepository->findByName($country, $city_name);
        $measurements = $measurementRepository->findByLocation($city);

        return $this->render('weather/city.html.twig', [
            'location' => $city,
            'measurements' => $measurements,
        ]);
    }

}
<?php
namespace App\Controller;

use App\Repository\CityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\City;
use App\Repository\MeasurementRepository;

class WeatherController extends AbstractController
{
    /*
    public function cityAction(City $city, MeasurementRepository $measurementRepository): Response
    {
        $measurements = $measurementRepository->findByLocation($city);

        return $this->render('weather/city.html.twig', [
            'location' => $city,
            'measurements' => $measurements,
        ]);
    }
    */

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
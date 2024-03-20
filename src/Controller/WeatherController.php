<?php 

declare(strict_types=1);

namespace App\Controller;

use App\Exception\LocationNotFoundException;
use App\Service\ForecastService;
use App\Repository\ForecastRepository;
use App\Repository\LocationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;




class WeatherController extends AbstractController
{
    #[Route("/weather/{countryCode}/{city}")]
    public function forecast(
        ForecastService $forecastService,
        string $countryCode, 
        string $city
        ) : Response
    {
        try {
            list($location, $forecasts) = $forecastService->getForecastForLocationName($countryCode, $city); 
        } catch (LocationNotFoundException $e){
            throw $this->createNotFoundException('Location not found');
        }

        $response = $this->render('weather/forecast.html.twig', [
            'forecasts' => $forecasts,   
            'location' => $location, 
        ]);
        

        return $response;
    }
}
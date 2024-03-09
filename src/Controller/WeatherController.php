<?php 

declare(strict_types=1);

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;




class WeatherController extends AbstractController
{
    #[Route("/weather/{countryCode}/{city}")]
    public function forecast(string $countryCode, string $city) : Response
    {
        $forecasts = [
            [
            "date" => new \DateTime('2024-01-01'),
            "temperatureCelsius" => 17,
            "flTemperature" => 16,
            "pressure" => 1010,
            "humidity" => 65,
            "wind_speed" => 3.2,
            "wind_deg" => 270,
            "cloudiness" => 75,
            "icon" => 'sun',
            ],
            [
            "date" => new \DateTime('2024-01-02'),
            "temperatureCelsius" => 12,
            "flTemperature" => 13,
            "pressure" => 1000,
            "humidity" => 64,
            "wind_speed" => 3.2,
            "wind_deg" => 270,
            "cloudiness" => 75,
            "icon" => 'cloud',
            ],
            [
            "date" => new \DateTime('2024-01-03'),
            "temperatureCelsius" => 16,
            "flTemperature" => 16,
            "pressure" => 1001,
            "humidity" => 65,
            "wind_speed" => 3.3,
            "wind_deg" => 270,
            "cloudiness" => 75,
            "icon" => 'cloud-rain',
            ],

        ];

        $response = $this->render('weather/forecast.html.twig', [
            'forecasts' => $forecasts,   
            'city' => $city,
            'countryCode' => $countryCode,
        ]);
        

        return $response;
    }
}
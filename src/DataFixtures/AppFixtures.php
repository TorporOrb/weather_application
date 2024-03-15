<?php

namespace App\DataFixtures;

use App\Entity\Forecast;
use App\Entity\Location;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $barcelona = $this->addLocation(
            $manager, 
            'Barcelona', 
            "ES", 
            41.3874, 
            2.1686,
        );  
        $berlin = $this->addLocation(
            $manager, 
            'Berlin', 
            "DE", 
            52.5200, 
            13.4050,            
        );     
        $stettin = $this->addLocation(
            $manager, 
            'Stettin', 
            "PL", 
            53.4285, 
            14.5528,            
        );  

        $manager->flush();

        // Barcelona
        $this->addForecast(
            $manager,
            '2024-04-01',
            "Barcelona",
            23, 25, 1009, 49, 7.7, 90, 0, 
            "sun",            
        );
        $this->addForecast(
            $manager,
            '2024-04-02',
            "Barcelona",
            21, 20, 199, 50, 7.8, 92, 1, 
            "cloud",            
        );
        $this->addForecast(
            $manager,
            '2024-04-03',
            "Barcelona",
            24, 25, 198, 51, 7.5, 89, 2, 
            "sun",            
        );

        // Berlin
        $this->addForecast(
            $manager,
            '2024-04-01',
            "Berlin",
            24, 25, 198, 51, 7.5, 89, 2, 
            "sun",            
        );
        $this->addForecast(
            $manager,
            '2024-04-02',
            "Berlin",
            23, 20, 196, 59, 6.5, 79, 3, 
            "cloud-sun",            
        );
        $this->addForecast(
            $manager,
            '2024-04-03',
            "Berlin",
            24, 25, 198, 51, 7.5, 89, 2, 
            "cloud",            
        );
        // Stettin
        $this->addForecast(
            $manager,
            '2024-04-01',
            "Stettin",
            20, 19, 194, 51, 7.5, 89, 2, 
            "cloud",            
        );
        $this->addForecast(
            $manager,
            '2024-04-02',
            "Stettin",
            19, 20, 186, 59, 5.5, 79, 3, 
            "cloud-sun",            
        );
        $this->addForecast(
            $manager,
            '2024-04-03',
            "Stettin",
            18, 17, 166, 41, 7.9, 79, 1, 
            "cloud",            
        );


        $manager->flush();
    }

    private function addLocation(
        ObjectManager $manager, 
        $name, 
        $countryCode, 
        $latitude, 
        $longitude): Location
    {
        $location = new Location();
        $location
            ->setName($name)
            ->setCountryCode($countryCode)
            ->setLatitude($latitude)
            ->setLongitude($longitude)
        ;
        $manager->persist($location);

        return $location;
        
    }

    private function addForecast(
        ObjectManager $manager, 
        string $date, 
        string $locationName, 
        int $temp,
        int $fltemp,
        int $pressure,
        int $humidity,
        float $windSpeed,
        int $windDeg,
        int $cloudiness,
        string $icon,

        ): Forecast
    {
        $location = $manager->getRepository(Location::class)->findOneBy(['name' => $locationName]);
        
        $forecast = new Forecast();
        $forecast
            ->setDate(new \DateTime($date))
            ->setLocation($location)
            ->setTemperatureCelsius($temp)
            ->setFLTemperatureCelsius($fltemp)
            ->setPressure($pressure)
            ->setHumidity($humidity) 
            ->setWindSpeed($windSpeed)
            ->setWindDeg($windDeg)
            ->setCloudiness($cloudiness)
            ->setIcon($icon)
        ;
        $manager->persist($forecast);

        return $forecast;
    }
}

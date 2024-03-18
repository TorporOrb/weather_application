<?php

namespace App\Form;

use App\Entity\Forecast;
use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ForecastType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('temperatureCelsius')
            ->add('flTemperatureCelsius')
            ->add('pressure')
            ->add('humidity')
            ->add('windSpeed')
            ->add('windDeg')
            ->add('cloudiness')
            ->add('icon', ChoiceType::class, [
                'choices' => [
                    '(choose)' => '',
                    'Sun' => 'sun',
                    'Cloudy' => 'cloud',
                    'Cloudy with Rain' => 'cloud-rain',
                    'Cloudy with Sun' => 'cloud-sun',
                    'Hail' => 'cloud-hail',
                    'Snow' => 'cloud-snow',
                    'Sleet' => 'cloud-sleet',
                    'Thunderstorms' => 'cloud-lightning-rain',
                ]
            ])
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Forecast::class,
        ]);
    }
}

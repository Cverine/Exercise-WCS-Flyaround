<?php

namespace WCS\CoavBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;

class FlightType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('departTerrain', AutocompleteType::class, array(
            'class' => 'WCS\CoavBundle:Flight',
            'choice_label' => 'name',
        ))
                ->add('arrivalTerrain', EntityType::class, array(
                'class' => 'Airport.php',
                'choice_label' => 'name',
            ))
//                ->add('takeOffTime', DateTimeType::class, array(
//                    'widget' => 'choice',
//                    'years' => range(2017, 2020)
//                ))
                ->add('landingTime', DateTimeType::class, array(
                    'widget' => 'choice',
                    'years' => range(2017, 2020)
                ))
                ->add('nbFreeSeats')
                ->add('seatPrice')
                ->add('description')
                ->add('plane_model',EntityType::class, array(
                    'class' => 'WCS\CoavBundle\Entity\PlaneModel',
                    'choice_label' => 'model',
                ))
                ->add('wasDone')
                ->add('takeOffTime', FormType::class, ['widget'=> 'single_text']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WCS\CoavBundle\Entity\Flight'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'wcs_coavbundle_flight';
    }


}

<?php

namespace WCS\CoavBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('userName')
                ->add('password')
                ->add('email')
                ->add('firstName')
                ->add('lastName')
                ->add('phoneNumber')
                ->add('birthDate', BirthdayType::class, array(
                    'widget' => 'choice',
                    'years' => range(2020, 1920)))
                ->add('creationDate')
                ->add('role', ChoiceType::class, array(
                    'choices'   => array(
                    'Pilot'     => 2,
                    'Traveler'  => 1,),
                ))
                ->add('isACertifiedPilot')
                ->add('isActive');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WCS\CoavBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'wcs_coavbundle_user';
    }


}

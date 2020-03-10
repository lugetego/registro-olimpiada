<?php
// src/AppBundle/Form/RegistrationType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Form\SedeType;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre');
        $builder->add('paterno');
//        $builder->add('plantel');
//        $builder->add('gender','Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
//            'choices'  => array(
//                'Female' => 'M',
//                'Male' => 'H',
//            ),
//            'choices_as_values' => true,
//        ));
        $builder->add('materno');
//        $builder->add('municipio');
        $builder->add('celular');

//        $builder->add('affiliation');
//        $builder->add('student', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
//            'choices'  => array(
//                'Yes' => true,
//                'No' => false,
//            ),
//            'choices_as_values' => true,
//        ));
        $builder
            ->add('sede')
            ->add('municipio')
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }



}
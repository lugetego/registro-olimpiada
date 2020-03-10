<?php

namespace App\Form;

use App\Entity\Estudiante;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EstudianteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('paterno')
            ->add('materno')
            ->add('nivel', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType',array(
                'label'=>'Nivel',
                'choices'=>array(
                    'Primaria'=>'Primaria',
                    'Secundaria'=>'Secundaria',
                    'Preparatoria'=>'Preparatoria',
                ),
                'placeholder'=>'Seleccionar',
                'required'=>true,
            ))
            ->add('mail')
            ->add('nacimiento','Symfony\Component\Form\Extension\Core\Type\DateType',array(
                'placeholder' => array(
                    'year' => 'Año',
                    'month' => 'Mes',
                    'day' => 'Día'),
                'years'=> range(2000,2011),
                'label'=>'Fecha de nacimiento',
                'required'=>true,

            ))            ->add('puntuacion')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Estudiante::class,
        ]);
    }
}

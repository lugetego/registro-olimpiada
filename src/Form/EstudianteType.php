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
            ->add('municipio')
            ->add('nivel', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType',array(
                'label'=>'Nivel',
                'choices'=>array(
                    '5to. de primaria'=>'5to. de primaria',
                    '6to. de primaria'=>'6to. de primaria',
                    '1ro. de secundaria'=>'1ro. de secundaria',
                    '2do. de secundaria'=>'2do. de secundaria',
                    '3ro. de secundaria'=>'3ro. de secundaria',
                    '1ro. de preparatoria'=>'1ro. de preparatoria',
                    '2do. de preparatoria'=>'2do. de preparatoria',
                    '3ro. de preparatoria'=>'3ro. de preparatoria',
                ),
                'placeholder'=>'Seleccionar',
                'required'=>true,
            ))
            ->add('mail')
            ->add('plantel')
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

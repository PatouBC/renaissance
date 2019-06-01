<?php

namespace App\Form;

use App\Entity\Workingday;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class WorkingdayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr'=> ['class' => 'js-datepicker'],
                'html5' => false
            ))
            ->add('timeslots', CollectionType::class, array(
                'entry_type' => TimeslotType::class,
                'entry_options'=> array(
                    'label'=> false,
                    'attr'=> array('class'=> 'timeslot')
                ),
                'prototype'=>true,
                'allow_add'=> true,
                'allow_delete'=> true,
                'by_reference'=> false
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Workingday::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Timeslot;
use App\Entity\Workingday;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkingdayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('timeslots', EntityType::class, array(
                'class'=> Timeslot::class,
                'expanded'=>true,
                'multiple'=> true
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

<?php

namespace App\Form;

use App\Entity\Timeslot;
use App\Entity\Typeconsult;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TimeslotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('slot')
            ->add('description')
            ->add('dispo')
            ->add('wait')
            ->add('confirm')
            ->add('typeconsult', EntityType::class, array(
                'class' => Typeconsult::class,
                'expanded'=> true
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Timeslot::class,
        ]);
    }
}

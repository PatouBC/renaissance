<?php

namespace App\Form;

use App\Entity\Timeslot;
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
            ->add('confirmed')
            ->add('user')
            ->add('typeconsult', null, array(
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

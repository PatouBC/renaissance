<?php

namespace App\Form;

use App\Entity\Timeslot;
use App\Entity\Typeconsult;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('user', EntityType::class, array(
                'class' => User::class,
                'placeholder' => 'Choisissez un utilisateur'
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

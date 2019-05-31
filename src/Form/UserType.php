<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label'=> 'Nom'))
            ->add('surname', null, array(
                'label'=> 'Prénom'))
            ->add('username', null, array(
                'label'=> 'Identifiant'))
            ->add('email', null, array(
                'label'=> 'E-mail'))
            ->add('enabled', null, array(
                'label'=> 'Statut'))
            ->add('timeslots', CollectionType::class, array(
                'entry_type' => TimeslotType::class,
                'entry_options'=> array(
                    'label'=>false,
                    'attr'=> array('class' => 'timeslot')
                ),
                'prototype' => true,
                'allow_add' => true,
                'allow_delete'=> true,
                'by_reference' => false
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

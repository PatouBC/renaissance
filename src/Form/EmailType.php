<?php

namespace App\Form;

use App\Entity\Email;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'Nom'
            ))
            ->add('firstname', null, array(
                'label' => 'Prénom'
            ))
            ->add('address', null, array(
                'label' => 'Adresse email'
            ))
            ->add('object', null, array(
                'label' => 'Objet'
            ))
            ->add('message')
            ->add('treated', null, array(
                'label' => 'Traité'
            ))
            ->add('user', null, array(
                'label' => 'Utilisateur'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Email::class,
        ]);
    }
}

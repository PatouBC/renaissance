<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
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
                'label' => 'Adresse mail'
            ))
            ->add('object', null, array(
                'label' => 'Objet'
            ))
            ->add('message', null, array(
                'label' => 'Message'
            ))
            ->add('treated', null, array(
                'label' => 'Traitée'
            ))
            ->add('user', null, array(
                'label' => 'Utilisateur'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}

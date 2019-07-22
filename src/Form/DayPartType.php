<?php

namespace App\Form;

use App\Entity\DayPart;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DayPartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', null, array(
                'label' => 'Statut'
            ))
            ->add('user', null, array (
                'label' => 'Utilisateur'
            ))
            ->add('consult', null, array(
                'label' => 'Type de consultation'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DayPart::class,
        ]);
    }
}

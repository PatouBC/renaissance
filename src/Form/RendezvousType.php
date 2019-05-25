<?php

namespace App\Form;

use App\Entity\Rendezvous;
use App\Entity\Typeconsult;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RendezvousType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('timeslot')
            ->add('confirm')
            ->add('typeconsult', EntityType::class, array(
                'class' => Typeconsult::class,
                'choice_label' => function($typeconsult){
                    return $typeconsult->getDescription();
                }
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rendezvous::class,
        ]);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: pberg
 * Date: 27/05/2019
 * Time: 12:01
 */

namespace App\Form;



use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
                ->add('name', null, array(
                    'label' => 'Nom'
                ))
                ->add('surname', null, array(
                    'label' => 'Prénom'
                ))
                ->add('phone', null, array(
                    'label' => 'Numéro de téléphone'
                ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }
}
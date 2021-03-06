<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Indication;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('state', CKEditorType::class, array(
                'config'=> array(
                    'uiColor' => '#b3eff9'
                )
            ))
            ->add('effect', CKEditorType::class, array(
                'config'=> array(
                    'uiColor' => '#b3eff9'
                )
            ))
            ->add('indications', EntityType::class, array(
                'class' => Indication::class,
                'expanded'=>true,
                'multiple' =>true
            ))
            ->add('category', EntityType::class, array(
                'class'=> Category::class,
                'choice_label'=> function($category){
                    return $category->getTitle();
                }
            ))
            ->add('image', ImageType::class)        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}

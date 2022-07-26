<?php

namespace App\Form;

use App\Entity\Objects;
use App\Entity\Categories;
use App\Entity\SubCategories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LostAdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('categories',EntityType::class,[
            'class'=> Categories::class,
            'choice_label' =>'name',
        ])
        ->add('Subcategories',EntityType::class,[
            'class'=> SubCategories::class,
            'choice_label' =>'name'
           
        ])
        ->add('objectname',TextType::class,[
           
           'mapped'=>false,
         

        ])
        ->add('lost_address',EntityType::class,[
            'class'=> SubCategories::class,
           'mapped'=>false,
           'allow_extra_fields' =>'lost_address'
           

        ])
        ->add('lost_codezip',EntityType::class,[
            'class'=> SubCategories::class,
           'mapped'=>false,
           'choice_label' =>'lost_codezip'

        ])
        ->add('lost_city',EntityType::class,[
            'class'=> SubCategories::class,
           'mapped'=>false,

        ])
        ->add('lost_date',EntityType::class,[
            'class'=> SubCategories::class,
           'mapped'=>false,

        ])
        ->add('owner_secondname',EntityType::class,[
            'class'=> SubCategories::class,
           'mapped'=>false,
           'choice_label' =>'lost_codezip'

        ])
        ->add('owner_firstname',EntityType::class,[
            'class'=> SubCategories::class,
           'mapped'=>false,
          'empty_data' =>'owner_firstname'
        ])
        ->add('owner_address',EntityType::class,[
            'class'=> SubCategories::class,
           'mapped'=>false,

        ])
        ->add('owner_codezip',EntityType::class,[
            'class'=> SubCategories::class,
           'mapped'=>false,

        ])
        ->add('owner_city',EntityType::class,[
            'class'=> SubCategories::class,
           'mapped'=>false,

        ])
        ->add('object_state',EntityType::class,[
            'class'=> SubCategories::class,
           'mapped'=>false,

        ])
        ->add('object_mark',EntityType::class,[
            'class'=> SubCategories::class,
           'mapped'=>false,

        ])
        ->add('object_model',EntityType::class,[
            'class'=> SubCategories::class,
           'mapped'=>false,

        ])
        ->add('object_color',EntityType::class,[
            'class'=> SubCategories::class,
           'mapped'=>false,

        ])
        ->add('object_material',EntityType::class,[
            'class'=> SubCategories::class,
           'mapped'=>false,

        ])
        ->add('object_description',EntityType::class,[
            'class'=> SubCategories::class,
           'mapped'=>false,

        ])
        ->add('object_clues',EntityType::class,[
            'class'=> SubCategories::class,
           'mapped'=>false,

        ])
           
            
           
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Objects::class,
           
        ]);
    }
}

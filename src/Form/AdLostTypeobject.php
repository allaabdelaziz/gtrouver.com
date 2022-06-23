<?php

namespace App\Form;

use App\Entity\Objects;
use App\Entity\Categories;
use App\Entity\SubCategories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class AdLostTypeobject extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('categories', EntityType::class, [
                'mapped'=>false,
                'class' => Categories::class,
                'choice_label' => 'name',
            ])
            ->add('subcategories', EntityType::class, [
                'mapped'=>false,
                'class' => SubCategories::class,
                'choice_label' => 'name',
            ])
            ->add('objectname', EntityType::class, [
                'mapped'=>false,
                'class' => SubCategories::class,
                'choice_label' => 'objectname',
            ])
            
            ->add('lost_address', EntityType::class, [
                'mapped'=>false,
                'class' => SubCategories::class,
                'choice_label' => 'lost_address',
            ])
            
            ->add('lost_codezip', EntityType::class, [
                'mapped'=>false,
                'class' => SubCategories::class,
                'choice_label' => 'lost_codezip',
            ])
            
            ->add('lost_city', EntityType::class, [
                'mapped'=>false,
                'class' => SubCategories::class,
                'choice_label' => 'lost_city',
            ])
            
           
            
            ->add('owner_secondname', EntityType::class, [
                'mapped'=>false,
                'class' => SubCategories::class,
                'choice_label' => 'owner_secondname',
            ])
            
            ->add('owner_firstname', EntityType::class, [
                'mapped'=>false,
                'class' => SubCategories::class,
                'choice_label' => 'owner_firstname',
            ])
            
            ->add('owner_address', EntityType::class, [
                'mapped'=>false,
                'class' => SubCategories::class,
                'choice_label' => 'owner_address',
            ])
            
            ->add('owner_codezip', EntityType::class, [
                'mapped'=>false,
                'class' => SubCategories::class,
                'choice_label' => 'owner_codezip',
            ])
            
            ->add('owner_city', EntityType::class, [
                'mapped'=>false,
                'class' => SubCategories::class,
                'choice_label' => 'owner_city',
            ])
            
            ->add('object_state', EntityType::class, [
                'mapped'=>false,
                'class' => SubCategories::class,
                'choice_label' => 'object_state',
            ])
            
            ->add('object_mark', EntityType::class, [
                'mapped'=>false,
                'class' => SubCategories::class,
                'choice_label' => 'object_mark',
            ])
            
            ->add('object_model', EntityType::class, [
                'mapped'=>false,
                'class' => SubCategories::class,
                'choice_label' => 'object_model',
            ])
            
            ->add('object_color', EntityType::class, [
                'mapped'=>false,
                'class' => SubCategories::class,
                'choice_label' => 'object_color',
            ])
            
            ->add('object_material', EntityType::class, [
                'mapped'=>false,
                'class' => SubCategories::class,
                'choice_label' => 'object_material',
            ])
            
            ->add('object_description', EntityType::class, [
                'mapped'=>false,
                'class' => SubCategories::class,
                'choice_label' => 'object_description',
            ])
            
            ->add('object_clues', EntityType::class, [
                'mapped'=>false,
                'class' => SubCategories::class,
                'choice_label' => 'object_clues',
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

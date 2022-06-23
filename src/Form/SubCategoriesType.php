<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\SubCategories;
use App\Entity\CategoriesDetails;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SubCategoriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageobject', FileType::class, [
                'label' => 'inserer l\'image dobjet ',
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/gif',
                            'image/jpg',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image',
                    ])
                ],
            ])
            
            
            ->add('lost', ChoiceType::class, [
                'label' => "objet",
                'choices' => [
                    'perdu' => true,
                    'trouve' => false,

                ],
            ])

            ->add('categories', EntityType::class, [
                'class' => Categories::class,
                'mapped'=>false,
                'choice_label' => 'name',
            ])
            ->add('name', EntityType::class, [
                'class' => CategoriesDetails::class,
                'mapped'=>false,
                'choice_label' => 'name',
                'label' => "quoi excetemnt",
            ])
            
           
       
            ->add('objectname')
            ->add('lost_address')
            ->add('lost_codezip')
            ->add('lost_city')
            ->add('lost_date')
            ->add('owner_secondname')
            ->add('owner_firstname')
            ->add('owner_address')
            ->add('owner_codezip')
            ->add('owner_city')
            ->add('object_state')
            ->add('object_mark')
            ->add('object_model')
            ->add('object_color')
            ->add('object_material')
            ->add('object_description')
            ->add('object_clues')
            ->add('created_at')
            ->add('slug')
            
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SubCategories::class,
        ]);
    }
}

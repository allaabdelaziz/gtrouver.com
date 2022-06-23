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

class EditObjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

    
            
        ->add('lost', ChoiceType::class, [
            'label' => "objet",
            'choices' => [
                'perdu' => true,
                'trouve' => false,

            ],
        ])

        ->add('categories', EntityType::class, [
            'class' => Categories::class,
            'choice_label' => 'name',
            'label' => "choisir une categorie",
        ])

       
        ->add('categoriesdetails', EntityType::class, [
            'class' =>CategoriesDetails::class,
            'choice_label' => 'name',
            'label' => "quoi excetemnt",
        ])
       










        
        ->add('imageobject', FileType::class,array( 
            
            'label' => 'inserer l\'image dobjet ',
            'data_class' => null,  
         
            

            // make it optional so you don't have to re-upload the PDF file
            // every time you edit the Product details
            'required' => false,

            // unmapped fields can't define their validation using annotations
            // in the associated entity, so you can use the PHP constraint classes
            'constraints' => [
                new File([
                    'maxSize' => '2024k',
                    'mimeTypes' => [
                        'image/gif',
                        'image/jpg',
                        'image/jpeg',
                    ],
                    'mimeTypesMessage' => 'Please upload a valid image',
                    
                ])
            ],
        ))
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
        ->add('object_clues');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SubCategories::class,
            
        ]);
    }
}

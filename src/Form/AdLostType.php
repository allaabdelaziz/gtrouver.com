<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\SubCategories;
use App\Entity\CategoriesDetails;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use App\Repository\CategoriesRepository;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormInterface;
use App\Repository\CategoriesDetailsRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdLostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


            ->add('lost', ChoiceType::class, [

                'label' => "État",

                'choices' => [
                    ' Objet perdu' => true,
                    ' Objet Trouve' => false,
                ],
            ])
            ->add('lost_address', TextType::class, [
                'label' => 'addresse',
            ])
            ->add('lost_codezip', TextType::class, [
                'label' => ' code postal',
            ])
            ->add('lost_city', TextType::class, [
                'label' => 'ville',
            ])
            ->add('lost_date',  DateType::class, [
                'placeholder' => [
                    'year' => 'Annee', 'month' => 'Mois', 'day' => 'Jour',

                ],
            ])

            ->add('categories', EntityType::class, [
                'class' => Categories::class,
                'choice_label' => 'name',
                'label' => "choisir une categorie *",
                'placeholder' => "categorie ",
            ])


            ->add('categoriesdetails', EntityType::class, [
                'class' => CategoriesDetails::class,
                'choice_label' => 'name',
                'label' => "quoi excetemnt  *",
                'placeholder' => "sous categorie ",
                'query_builder' => function (CategoriesDetailsRepository $categoriesdetailsRepository) {
                    return  $categoriesdetailsRepository->createQueryBuilder('categoriesdetails')
                        ->orderBy('categoriesdetails.id', 'ASC');
                }
            ])


            ->add('imageobject', FileType::class, [
                'label' => 'inserer l\'image dobjet ',
                // 'multiple'=> true ,
                'required' => false,
                // 'multiple'=>true,
                'constraints' => [
                    new File([
                        'maxSize' => '2024k',
                        'mimeTypes' => [
                            'image/gif', 'image/jpg', 'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image',
                    ])
                ],
            ])
            ->add('objectname')
            ->add('owner_secondname')
            ->add('owner_firstname')
            ->add('owner_address')
            ->add('owner_codezip')
            ->add('owner_city')
            ->add('object_state')
            ->add('object_mark')
            ->add('object_model')
            ->add('object_color', ChoiceType::class, [
                'label' => 'color',

                'choices' => [
                    'choisi la couleur' => '',
                    'noir' => 'noir ',
                    'blanc' => 'blanc',
                    'rouge' => 'rouge',
                    'orange' => 'orange',
                    'jaune' => 'jaune',
                    'vert' => 'vert',
                    'bleu' => 'bleu',
                    'violet' => 'violet',
                    'rose' => 'rose',
                    'Marron' => 'Marron',
                    'gris' => 'gris',
                    'Azur' => 'Azur',
                    'Bleu ciel' => 'Bleu ciel',
                    'bleu marine' => 'bleu marine',
                    'multicolore' => 'multicolore',
                    'autre' => 'autre',
                ],
            ])

            ->add('object_material')
            ->add('object_description', TextareaType::class, [])
            ->add('object_clues');



        $formModifier = function (FormInterface $form, Categories $category = null) {
            $categoriesdetails = (null ===  $category) ? [] : $category->getCategoriesDetails();
            $form->add('categoriesdetails', EntityType::class, [
                'class' => CategoriesDetails::class,
                'choices' => $categoriesdetails,
                'choice_label' => "name",

                'label' => "quoi excetemnt",
                "placeholder" => "categorie detaills"
            ]);

            dd($category);
        };

        $builder->get('categories')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $category = $event->getForm()->getData();

                $formModifier($event->getForm(), $category); {
                    $form = $event->getForm();
                    $form->getParent()->add('categoriesdetails', EntityType::class, [
                        'class' => CategoriesDetails::class,
                        'choice_label' => $form->getData()->getCategoriesDetails(),
                        'mapped' => false,
                        'label' => "quoi excetemnt",
                        'query_builder' => function (CategoriesDetailsRepository $categoriesdetailsRepository) {
                            return  $categoriesdetailsRepository->createQueryBuilder('categoriesdetails')
                                ->orderBy('categoriesdetails.id', 'ASC');
                        }

                    ]);
                }
            }
        );;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SubCategories::class,
        ]);
    }
}

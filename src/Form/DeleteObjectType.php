<?php

namespace App\Form;


use App\Entity\SubCategories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DeleteObjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('active', ChoiceType::class, [
                'label' => "vous voulez veaiment suprimer votre article * ",
                'required' => true,
                'choices' => [
                    'non' => true,
                    'oui' => false,

                ],
            ])

            ->add('isfound', ChoiceType::class, [
                'label' => "vous lavez trouver ? *",
                'required' => true,
                'choices' => [
                    'oui' => true,
                    'non' => false,

                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SubCategories::class,

        ]);
    }
}

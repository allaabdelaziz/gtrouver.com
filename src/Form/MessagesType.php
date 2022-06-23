<?php

namespace App\Form;

use App\Entity\Users;
use App\Entity\Messages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MessagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('title', TextType::class, [
                "attr" => [
                   
                ]
            ])
            
            ->add('message', TextareaType::class, [
                "attr" => [
                   
                ]
            ])

            ->add(
                'recipient',
                EntityType::class,
                [
                    "class" => Users::class,
                    "choice_label" => "email",
                    'label' => "a qui",
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Messages::class,
        ]);
    }
}

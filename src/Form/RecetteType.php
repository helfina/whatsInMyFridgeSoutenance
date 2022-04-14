<?php

namespace App\Form;

use App\Entity\Recette;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nom de la recette',
                'required' => true,
            ])
            ->add('level', ChoiceType::class,[
                'choices' => [
                    'Facile' => 'facile',
                    'Moyen' => 'moyen',
                    'Difficile' => 'difficile',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
                'empty_data' => 'Moyen',
                'label' => 'Niveau',
                'required' => true,
            ])
            ->add('prepare', TextareaType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'label' => 'Préparation de la recette',
                    'required' => true,
                ])
            ->add('photo', FileType::class, [
                'label' => 'Photo',
                'attr' => [
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Le format autorisé est jpg',
                        'maxSizeMessage' => "L'image ne doit pas dépasser 2Mo",
                    ])
                ]
            ])
            ->add('time_prepare', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Temps de préparation en minutes',
                'required' => true,
            ])
            ->add('cook_time', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Temps de cuisson en minutes',
                'required' => true,
            ])
            ->add('category')
            ->add('envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}

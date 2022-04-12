<?php

namespace App\Form;

use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
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
            ->add('saison', ChoiceType::class, [
                    'choices' => [
                        'Toute l\'année' => "toute_l'annee",
                        'Printemps' => 'printemps',
                        'Ete' => 'ete',
                        'Automne' => 'automne',
                        'Hiver' => 'hiver',
                        'Printemps et Ete' => 'printemps/ete',
                        'Ete et Automne' => 'ete/automne',
                        'Automne et Hiver' => 'automne/hiver',
                        'Hiver et Printemps' => 'hiver/printemps',
                    ],
                'attr' => [
                    'class' => 'form-control',
                ],
                'empty_data' => 'Automne',
                'label' => 'Saison',
                'required' => true,
            ])
            ->add('envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ingredient::class,
        ]);
    }
}

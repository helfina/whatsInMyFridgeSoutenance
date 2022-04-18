<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label'         => 'Votre nom',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre nom'
                ]])
            ->add('adress', TextType::class, [
                'label' => 'Votre adresse'
            ])
            ->add('city', TextType::class, [
                'label' => 'Votre ville',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30
                ]),
                'attr' => [
                    'placeholder' => 'Merci de saisir votre ville'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre email',
                'constraints' => new Length([
                    'min' => 4,
                    'max' => 60
                ]),
                'attr' => [
                    'placeholder' => 'Merci de saisir votre Email'
                ]
            ])
            ->add('phone', NumberType::class, [
                'label'         => 'Téléphone',
                "help" => "Merci, de mettre des chiffres pour le téléphone.",
                'required'     => false
                ])
            ->add('commerce_name', TextType::class, [
                'label'         => 'Si vous êtes commerçant, le nom de votre commerce',
                'required'     => false
            ])
            ->add('commerce_type', ChoiceType::class, [
                'choices' => [
                    'Fonctionnement du site' => 'Fonctionnement_du_site',
                    'Commerçant primeur fruits et/ou légumes' => 'Primeurs',
                    'Boucher' => 'Boucherie',
                    'Poissonnier' => 'Poissonnerie',
                    'Ventes de différents produits présent sur le site' => 'Produits_divers',
                    'Supermarché, supperette, épicerie' => 'tout_produits'
                ],
            'attr' => [
                'class' => 'form-control',
            ],
             'label' => 'Sujet',
            'required' => true,
            ])
            ->add('photo', FileType::class, [
                'label' => 'Photo du commerce',
                'required' => false,
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
            ->add('submit', SubmitType::class, [
                'label' => "Envoyez"
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}

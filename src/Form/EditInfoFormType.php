<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditInfoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => ' Mon addresse Email'
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Mon prenom'
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Mon nom'
            ])
            ->add('pseudo', TextType::class, [
                'label' => 'Mon pseudo'
            ])
            ->add('address', TextType::class, [
                'label' => 'Mon address'
            ])
            ->add('city',TextType::class, [
                'label' => 'Ma ville'
            ])
            ->add('postal_code', NumberType::class, [
                'label' => 'Mon code postal'
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mon mot de passe',
                'mapped' => false,
                'disabled' => true,
                'attr' => [
                    'placeholder' => 'Veuillez saisir le mot de pass actuel'
                ]
            ])
            ->add('phone', NumberType::class, [
                'label' => ' votre téléphone'
            ])

            ->add('submit', SubmitType::class, [
                'label' => "Mettre a jour"
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

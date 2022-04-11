<?php

namespace App\Form;

use App\Entity\Avis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', UserType::class, [
                'label' => 'Votre pseudo',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('recette', TextType::class, [
                'label' => 'Votre recette',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('content', CKeditorType::class, [
                'label' => 'Votre avis',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,
        ]);
    }
}

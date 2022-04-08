<?php

namespace App\Controller\Admin;

use App\Entity\Recette;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RecetteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recette::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            ChoiceField::new('level', 'Niveau')->setChoices([
                'facile' => 'facile',
                'moyen' => 'moyen',
                'difficile' => 'difficile'
            ])->renderExpanded()->setRequired(true),
            TextField::new('title', 'Nom de la recette'),
            AssociationField::new('category','Categorie'),
            TextareaField::new('prepare', 'Preparation')->setNumOfRows(10),
            ImageField::new('photo')->setUploadDir('./public/img')->setBasePath('./img'),
            SlugField::new('slug', ('Renommer la photo'))->setTargetFieldName('title'),
            NumberField::new('time_prepare', 'Temps de preparation'),
            NumberField::new('cook_time', 'Temps de cuisson'),
            AssociationField::new('user', 'Utilisateur qui ajoute la recette'),
        ];
    }

}

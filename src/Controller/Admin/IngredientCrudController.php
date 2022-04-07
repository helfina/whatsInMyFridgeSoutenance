<?php

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class IngredientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ingredient::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', "Nom de l'ingrédient"),
            ImageField::new('photo', "Photo de l'ingrédient")->setUploadDir('./public/img')->setBasePath('./img'),
            ChoiceField::new('saison', "Saisonnalité (si inconnu, choisir 'toute l'année')")->setChoices([
                "toute l'année" => "toute_l'annee",
                'printemps' => 'printemps',
                'été' => 'ete',
                'automne' => 'automne',
                'hiver' => 'hiver',
                'printemps-été' => 'printemps/ete',
                'été-automne' => 'ete/automne',
                'automne-hiver' => 'automne/hiver',
                'hiver-printemps' => 'hiver/printemps'
            ])->renderExpanded()->setRequired(true),
        ];
    }

}

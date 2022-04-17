<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextField::new('adress'),
            TextField::new('city'),
            EmailField::new('email'),
            TelephoneField::new('phone'),
            TextField::new('commerce_name'),
            ChoiceField::new('commerce_type')->setChoices([
                'Fruits et/ou légumes' => 'Primeurs',
                'Viande' => 'Boucherie',
                'Poissons' => 'Poissonnerie',
                'Autres produits' => 'Produits_divers',
                'Tout produits' => 'tout_produits',
                'Autre sujet' => 'autre_sujet'
            ])->renderExpanded()->setRequired(true),
            ImageField::new('photo')->setUploadDir('./public/img')->setBasePath('./img'),
        ];
    }

}

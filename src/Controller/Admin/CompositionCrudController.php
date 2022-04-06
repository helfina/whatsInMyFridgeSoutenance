<?php

namespace App\Controller\Admin;

use App\Entity\Composition;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CompositionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Composition::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}

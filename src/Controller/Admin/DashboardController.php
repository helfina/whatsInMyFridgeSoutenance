<?php

namespace App\Controller\Admin;

use App\Entity\Avis;
use App\Entity\Category;
use App\Entity\Composition;
use App\Entity\Ingredient;
use App\Entity\Recette;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;

class DashboardController extends AbstractDashboardController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     */
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('WhatsInMyFridgeSoutenance');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToRoute('Home Site', 'fas fa-home', 'app_home' );

        yield MenuItem::section('Gestion Utilisateur');
        yield MenuItem::subMenu('Users', 'fas fa-address-book')->setSubItems([
           // MenuItem::linkToCrud('Add User', 'fas fa-user-plus', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Users', 'fas fa-users', User::class)
        ]);
        yield MenuItem::subMenu('Avis', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud('Add Avis', 'fas fa-list', Avis::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Avis', 'fas fa-list', Avis::class)
        ]);


        yield MenuItem::section('Gestion des Recettes');
        yield MenuItem::subMenu('Les recettes', 'fas fa-book')->setSubItems([
            MenuItem::linkToCrud('Ajouter une recette', 'fas fa-book', Recette::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Recettes enregistr??s', 'fas fa-book', Recette::class)
        ]);
        yield MenuItem::subMenu('Categories', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud('Add Categorie', 'fas fa-list', Category::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Categories', 'fas fa-list', Category::class)
        ]);
        yield MenuItem::subMenu('Les ingredients', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud('Ajouter un ingredient', 'fas fa-list', Ingredient::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Ingredients enregistr??s', 'fas fa-list', Ingredient::class)->setAction(Crud::PAGE_INDEX)
        ]);
        yield MenuItem::subMenu('Compositions', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud('Add Composition', 'fas fa-list', Composition::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Compositions', 'fas fa-list', Composition::class)
        ]);
        yield MenuItem::subMenu('Contact', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud('Add Contact', 'fas fa-list', Contact::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Contact', 'fas fa-list', Contact::class)
        ]);

    }

}

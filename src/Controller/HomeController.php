<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/compte', name: 'app_account')]
    public function profil(): Response
    {
        return $this->render('home/profil/index.html.twig', [ 
            'Salut' => 'Salut',
    ]);
    }

    #[Route('/ingredient', name: '_ingredient')]
    public function ingredient(IngredientRepository $ir): Response
    {
        $ingredients = $ir->findAll();
        
        return $this->render('home/ingredient.html.twig', [ 
            'ingredients' => $ingredients,
    ]);
    }

}



<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Recette;
use App\Entity\Ingredient;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use App\Repository\RecetteRepository;
use App\Repository\IngredientRepository;
use App\Repository\CompositionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{
    #[Route('/compte', name: 'app_account')]
    public function index(
        RecetteRepository $recetteRepository,
        IngredientRepository $ingredientRepository,
        CompositionRepository $compositionRepository
    ): Response
    {

        return $this->render('account/index.html.twig',[
            'ingredient' => $ingredientRepository->findAll(),
            'compositions'=> $compositionRepository->findAll(),
            'recettes' => $recetteRepository->findAll(),
        ]);
    }

    #[Route('/favori/{id}', name: 'app_account_favoris',  methods: 'GET', requirements: ['id' => '[0-9]+'])]
    public function favoris(Request $request, EntityManagerInterface $em, RecetteRepository $rr, Recette $recette, UserRepository $ur, $id): Response
    {   
        $user = $this->getUser();
        $user->addFavori($recette);
        $em->flush();
        return $this->redirectToRoute('app_account');
    }
    
}

<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Entity\Recette;
use App\Entity\User;
use App\Repository\CompositionRepository;
use App\Repository\IngredientRepository;
use App\Repository\RecetteRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

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
            'recette' => $recetteRepository->findAll(),

        ]);
    }
}

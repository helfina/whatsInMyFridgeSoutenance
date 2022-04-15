<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use App\Entity\Recette;
use App\Entity\Ingredient;
use App\Repository\CompositionRepository;
use App\Repository\IngredientRepository;
use App\Repository\RecetteRepository;
use App\Repository\UserRepository;
use Cassandra\Type\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/compte', name: 'app_account')]
    public function index(
        RecetteRepository     $recetteRepository,
        IngredientRepository  $ingredientRepository,
        CompositionRepository $compositionRepository
    ): Response
    {

        return $this->render('account/index.html.twig', [
            'ingredient' => $ingredientRepository->findAll(),
            'compositions' => $compositionRepository->findAll(),
            'recettes' => $recetteRepository->findAll(),

        ]);
    }


    #[Route('/compte/{id}/edit', name: 'app_account_edit', methods: ['GET', 'POST'], requirements: ['id' => '[0-9]+'])]
    public function edit(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHashes, EntityManagerInterface $manager , User $user): Response
    {
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();
            if ($email != $user->getUserIdentifier()) {
                $user->getId()->getEmail($email);
            }

            if ($mdp = $form->get('password')->getData()) {
                $password = $passwordHashes->hashPassword($user, $mdp);
                $user->setPassword($password);
            }

            $userRepository->add($user);
            return $this->redirectToRoute('app_account', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('account/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}

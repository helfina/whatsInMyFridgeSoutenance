<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditInfoFormType;
use App\Entity\Recette;
use App\Repository\CompositionRepository;
use App\Repository\IngredientRepository;
use App\Repository\RecetteRepository;
use App\Repository\UserRepository;
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


    #[Route('/compte/{id}/edit', name: 'app_account_edit', requirements: ['id' => '[0-9]+'], methods: ['GET', 'POST'])]
    public function edit(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHashes, EntityManagerInterface $manager , User $user): Response
    {
        $form = $this->createForm(EditInfoFormType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();
            if ($email != $user->getUserIdentifier()) {
                $user->getId()->getEmail($email);
            }
            $userRepository->add($user);
            return $this->redirectToRoute('app_account', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('account/edit.html.twig', [
            'user' => $user,
            'form' => $form,
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

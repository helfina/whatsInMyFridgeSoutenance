<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Repository\IngredientRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\IngredientType;

class IngredientController extends AbstractController
{
    #[Route('/ingredient', name: 'app_ingredient')]
    public function index(IngredientRepository $ir): Response
    {
        $a = [0,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $user = $this->getUser();
        if( $user ){
            $favori = $user->getIngredient();
            return $this->render('ingredient/index.html.twig', [
                'controller_name' => 'IngredientController',
                'ingredients' => $ir->findBy( array(), array('name' => 'ASC')),
                'favoris' => $favori,
                'alpha' => $a
            ]);
        }
        return $this->render('ingredient/index.html.twig', [
            'controller_name' => 'IngredientController',
            'ingredients' => $ir->findBy( array(), array('name' => 'ASC')),
            'alpha' => $a
        ]);
    }
    
    #[Route('/ingredient/ajout', name: 'app_ingredient_ajout')]
    public function ajout(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $ingredient = new Ingredient();
        $ingredientForm = $this->createForm(IngredientType::class, $ingredient);

        $ingredientForm->handleRequest($request);

        if($ingredientForm->isSubmitted() && $ingredientForm->isValid()){

            if($fichier = $ingredientForm->get('photo')->getData()){
                $nomFichier = pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME);
                $nomFichier = str_replace(" ", "_", $nomFichier);
                $nomFichier .= '_'.uniqid().'.'.$fichier->guessExtension();
                $fichier->move("img", $nomFichier);
                $ingredient->setPhoto($nomFichier);
            }
            
            $entityManager->persist($ingredient);
            $entityManager->flush();

            $this->addFlash('message', 'Votre ingredient a bien été ajouté');

            return $this->redirectToRoute('app_ingredient_detail', ['id' => $ingredient->getId()]);

        }
        return $this->render('ingredient/ajout.html.twig', [
            'controller_name' => 'IngredientController',
            'ingredientForm' => $ingredientForm->createView()
        ]);
    
    }

    #[Route('/ingredient/{id}', name: 'app_ingredient_detail', requirements:['id' => '[0-9]+'])]
    public function detail(IngredientRepository $ir, $id): Response
    {
        return $this->render('ingredient/detail.html.twig', [
            'controller_name' => 'IngredientController',
            'ingredient' => $ir->find($id)
        ]);
    }

   
}
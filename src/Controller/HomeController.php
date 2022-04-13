<?php

namespace App\Controller;

use App\Form\SearchingredientType;
use App\Repository\RecetteRepository;
use App\Repository\IngredientRepository;
use Sensio\Bundle\FrameworkExtraBundle\EventListener\ControllerListener;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    
    public function index(RecetteRepository $rr, Request $request): Response
    {   
        $form = $this->createForm(SearchingredientType::class);
        $search = $form->handleRequest($request);
        // $term = $request->request->get('query');

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'recettes' => $rr->findAll(),
            'form' => $form->createView()
        ]);
    }

    #[Route('/search', name: 'app_search', methods: 'GET')]
    public function searchAction(Request $request, IngredientRepository $ir)
    {
       
  
        $requestString = $request->get('q');
  
        $entities =  $ir->findBySearch($requestString);
  
        if(!$entities) {
            $result['entities']['error'] = "ingrédient non disponible";
        } else {
            
            $result['entities'] = $this->getRealEntities($entities);
        }
  
        return new Response(json_encode($result));
    }
  
    public function getRealEntities($entities){
  
        foreach ($entities as $entity){
            $realEntities[$entity->getId()] = $entity->getName();
        }
  
        return $realEntities;
    }





}





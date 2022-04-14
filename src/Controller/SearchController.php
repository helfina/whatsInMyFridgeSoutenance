<?php

namespace App\Controller;

use App\Repository\CompositionRepository;
use App\Repository\IngredientRepository;
use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    // #[Route('/search_compo', name: 'app_search_compo')]
    // public function index(Request $rq,IngredientRepository $ir ): Response
    // {   
    //     $word = $rq->query->get('search');
    //     $ingredients = $ir -> findBysearch($word);
    //     return $this->render('search/index.html.twig', [
    //         'controller_name' => 'SearchController',
    //         'ings' => $ingredients
    //     ]);
    // }

    #[Route('/search_compo', name: 'app_search_compo')]
    public function index(Request $rq, IngredientRepository $ir, CompositionRepository $cr, RecetteRepository $rr): Response
    {   
        // $requestString = $rq->get('c');
        // $entities = $ir->findById($requestString);
        $list = $rq->query->get("js_object");
        
        $array = explode(',', $list);




        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
            // 'entities' => $entities
            'list' => $list,
            'recettes' => $rr->findAll(),
            'compos' => $cr->findAll(),
            'ingredients' => $ir->findAll(),
            'array' => $array

            
        ]);
    }
}

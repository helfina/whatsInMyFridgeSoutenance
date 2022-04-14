<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
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
    public function index(Request $rq, IngredientRepository $ir): Response
    {   
        // $requestString = $rq->get('c');
        // $entities = $ir->findById($requestString);
        $list = $rq->query->get("js_object");

        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
            // 'entities' => $entities
            'list' => $list

            
        ]);
    }
}

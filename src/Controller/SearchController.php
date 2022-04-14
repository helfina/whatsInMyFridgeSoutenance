<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(Request $rq,IngredientRepository $ir ): Response
    {   
        $word = $rq->query->get('search');
        $ingredients = $ir -> findBysearch($word);
        return $this->render('search/index.html.twig', [
            'page_name' => 'page de recherche',
            'ings' => $ingredients
        ]);
    }
}

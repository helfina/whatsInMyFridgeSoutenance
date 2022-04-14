<?php

namespace App\Controller;

use App\Form\SearchingredientType;
use App\Repository\CompositionRepository;
use App\Repository\RecetteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(RecetteRepository $rr, Request $request, CompositionRepository $cr): Response
    {   
        $form = $this->createForm(SearchingredientType::class);
        $search = $form->handleRequest($request);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'recettes' => $rr->findAll(),
            'form' => $form->createView(),
            'compositions' => $cr->findAll(),
        ]);
    }

}



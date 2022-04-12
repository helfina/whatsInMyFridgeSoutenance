<?php

namespace App\Controller;

use App\Repository\RecetteRepository;
use App\Repository\CompositionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CompositionController extends AbstractController
{
    #[Route('/composition', name: 'app_composition')]
    public function index(CompositionRepository $cr, RecetteRepository $rr): Response
    {


        return $this->render('composition/index.html.twig', [
            'controller_name' => 'CompositionController',
            'compositions' => $cr->findAll(),
            'recettes' => $rr->findAll()                   
        ]);
    }
}

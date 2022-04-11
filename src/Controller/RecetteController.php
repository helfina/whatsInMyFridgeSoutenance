<?php

namespace App\Controller;

use App\Repository\RecetteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecetteController extends AbstractController
{
    #[Route('/recette', name: 'app_recette')]
    public function index(RecetteRepository $rr): Response
    {
        return $this->render('recette/index.html.twig', [
            'controller_name' => 'RecetteController',
            'recettes' => $rr->findAll()
        ]);
    }
}

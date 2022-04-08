<?php

namespace App\Controller;

use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(RecetteRepository $rr): Response
    {

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'recettes' => $rr->findAll()
        ]);
    }

    #[Route('/compte', name: 'app_account')]
    public function profil(): Response
    {
        return $this->render('home/profil/index.html.twig', [ 
            'Salut' => 'Salut',
    ]);
    }
}



<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Repository\RecetteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\AvisType;
use Doctrine\Persistence\ManagerRegistry;

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

    // Partie avis
    #[Route('/recette/{id}/avis', name: 'app_recette_detail')]
    public function avis(RecetteRepository $rr, int $id, Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $avis = new Avis();
        $avisForm = $this->createForm(AvisType::class, $avis);

        $avisForm->handleRequest($request);

        if($avisForm->isSubmitted() && $avisForm->isValid()){
            $avis->setRecette($rr->find($id));
            $avis->setUser($this->getUser($id));
            
            $entityManager->persist($avis);
            $entityManager->flush();

            $this->addFlash('message', 'Votre commentaire a bien été envoyé');

            return $this->redirectToRoute('app_recette_detail', ['id' => $id]);

            
        }


        return $this->render('recette/details.html.twig', [
            'controller_name' => 'RecetteController',
            'recettes' => $rr->findAll(),
            'id' => $id,
            'avisForm' => $avisForm->createView()
        ]);
    }
}

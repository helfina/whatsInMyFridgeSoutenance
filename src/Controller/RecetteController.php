<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\CommentFormType;
use App\Repository\AvisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecetteController extends AbstractController
{
    #[Route('/recette', name: 'app_recette')]
    public function index(AvisRepository $avisRepository, Request $request): Response
    {
        $avis = new Avis();
        $avisForm = $this->createForm(CommentFormType::class, $avis);
        $avisForm->handleRequest($request);

        if($avisForm->isSubmitted() && $avisForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($avis);
            $em->flush();

            $this->addFlash('success', 'Votre avis a bien été enregistré');
            return $this->redirectToRoute('app_recette');
        }

        
        return $this->render('recette/index.html.twig', [
            'controller_name' => 'RecetteController',
            'avisForm' => $avisForm->createView()
        ]);
    }
}

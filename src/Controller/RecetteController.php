<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\RecetteRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecetteController extends AbstractController
{
    #[Route('/recette', name: 'app_recette')]
    public function index(RecetteRepository $rr,): Response
    {
        $c = [0,'Entrée','Plat','Dessert'];
        $user = $this->getUser();
        if( $user ){
            $favori = $user->getfavoris();
                return $this->render('recette/index.html.twig', [
                'recettes' => $rr->findBy( array(), array('title' => 'ASC')),
                'category' => $c,
                'favoris' => $favori
                ]);
            }
        return $this->render('recette/index.html.twig', [
            'recettes' => $rr->findBy( array(), array('title' => 'ASC')),
            'category' => $c,
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

    #[Route('/recette/ajout', name: 'app_recette_ajout', requirements:['id' => '[0-9]+'])]
    public function ajout(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $recette = new Recette();
        $recetteForm = $this->createForm(RecetteType::class, $recette);

        $recetteForm->handleRequest($request);

        if($recetteForm->isSubmitted() && $recetteForm->isValid()){

            if($fichier = $recetteForm->get('photo')->getData()){
                $nomFichier = pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME);
                $nomFichier = strreplace(" ", "_", $nomFichier);
                $nomFichier .= '_'.uniqid().'.'.$fichier->guessExtension();
                $fichier->move("img", $nomFichier);
                $recette->setPhoto($nomFichier);
            }

            $recette->setUser($this->getUser());

            $entityManager->persist($recette);
            $entityManager->flush();

            $this->addFlash('message', 'Votre recette a bien été ajoutée');

            return $this->redirectToRoute('app_recette_detail', ['id' => $recette->getId()]);

        }

        return $this->render('recette/ajout.html.twig', [
            'controller_name' => 'RecetteController',
            'recetteForm' => $recetteForm->createView()
        ]);
    }

}

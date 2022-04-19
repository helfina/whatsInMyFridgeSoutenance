<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $contact = new Contact();
        $contactForm = $this->createForm(ContactType::class, $contact);

        $contactForm->handleRequest($request);

        if($contactForm->isSubmitted() && $contactForm->isValid()){

            if($fichier = $contactForm->get('photo')->getData()){
                $nomFichier = pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME);
                $nomFichier = str_replace(" ", "_", $nomFichier);
                $nomFichier .= '_'.uniqid().'.'.$fichier->guessExtension();
                $fichier->move("img", $nomFichier);
                $contact->setPhoto($nomFichier);
            }

            $entityManager->persist($contact);
            $entityManager->flush();

            $this->addFlash('message', 'Votre contact a bien été ajoutée');

            return $this->redirectToRoute('app_commercant', ['id' => $contact->getId()]);

        }
        return $this->render('contact/index.html.twig', [
            'contactForm' => $contactForm->createView()
        ]);
    }

    #[Route('/commerçant', name: 'app_commercant')]
    public function commerce(ContactRepository $cr): Response
    {
        return $this->render('commercant/index.html.twig', [
            'commercant' => $cr->findAll(),
        ]);
    }
}

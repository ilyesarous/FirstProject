<?php

namespace App\Controller;

use App\Entity\Entretien;
use App\Form\EntretienType;
use App\Repository\EntretienRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;

class EntretienController extends AbstractController
{
    #[Route('/entretien', name: 'app_entretien')]
    public function getAllEntretiens( EntretienRepository $rep): Response
    {
        $entretiens = $rep->findAll();

        return $this->render('entretien/index.html.twig', [
            'entretiens' => $entretiens,
        ]);
    }

    #[Route('/addEntretien', name: 'app_addEntretien')]
    public function addEntretien( Request $req, ManagerRegistry $manager): Response
    {
        $em = $manager->getManager();
        $entretien = new Entretien();
        $form = $this->createForm(EntretienType::class, $entretien);
        $form->handleRequest($req);

        if ($form->isSubmitted()) {
            
            $em->persist($entretien);
            $em->flush();
            return $this->redirectToRoute('app_entretien');

        }

        return $this->renderForm('entretien/formEntretien.html.twig', [
            "form" => $form,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Form\CandidatType;
use App\Repository\CandidatRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CandidatController extends AbstractController
{
    #[Route('/candidat', name: 'app_candidat')]
    public function getAllCandidats( CandidatRepository $rep): Response
    {
        $candidats = $rep->findAll();

        return $this->render('candidat/index.html.twig', [
            'candidats' => $candidats,
        ]);
    }
    #[Route('/addCandidat', name: 'app_addDB')]
    public function addCandidat( Request $req, ManagerRegistry $manager): Response
    {
        $em = $manager->getManager();
        $candidat = new Candidat();
        $form = $this->createForm(CandidatType::class, $candidat);
        $form->handleRequest($req);

        if ($form->isSubmitted()) {
            
            $em->persist($candidat);
            $em->flush();
            return $this->redirectToRoute('app_candidat');

        }

        return $this->renderForm('candidat/formCandidat.html.twig', [
            "form" => $form,
        ]);
    }
    #[Route('/delete/{id}', name: 'app_deleteCandidat')]
    public function deleteCandidate( $id, CandidatRepository $rep, ManagerRegistry $manager): Response
    {
        $em = $manager->getManager();
        $candidat = $rep->find($id);
        $em->remove($candidat);
        $em->flush();
        return $this->redirectToRoute('app_candidat');

        
    }
}

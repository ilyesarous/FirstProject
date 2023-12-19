<?php

namespace App\Controller;

use App\Repository\TheaterPlayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TheaterPlayController extends AbstractController
{
    #[Route('/theaters', name: 'app_theater_play')]
    public function index(TheaterPlayRepository $rep): Response
    {
        $theraters = $rep->findAll();
        return $this->render('theater_play/index.html.twig', [
            'theaters' => $theraters,
        ]);
    }
}

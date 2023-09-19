<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjetController extends AbstractController
{
    #[Route('/projet/{nom}', name: 'app_projet')]
    public function index(): Response
    {
        $nom = "ilyes";
        $class = "3A9";
        return $this->render('projet/index.html.twig', [
            'classe' => $class,
            'nom' => $nom
        ]);
    }
    #[Route('/affiche/{name}/{description}', name:"app_afficher")]
    public function afficher($name, $description): Response{
        $projects = [
            [
                "name" => "ilyes",
                "description" => "Studient",
            ],
            [
                "name" => "ahmed",
                "description" => "Studient 1",
            ],
        ];
        return $this->render('projet/afficher.html.twig', [
            "name" => $name,
            "description" => $description,
            "projects" => $projects,
        ]);
    }
    #[Route('/details/{name}/{description}', name:"app_details")]
    public function getDetails($name, $description): Response{
        
        return $this->render('projet/details.html.twig', [
            "name" => $name,
            "description" => $description,
        ]);
    }
}

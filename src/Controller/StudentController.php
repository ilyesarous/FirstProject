<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    private $first = "ae";
    #[Route('/student/{userName}', name: 'app_student')]
    public function index($userName): Response
    {
        $var = 123;
        return $this->render('student/index.html.twig', [
            'userName' => $userName,
            'var' => $var,
            'fn' => $this->first,
        ]);
    }
}

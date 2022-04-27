<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChurchesController extends AbstractController
{
    #[Route('/churches', name: 'app_churches')]
    public function index(): Response
    {

        $churches = ['Igreja 1', 'Igreja 2'];

        return $this->render('index.html.twig', array('title' => 'Churches Page', 'churches' => $churches));

        // return $this->json([
        //     'message' => 'Welcome to your new controller!',
        //     'path' => 'src/Controller/ChurchesController.php',
        // ]);
    }
}

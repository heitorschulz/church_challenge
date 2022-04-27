<?php

namespace App\Controller;

use App\Entity\Church;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChurchesController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    #[Route('/churches', name: 'app_churches')]
    public function index(): Response
    {

        $repository = $this->em->getRepository(Church::class);
        $churches = $repository->findAll();

        // dd($churches);

        return $this->render('index.html.twig', array('title' => 'Churches Page', 'churches' => $churches));

        // return $this->json([
        //     'message' => 'Welcome to your new controller!',
        //     'path' => 'src/Controller/ChurchesController.php',
        // ]);
    }
}

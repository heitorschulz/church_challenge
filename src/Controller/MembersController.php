<?php

namespace App\Controller;

use App\Entity\Member;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MembersController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    #[Route('/members', name: 'app_members')]
    public function index(): Response
    {

        $repository = $this->em->getRepository(Member::class);
        $members = $repository->findAll();

        return $this->render('members/index.html.twig', array('title' => 'Members Page', 'members' => $members));

        // return $this->json([
        //     'message' => 'Welcome to your new controller!',
        //     'path' => 'src/Controller/MembersController.php',
        // ]);
    }
}

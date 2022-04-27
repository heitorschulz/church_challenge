<?php

namespace App\Controller;

use App\Entity\Church;
use App\Form\ChurchFormType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChurchesController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/churches', methods:['GET'], name: 'app_churches')]
    public function index(): Response
    {

        $repository = $this->em->getRepository(Church::class);
        $churches = $repository->findAll();

        // dd($churches);

        return $this->render('churches/index.html.twig', array('title' => 'Churches Page', 'churches' => $churches));

        // return $this->json([
        //     'message' => 'Welcome to your new controller!',
        //     'path' => 'src/Controller/ChurchesController.php',
        // ]);
    }


    #[Route('/churches/create', name: 'create_church')]
    public function create(Request $request): Response
    {
        $church = new Church();
        $form = $this->createForm(ChurchFormType::class, $church);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $newChurch = $form->getData();

            $this->em->persist($newChurch);
            $this->em->flush();

            // dd($newChurch);
            // exit;

            return $this->redirectToRoute('app_churches');
        }


        return $this->render('churches/create.html.twig', [
            'form' => $form->createView()
        ]);
    }


    #[Route('/churches/{id}', methods:['GET'], name: 'show_churches')]
    public function show($id): Response
    {
        $repository = $this->em->getRepository(Church::class);
        $church = $repository->find($id);

        return $this->render('churches/show.html.twig', array('title' => 'Church Page', 'church' => $church));

    }

    #[Route('/churches/edit/{id}', name: 'edit_church')]
    public function edit($id, Request $request): Response
    {
        $repository = $this->em->getRepository(Church::class);
        $church = $repository->find($id);

        $form = $this->createForm(ChurchFormType::class, $church);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $church->setName($form->get('name')->getData());
            $church->setWebsite($form->get('website')->getData());
            $church->setAddress($form->get('address')->getData());

            $this->em->flush();
            return $this->redirectToRoute('app_churches');
        }


        return $this->render('churches/edit.html.twig', array('title' => 'Church Page', 
            'church' => $church, 
            'form' => $form->createView()));
    }


    #[Route('/churches/delete/{id}', methods: ['GET', 'DELETE'], name: 'delete_church')]
    public function delete($id): Response{

        $repository = $this->em->getRepository(Church::class);
        $church = $repository->find($id);

        $this->em->remove($church);
        $this->em->flush();

        return $this->redirectToRoute('app_churches');

    }
}

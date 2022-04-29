<?php

namespace App\Controller;

use App\Entity\Church;
use App\Entity\Member;
use App\Form\MemberFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/members/{id}', methods: ['GET'], name: 'show_member')]
    public function show($id): Response
    {

        $repository = $this->em->getRepository(Member::class);
        $member = $repository->find($id);

        return $this->render('members/show.html.twig', array('title' => 'Member Page', 'member' => $member));

    }


    #[Route('/members/create', name: 'create_member')]
    public function create(Request $request): Response
    {

        // $repositoryChurch = $this->em->getRepository(Church::class); 
        // $church = $repositoryChurch->find($id);


        $member = new Member();
        // $member->setChurch($church);

        $form = $this->createForm(MemberFormType::class, $member);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $newMember = $form->getData();

            $this->em->persist($newMember);
            $this->em->flush();

            // dd($newChurch);
            // exit;

            return $this->redirectToRoute('app_members');
        }

        return $this->render('churches/create.html.twig', [
            'form' => $form->createView()
        ]);
    }


    #[Route('/members/edit/{id}', name: 'edit_member')]
    public function edit($id, Request $request): Response
    {
        $repository = $this->em->getRepository(Member::class);
        $member = $repository->find($id);

        $form = $this->createForm(MemberFormType::class, $member);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $member->setName($form->get('name')->getData());
            $member->setCPF($form->get('CPF')->getData());
            $member->setBirthday($form->get('birthday')->getData());
            $member->setEmail($form->get('email')->getData());
            $member->setTelephone($form->get('telephone')->getData());
            $member->setAddress($form->get('address')->getData());
            $member->setCity($form->get('city')->getData());
            $member->setState($form->get('state')->getData());

            $this->em->flush();

            $referer = $request->request->get('referer');
            if ($referer == NULL) {
                return $this->redirectToRoute('app_churches');
            } else {
                return $this->redirect($request->request->get('referer'));
            }


            
            // return $this->redirectToRoute('app_members');
        }


        return $this->render('members/edit.html.twig', array('title' => 'Member Page', 
            'member' => $member, 
            'form' => $form->createView()));
    }


    #[Route('/members/delete/{id}', methods: ['GET', 'DELETE'], name: 'delete_member')]
    public function delete($id): Response{

        $repository = $this->em->getRepository(Member::class);
        $member = $repository->find($id);

        $this->em->remove($member);
        $this->em->flush();

        return $this->redirectToRoute('app_churches');

        // return $this->redirectToRoute('app_members');
       
        // return new JsonResponse(array(
        //     'status' => 'success',
        //     'message' => 'MEMBER_DELETED_SUCCESS'
        // ));

    }
}

<?php

namespace App\Controller;

use App\Entity\Church;
use App\Entity\Member;
use App\Form\ChurchFormType;
use App\Form\MemberFormType;
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

    #[Route('/', methods:['GET'], name: 'homepage')]
    #[Route('/churches', methods:['GET'], name: 'app_churches')]
    public function index(): Response
    {

        $repository = $this->em->getRepository(Church::class);
        $churches = $repository->findAll();

        return $this->render('churches/index.html.twig', array('title' => 'Churches Page', 'churches' => $churches));

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

        foreach ($church->getMembers() as &$member) {
            $this->em->remove($member);
        }

        $this->em->remove($church);
        $this->em->flush();

        return $this->redirectToRoute('app_churches');

    }

    private function verificaCPF($cpf): bool{

        $array_cpf = str_split($cpf);

        $soma = 0;

        for ($i = 0; $i <= 8; $i++) {
            $soma = $soma + ((int)$array_cpf[$i] * (10 - $i));
        }

        $digito1 = $soma*10%11;

        if($digito1 == (int)$array_cpf[9]){
            
            $soma = 0;

            for ($i = 0; $i <= 9; $i++) {
                $soma = $soma + ((int)$array_cpf[$i] * (11 - $i));
            }
            
            $digito2 = $soma*10%11;

            if($digito2 == (int)$array_cpf[10]){
                return true;
            }
        }
        return false;
    }

    #[Route('/churches/{id}/addmember', name: 'add_member')]
    public function addMember($id, Request $request): Response
    {

        $repositoryChurch = $this->em->getRepository(Church::class); 
        $church = $repositoryChurch->find($id);

        $member = new Member();
        $member->setChurch($church);

        $form = $this->createForm(MemberFormType::class, $member);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $newMember = $form->getData();

            if($this->verificaCPF($newMember->getCPF())){

                $this->em->persist($newMember);
                $this->em->flush();
    
                // return $this->redirectToRoute('show_churches',['id' => $church->getId()]);
                return $this->redirect($request->request->get('referer'));
            }
            else{
                return new Response('Invalid CPF!');
            }
        }

        return $this->render('members/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/churches/{id}/removemember/{id_member}', name: 'remove_member')]
    public function removeMember($id, $id_member, Request $request): Response
    {
        $repositoryChurch = $this->em->getRepository(Church::class); 
        $church = $repositoryChurch->find($id);

        $repository = $this->em->getRepository(Member::class);
        $member = $repository->find($id_member);

        $church->removeMember($member);

        $this->em->remove($member);
        $this->em->flush();

        return $this->redirectToRoute('show_churches',['id' => $church->getId()]);

    }


}

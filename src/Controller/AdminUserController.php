<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Regex;

#[Route('/admin')]
class AdminUserController extends AbstractController
{
    private  $em; 
    public function __construct( EntityManagerInterface $em)
    {
        $this->em = $em;
    } 
    #[Route('/user/add', name: 'admin_user_add')]
    public function add(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form= $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($passwordHasher->hashPassword($user, $user->getPassword()));
            $user->setRoles(['ROLE_USER']);
            $this->em->persist($user);
            $this->em->flush();

            return $this->redirectToRoute('admin_user_list');
        }

        return $this->render('admin_user/add.html.twig', [
            'form' =>   $form->createView(),
        ]);
    }

    #[Route("/users",name:"admin_user_list")]
    public function list(): Response
    {
        return $this->render('admin_user/list.html.twig', [
            'users' => $this->em->getRepository(User::class)->findAll(),
        ]);
    }
}

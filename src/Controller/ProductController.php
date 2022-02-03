<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class ProductController extends AbstractController
{
    private  $em; 
    public function __construct( EntityManagerInterface $em)
    {
        $this->em = $em;
    } 
    
    #[Route('/product/add/{company}', name: 'product_add')]
    public function add(int $company, Request $request): Response
    {
        $company = $this->em->getRepository(Company::class)->find($company);
        $product = new Product();
        $form= $this->createForm(ProductType::class, $product, ['company' => $company]);
        //  dump($company);
        $form->handleRequest($request);
        //  dd($product);
        if ($form->isSubmitted() && $form->isValid()) {
            // dd($product);
            $product->setCompany($company);
            $this->em->persist($product);
            $this->em->flush();

            return $this->redirectToRoute('product_list');
        }

        return $this->render('product/add.html.twig', [
            'form' =>   $form->createView(),
        ]);
    }

    #[Route("/products",name:"product_list")]
    public function list(): Response
    {
        return $this->render('product/list.html.twig', [
            'products' => $this->em->getRepository(Product::class)->findAll(),
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class CompanyController extends AbstractController
{
    #[Route('/company', name: 'company-vue-entry')]
    public function vueEntry(): Response
    {
        return $this->render('company/vueEntry.html.twig');
    }
}

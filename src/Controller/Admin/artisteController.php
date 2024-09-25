<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class artisteController extends AbstractController
{
    #[Route('/admin/artiste', name: 'app_admin_artiste')]
    public function index(): Response
    {
        return $this->render('admin/artiste/index.html.twig', [
            'controller_name' => 'artisteController',
        ]);
    }
}

<?php

namespace App\Controller\Admin;

use App\Entity\Artiste;
use App\Form\ArtisteType;
use App\Repository\ArtisteRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class artisteController extends AbstractController
{
    #[Route('/admin/artistes', name: 'app_admin_artistes', methods: ['GET'])]
    public function listeArtistes(ArtisteRepository $repo, PaginatorInterface $paginator, Request $request )
    {   
        $lesArtistes = $paginator->paginate(
         $repo->listeArtistesCompletePaginee(),
         $request->query->getInt('page', 1),
         9 /*limit per page*/
        );
        return $this->render('admin/artiste/listeArtistes.html.twig', [
            'lesArtistes' => $lesArtistes
        ]);

    }


    #[Route('/admin/artiste/ajout', name: 'app_admin_artiste_ajout', methods: ['GET','POST'])]
    public function AjoutArtistes()
    {   
        $artiste=new Artiste();
        $form=$this->createForm(ArtisteType::class,$artiste);
        return $this->render('admin/artiste/formAjoutArtistes.html.twig', [
            'formArtiste' => $form->createView()
        ]);

    }

}

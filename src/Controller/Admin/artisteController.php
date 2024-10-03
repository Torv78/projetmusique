<?php

namespace App\Controller\Admin;

use App\Entity\Artiste;
use App\Form\ArtisteType;
use App\Repository\ArtisteRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    #[Route('/admin/artiste/modif/{id}', name: 'app_admin_artiste_modif', methods: ['GET','POST'])]
    public function AjoutModifArtistes(Artiste $artiste=null, Request $request, EntityManagerInterface $manager )
    {   
        if($artiste == null){
            $artiste=new Artiste();
            $mode="ajouté";
        }else{
            $mode="modifiée";
        }
        
        $form=$this->createForm(ArtisteType::class,$artiste);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($artiste);
            $manager->flush();
            $this->addflash("success","artiste $mode");
            return $this->redirectToRoute('app_admin_artistes');
        }
        return $this->render('admin/artiste/formAjoutModifArtistes.html.twig', [
            'formArtiste' => $form->createView()
        ]);

    }

    #[Route('/admin/artiste/supp/{id}', name: 'app_admin_artiste_supp', methods: ['GET'])]
    public function suppArtistes(Artiste $artiste, EntityManagerInterface $manager )
    {   
        $nbAlbums=$artiste->getAlbums()->count();
        if($nbAlbums>0){

            $this->addflash("danger","impossible $nbAlbums albulm(s) sont associés");
        }else{
            $manager->remove($artiste);
            $manager->flush();
            $this->addflash("success","artiste supprimer");
        }
            return $this->redirectToRoute('app_admin_artistes');
    }

}

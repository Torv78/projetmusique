<?php

namespace App\Controller\Admin;

use App\Entity\Album;
use App\Form\AlbumType;
use App\Repository\AlbumRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AlbumController extends AbstractController
{
    #[Route('/admin/album', name: 'app_admin_album', methods: ['GET'])]
    public function listeAlbums(AlbumRepository $repo, PaginatorInterface $paginator, Request $request )
    {   
        $lesAlbums = $paginator->paginate(
         $repo->listeAlbumsCompletePaginee(),
         $request->query->getInt('page', 1),
         9 /*limit per page*/
        );
        return $this->render('admin/album/listeAlbum.html.twig', [
            'albums' => $lesAlbums
        ]);

    }


    #[Route('/admin/album/ajout', name: 'app_admin_album_ajout', methods: ['GET','POST'])]
    #[Route('/admin/album/modif/{id}', name: 'app_admin_album_modif', methods: ['GET','POST'])]
    public function AjoutModifAlbum(Album $album=null, Request $request, EntityManagerInterface $manager )
    {   
        if($album == null){
            $album=new Album();
            $mode="ajouté";
        }else{
            $mode="modifiée";
        }
        
        $form=$this->createForm(AlbumType::class,$album);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($album);
            $manager->flush();
            $this->addflash("success","album $mode");
            return $this->redirectToRoute('app_admin_album');
        }
        return $this->render('admin/album/formAjoutModifAlbum.html.twig', [
            'formAlbum' => $form->createView()
        ]);

    }

    #[Route('/admin/album/supp/{id}', name: 'app_admin_album_supp', methods: ['GET'])]
    public function suppAlbum(Album $album, EntityManagerInterface $manager )
    {   
        $nbMorceaux=$album->getMorceaux()->count();
        if($nbMorceaux>0){

            $this->addflash("danger","impossible $nbMorceaux Morceau(x) sont associés");
        }else{
            $manager->remove($album);
            $manager->flush();
            $this->addflash("success","album supprimer");
        }
            return $this->redirectToRoute('app_admin_album');
    }
}

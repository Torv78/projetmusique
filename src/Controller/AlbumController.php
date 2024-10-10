<?php

namespace App\Controller;

use App\Entity\Album;
use App\Repository\AlbumRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AlbumController extends AbstractController
{
    #[Route('/albums', name: 'app_albums', methods: ['GET'])]
    public function listeAlbums(AlbumRepository $repo, PaginatorInterface $paginator, Request $request )
    {
        
        $lesalbums = $paginator->paginate(
            $repo->listeAlbumsCompletePaginee(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            9 /*limit per page*/
        );
        return $this->render('album/listesAlbum.html.twig', [
            'lesalbums' => $lesalbums
        ]);
    }

    #[Route('/album/{id}', name: 'fichealbum', methods: ['GET'])]
    public function ficheAlbums(Album $album )
    {
        
        return $this->render('album/ficheAlbum.html.twig', [
            'lealbum' => $album
        ]);
    }
}

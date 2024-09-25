<?php

namespace App\Controller;

use App\Entity\Album;
use App\Repository\AlbumRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AlbumController extends AbstractController
{
    #[Route('/albums', name: 'app_albums', methods: ['GET'])]
    public function listeAlbums(AlbumRepository $repo)
    {
        $lesalbums=$repo->findAll();
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

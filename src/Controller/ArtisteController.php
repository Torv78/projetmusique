<?php

namespace App\Controller;

use App\Entity\Artiste;
use App\Repository\ArtisteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArtisteController extends AbstractController
{
    #[Route('/artistes', name: 'app_artistes', methods: ['GET'])]
    public function listeArtistes(ArtisteRepository $repo)
    {
        $lesArtistes=$repo->findAll();
        return $this->render('artiste/listesArtistes.html.twig', [
            'lesArtistes' => $lesArtistes
        ]);
    }

    #[Route('/artiste/{id}', name: 'ficheartiste', methods: ['GET'])]
    public function ficheArtistes(Artiste $artiste )
    {
        
        return $this->render('artiste/ficheArtiste.html.twig', [
            'leartiste' => $artiste
        ]);
    }
}

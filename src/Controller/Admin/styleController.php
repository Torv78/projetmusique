<?php

namespace App\Controller\Admin;

use App\Entity\Style;
use App\Form\StyleType;
use App\Repository\StyleRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\Admin\styleController;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class styleController extends AbstractController
{
    #[Route('/admin/style', name: 'app_admin_style')]
    public function index(): Response
    {
        return $this->render('admin/style/index.html.twig', [
            'controller_name' => 'styleController',
        ]);
    }

    #[Route('/admin/style', name: 'app_admin_style', methods: ['GET'])]
    public function listeStyle(StyleRepository $repo, PaginatorInterface $paginator, Request $request )
    {   
        $Styles = $paginator->paginate(
         $repo->listeStyleCompletePaginee(),
         $request->query->getInt('page', 1),
         9 /*limit per page*/
        );
        return $this->render('/admin/style/listeStyle.html.twig', [
            'styles' => $Styles
        ]);

    }


    #[Route('/admin/style/ajout', name: 'app_admin_style_ajout', methods: ['GET','POST'])]
    #[Route('/admin/style/modif/{id}', name: 'app_admin_style_modif', methods: ['GET','POST'])]
    public function AjoutModifStyle(Style $style=null, Request $request, EntityManagerInterface $manager )
    {   
        if($style == null){
            $style=new Style();
            $mode="ajouté";
        }else{
            $mode="modifiée";
        }
        
        $form=$this->createForm(StyleType::class,$style);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($style);
            $manager->flush();
            $this->addflash("success","artiste $mode");
            return $this->redirectToRoute('app_admin_style');
        }
        return $this->render('/admin/style/formAjoutModifStyle.html.twig', [
            'formStyle' => $form->createView()
        ]);

    }

    #[Route('/admin/style/supp/{id}', name: 'app_admin_style_supp', methods: ['GET'])]
    public function suppStyle(Style $style, EntityManagerInterface $manager )
    {   
        $nbAlbums=$style->getAlbums()->count();
        if($nbAlbums>0){

            $this->addflash("danger","impossible $nbAlbums albulm(s) sont associés");
        }else{
            $manager->remove($style);
            $manager->flush();
            $this->addflash("success","style supprimer");
        }
            return $this->redirectToRoute('app_admin_style');
    }
}

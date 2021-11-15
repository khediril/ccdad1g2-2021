<?php

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produit/add", name="produit_add")
     */
    public function add(): Response
    {
        $produit = new Produit();
        $produit->setNom("tomate");
        $produit->setPrix(1600);
        $produit->setDescription("Tomate tunisienne");

        $entityManager= $this->getDoctrine()->getManager();

        $entityManager->persist($produit);

        $entityManager->flush();
        
      
        return $this->render('produit/add.html.twig', ["produit"=>$produit
            
        ]);
    }
}

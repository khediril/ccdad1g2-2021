<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index(): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
    /**
     * @Route("/test1", name="test1")
     */
    public function test1(): Response
    {
       
        $nom = "KHEDHIRI";
        return $this->render('test/test1.html.twig', ["name" => $nom   ]);
    }
      /**
     * @Route("/test2/{prenom}/{nom}", name="test2")
     */
    public function test2($prenom,$nom): Response
    {
       
        $notes = [17,5,15,10,16];
        return $this->render('test/test2.html.twig', 
                     ["name" => $nom,
                      "prenom"=>$prenom, 
                      "notes" => $notes
                    ]);
    }

    
}

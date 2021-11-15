<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/produit2")
 */
class Produit2Controller extends AbstractController
{
    /**
     * @Route("/", name="produit2_index", methods={"GET"})
     */
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('produit2/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }
    /**
     * @Route("/liste/{id}", name="produit2_list_par_categorie", methods={"GET"})
     */
    public function listParCateg(Categorie $categorie,CategorieRepository $categorieRepository): Response
    {
        //$categorie = $categorieRepository->find($id);
       // $produits = $categorie->getProduits();
        return $this->render('produit2/listparcateg.html.twig', [
            'categorie' => $categorie,
        ]);
    }
    /**
     * @Route("/new", name="produit2_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('produit2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit2/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="produit2_show", methods={"GET"})
     */
    public function show(Produit $produit): Response
    {
        return $this->render('produit2/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="produit2_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Produit $produit): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produit2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit2/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="produit2_delete", methods={"POST"})
     */
    public function delete(Request $request, Produit $produit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('produit2_index', [], Response::HTTP_SEE_OTHER);
    }
}

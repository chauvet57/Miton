<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecetteRepository;

class RecetteControleurController extends AbstractController
{
    /**
     * @Route("/recettes", name="recettes")
     */
    public function index()
    {
        return $this->render('recette/index.html.twig', [
            'test' => 'c moi',
        ]);
    }

    /**
     * @Route("/recettes/{id}", name="recette")
     */
    public function show(RecetteRepository $recette, $id ){

        $recettes = $recette->findAll();

        return $this->render('recette/show.html.twig', [
            'recette' => $recettes,
        ]);
    }
}

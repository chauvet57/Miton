<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RecetteControleurController extends AbstractController
{
    /**
     * @Route("/recette/controleur", name="recette_controleur")
     */
    public function index()
    {
        return $this->render('recette_controleur/index.html.twig', [
            'controller_name' => 'RecetteControleurController',
        ]);
    }
}

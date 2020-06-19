<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecetteRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Recette;
use App\Repository\CategorieRepository;


class RecetteControleur extends AbstractController
{
    /**
     * @Route("/recettes", name="recettes")
     */
    public function index(RecetteRepository $recette)
    {
        $recettes = $recette->findAll();

        return $this->render('recette/index.html.twig', [
            'recettes' => $recettes
            
        ]);
    }

    /**
     * @Route("/recettes/{id}", name="recette", methods={"GET|POST"})
     */
    public function show(Recette $recette,Request $request){

        //tout les commentaires
        $commentAlls = $recette->getCommentaire();

        //moyenne des notes
        $moyenne = $recette->getMoyenneNote();
        
        //nombre de note
        $totalNote = $recette->getCommentaire()->count();

        //formulaire
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class,$commentaire);
        $form -> handleRequest($request);
  
        if($form->isSubmitted() && $form->isValid()){

            $commentaire->setRecette($recette);

            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();
            $this->addFlash('success','Votre commentaire a bien était posté !!');
            return $this->redirectToRoute('recette', array(
                'id' => $recette->getId()) );
        }
        
        return $this->render('recette/show.html.twig', [
            'recette' => $recette,
            'commentAlls' => $commentAlls,
            'moyenne' => $moyenne,
            'totalNote' => $totalNote,
            'commentaires' => $form->createView()
           
        ]);
    }


}

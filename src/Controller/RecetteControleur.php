<?php

namespace App\Controller;


use App\Entity\Commentaire;
use App\Entity\Etape;
use App\Entity\Ingredient;
use App\Form\CommentaireType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecetteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Recette;
use App\Repository\AlimentRepository;
use App\Repository\CategorieAlimentRepository;
use App\Repository\UniteMesureRepository;

    /**
     * @Route("/recettes")
     */
class RecetteControleur extends AbstractController
{
    /**
     * @Route("/", name="recettes")
     */
    public function index(RecetteRepository $recette)
    {
        $recettes = $recette->findAll();

        return $this->render('recette/index.html.twig', [
            'recettes' => $recettes
            
        ]);
    }

    /**
     * @Route("/new", name="recettes_new")
     */
    public function recetteNew(UniteMesureRepository $uniteMesure, CategorieAlimentRepository $categorieAliment, AlimentRepository $aliment)
    {
        $uniteMesures = $uniteMesure->findAll();
        $categorieAliments = $categorieAliment->findAll();
        $aliments = $aliment->findAll();

        return $this->render('recette/new.html.twig', [
            'unites' => $uniteMesures,
            'categorieAliments' => $categorieAliments,
            'aliments' => $aliments
            
        ]);
    }

    /**
     * @Route("/new_recette", name="_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $test = $request->request->all();
        $temp = array(); 
        
        for ($i=0; $i < count($test)-1; $i++) { 
          array_push($temp,$test['i'.$i]);
        }
        
        $ingredient = new Ingredient();
        $ingredient->setListeIngredient(json_encode($temp));
        $etape = new Etape();
        $etape->setEtapes(json_encode($test['etape']));
        
        $entityManager = $this->getDoctrine()->getManager();
        //$entityManager->persist($etape);
        $entityManager->persist($ingredient);
        $entityManager->flush();

            return $this->redirectToRoute('recettes');
    }

    /**
     * @Route("/{id}",requirements={"id": "\d+"}, name="recette", methods={"GET|POST"})
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

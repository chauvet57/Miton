<?php

namespace App\Controller;


use App\Entity\Commentaire;
use App\Form\CommentaireType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecetteRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\AlimentRepository;
use App\Repository\CategorieAlimentRepository;
use App\Repository\CategorieRepository;
use App\Repository\DifficulteRepository;
use App\Repository\PrixRepository;
use App\Repository\UniteMesureRepository;
use Symfony\Component\HttpFoundation\Response;

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
    public function recetteNew(Request $request,UniteMesureRepository $uniteMesure, CategorieAlimentRepository $categorieAliment, AlimentRepository $aliment,DifficulteRepository $difficulte,PrixRepository $pri,CategorieRepository $categorie): Response
    {
        $uniteMesures = $uniteMesure->findAll();
        $categorieAliments = $categorieAliment->findAll();
        $aliments = $aliment->findAll();
        $categories = $categorie->findAll();

        $recette = new Recette();
        $form = $this->createForm(RecetteType::class,$recette);
        $form -> handleRequest($request);
        $arImg = array();

        if($form->isSubmitted()){

            //recuperation de la request
            $req = $request->request->all();

            //recup image
            $image = $form->get('image')->getData();
            $images = $form->get('images')->getData();

            $fichier = md5(uniqid()) . '.' . $image->guessExtension();
            $image->move(
                $this->getParameter('images_directory'),
                $fichier
            );
            //recup images
            foreach ($images as $img){
                    $fic = md5(uniqid()) . '.' . $img->guessExtension();
                    $img->move(
                        $this->getParameter('images_directory'),
                        $fic
                    );
                    
             array_push($arImg, $fic);       
            
            }

            //recuperation id
            $difficultes = $difficulte->find((int)$req['recette']['difficulte']);
            $prix = $pri->find((int)$req['recette']['prix']);
            $categories = $categorie->find((int)$req['recette']['categorie']);
            
            //serialisation des etapes,ingredient,temps
            $etape = serialize($req['recette']['etape']);
            $ingredient = serialize($req['recette']['ingredient']);
            $temps = serialize($req['recette']['temps']);
            
            //recomposition de notre objet recette
            $recette->setNomRecette($req['recette']['nom_recette']);
            $recette->setTemps($temps);
            $recette->setNombrePersonne($req['recette']['nombre_personne']);
            $recette->setImage($fichier);
            $recette->setImages($arImg);
            $recette->setIngredient($ingredient);
            $recette->setValide(true);
            $recette->setUser($this->getUser());
            $recette->setEtape($etape);
            $recette->setDifficulte($difficultes);
            $recette->setPrix($prix);
            $recette->addCategory($categories);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recette);
            $entityManager->flush();
            
                return $this->redirectToRoute('recettes');

        }

                return $this->render('recette/new.html.twig', [
                    'unites' => $uniteMesures,
                    'categorieAliments' => $categorieAliments,
                    'aliments' => $aliments,
                    'categories' => $categories,
                    'recette' => $form->createView()
                    
                ]);
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
//dd($form);
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

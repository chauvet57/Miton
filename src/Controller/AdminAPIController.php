<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Recette;
use App\Repository\CategorieRepository;
use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class AdminAPIController extends AbstractController
{
    /**
     * @Route("/admin/a/p/i", name="admin_a_p_i", methods={"GET","POST"})
     */
    public function index(RecetteRepository $recette,SerializerInterface $serializer,RecetteRepository $recCategorie)
    {
        $recettes = $recette->findAll();
        $liste = array();

       for ($i=0; $i < count($recettes); $i++) { 
        
            $rec = new Recette();
            $cat = $recCategorie->findIdCat($recettes[$i]->getId());
            $ing = unserialize($recettes[$i]->getIngredient());
            $com = $recettes[$i]->getCommentaire()->getValues();
//dd();
        $rec->setId($recettes[$i]->getId());
        $rec->setNomRecette($recettes[$i]->getNomRecette());
        $rec->setValide(false);
        $rec->setTemps(unserialize($recettes[$i]->getTemps()));
        $rec->setNombrePersonne($recettes[$i]->getNombrePersonne());
        $rec->setImage($recettes[$i]->getImage());
        $rec->setImages(unserialize($recettes[$i]->getImages()));
        $rec->addCategory($cat->getValue($cat)[0]);
            if(count($ing) > 0){
                $tab = array();
                for ($r=0; $r < count($ing); $r++) { 
                    array_push($tab,$ing[$r]);
                }
            }
        $rec->setIngredient($tab);
        //$rec->setUser($recettes[$i]->getUser()->getPseudo());

        //$rec->addCommentaire($com);
//dd(json_encode($com));

        $rec->setMoyenneNote($recettes[$i]->getMoyenneNote());
        $rec->setTotalNote($recettes[$i]->getTotalNote());
        //$rec->setPrix($recettes[$i]->getPrix());
        //$rec->setPrix($recettes[$i]->getDifficulte());
        //$rec->setPrix($recettes[$i]->getEtape());

        
        array_push($liste,$rec);
        $data = $serializer->serialize($liste, 'json',['ignored_attributes' => ['recette']]);
           
           
       }
      

       return new JsonResponse($data, 200, [], true); 
    }
}

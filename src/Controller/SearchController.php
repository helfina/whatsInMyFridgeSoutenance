<?php

namespace App\Controller;

use PDO;
use App\Repository\RecetteRepository;
use App\Repository\IngredientRepository;
use App\Repository\CompositionRepository;
use App\Repository\UserRepository;
use stdClass;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{


    #[Route('/search_compo', name: 'app_search_compo')]
    public function index(Request $rq, IngredientRepository $ir, CompositionRepository $cr, RecetteRepository $rr): Response
    {

        $list = $rq->query->get("js_object");

        $array = explode(',', $list);


        $recettes = $rr->findAll();
        $ingredients = $ir->findAll();
        $compos = $cr->findAll();

        foreach ($array as $arr) {
            foreach ($ingredients as $ingredient) {
                if ($ingredient->getName() == $arr) {
                    $ingId[] = $ingredient->getId();
                }
            }

        }
        $cleanedIngredients = array();
        $cleanedCompos = array();
        $cleanedRecettes = array();
        foreach ($ingredients as $item) {
            $obj = new stdClass;
            $obj->id = $item->getId();
            $obj->name = $item->getName();
            array_push($cleanedIngredients, $obj);
        };
        foreach ($recettes as $item) {
            $obj = new stdClass;
            $obj->id = $item->getId();
            $obj->title = $item->getTitle();
            array_push($cleanedRecettes, $obj);
        };
        foreach ($compos as $item) {
            $obj = new stdClass;
            $obj->ingredient_id = $item->getIngredient()->getId();
            $obj->recette_id = $item->getRecette()->getId();
            array_push($cleanedCompos, $obj);
        }
        $ingResult = array();

        foreach ($cleanedIngredients as $cing) {
            foreach ($array as $arr) {
                if ($cing->name === $arr) {
                    $obj = new stdClass;
                    $obj->id = $cing->id;
                    $obj->name = $cing->name;
                    array_push($ingResult, $obj);
                }
            }
        }
        $compoResult = array();
        foreach ($cleanedCompos as $cc) {
            foreach ($ingResult as $irr) {
                if ($irr->id === $cc->ingredient_id) {
                    $obj = new stdClass;
                    $obj->ingredient_id = $irr->id;
                    $obj->recette_id = $cc->recette_id;
                    array_push($compoResult, $obj);

                }
            }

        }

        $idsfinal = array();
        foreach ($compoResult as $cdc) {

            array_push($idsfinal, $cdc->recette_id);
        }

        $arrayl = sizeof($array);


        $counts = array_count_values($idsfinal);

        $idfinal = array();
        foreach ($counts as $id => $idr) {

            if ($idr >= $arrayl) {

                array_push($idfinal, $id);
            }

        }


        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
            'list' => $list,
            'recettes' => $rr->findAll(),
            'compos' => $cr->findAll(),
            'ingredients' => $ir->findAll(),
            'array' => $array,
            'idfinal' => $idfinal


        ]);
    }
}


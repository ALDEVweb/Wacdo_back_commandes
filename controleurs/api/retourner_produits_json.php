<?php

// Contrôleur API : retourne la liste des produits au format json
// Paramètres : aucun

// initialisation

use fraldev\classes\Categorie;
use fraldev\classes\Produit;

// entête cors
include "utils/cors.php";

// entete spécifiant que le retour sera un json
header('Content-Type: application/json');

include "utils/init.php";

// construction
// récupération de la liste des catégorie
$categorie = new Categorie();
$listeCategories = $categorie->listAll();
$produits = [];
// pour chaque catégorie, on initialise un tableau
foreach ($listeCategories as $categorie) {
    // on récupère la liste des produit associé
    $produit = new Produit();
    $produitsByCat = $produit->listAll(['categorie' => $categorie->id]);
    // on initialise un tableau des prods
    $prods = [];
    // pour chaque produit on charge les valeur dans le tableau des prods
    foreach ($produitsByCat as $produit) {
        $prods[] = ['id' => $produit->id, 'nom' => $produit->nom, 'prix' => $produit->prix, 'image' => $produit->image];
    }
    // on charge le tableau dans le tableau principal à la clé de la catégorie
    $produits[$categorie->nom] = $prods;
}

// retour
// Encoder le tableau en JSON et envoyer la réponse
echo json_encode($produits);
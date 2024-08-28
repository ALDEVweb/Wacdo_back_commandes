<?php

// Contrôleur API : retourne la liste des categories au format json
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
$categories = [];
// pour chaque catégorie, on initialise un tableau
foreach ($listeCategories as $categorie) {
    // on ajoute l'objet categorie au tableau des categories
    $categories[] = ['id' => $categorie->id, 'title' => $categorie->nom, 'image' => $categorie->image];
}

// retour
// Encoder le tableau en JSON et envoyer la réponse
echo json_encode($categories);
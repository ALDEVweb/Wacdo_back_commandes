<?php

// Contrôleur API : reçoit une demande d'enregistrement d'une commande et la met à jour
// Paramètres : $json = file_get_contents('php://input') : fichier json envoyé par l'appli, composé de :
//                  - id de la commande à enregistrer
//                  - panier de la commande

// entête cors

use fraldev\classes\Commande;
use fraldev\classes\Composition;
use fraldev\classes\Menu;

include "utils/cors.php";

// entete spécifiant que le retour sera un json
header('Content-Type: application/json');

include "utils/init.php";

// récupération

//récupération du json
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// récupération de l'id de la commande
$idCommande = isset($data['commande']) ? $data['commande'] : 0;
// récupération des articles de la commande
$articles = isset($data['articles']) ? $data['articles'] : [];
// récupération du numero d'enregistrement
$enregistrement = isset($data['enregistrement']) ? $data['enregistrement'] : 0;

if($idCommande == 0 || $articles == [] || $enregistrement == 0){
    $reponse = ["message" => "La commande est incomplète", "message" => "La commande est incomplète", 'idCde' => $idCommande, 'articles' => $articles, 'enregistrement' => $enregistrement];
    echo json_encode($reponse);
    exit;
} 

// traitement
// mise à jour de la commande
// on instancie une nouvelle commande avec l'id de la commande
$commande = new Commande($idCommande);
// on met à jour la commande avec le numéro d'enregistrement, la date et son état à ENR
$commande->enregistrementCde($enregistrement);

// enregistrement des articles de la commande dans des compositions
foreach($articles as $index => $article){
    // on instancie une nouvelle composition
    $composition = new Composition();
    $composition->commande = $idCommande;
    if($article['categorie'] == 'menus'){
        // on instancie un nouveau menu
        $menu = new Menu();
        // on met à jour le menu avec les informations de l'article et on récupère l'id du menu créé
        $idMenu = $menu->createMenu($article);
        // on attache le menu à la composition
        $composition->menu = $idMenu;
    }else{
        // on attache le prodId au produit de la composition
        $composition->produit = $article['prodId'];
    }
    // on charge la composition avec leks autres élément, on la crée et récupère l'id
    $composition->createCompo($article);
}

// retour
$reponse = ["message" => "Commande enregistrée avec succès"];
echo json_encode($reponse);
exit;
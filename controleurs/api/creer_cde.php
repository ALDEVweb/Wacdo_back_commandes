<?php

// Controleur API : reçoit une demande de création de commande, la crée et retourne les numéro cde et conso
// Paramètres : $_POST['consommation'] : le type de consommation choisit par le client

// initialisation

use fraldev\classes\Commande;

// entête cors
include "utils/cors.php";

// entete spécifiant que le retour sera un json
header('Content-Type: application/json');

include "utils/init.php";

// récupération
$consommation = isset($_GET['consommation']) ? $_GET['consommation'] : '';

// traitement
// instanciation d'une commande
// on la charge avec la consommation
// on la crée dans la BDD
$commande = new Commande();
$commande->consommation = $consommation;
$commande->insert();
// récupération du num de cde
$numCde = $commande->id;
// récupération des commandes qui ont la meme consommation que cette commande
$listeConso = $commande->listAll(['consommation' => $consommation]);
$numConso = count($listeConso);

// retour
echo json_encode(['numCde' => $numCde, 'numConso' => $numConso]);
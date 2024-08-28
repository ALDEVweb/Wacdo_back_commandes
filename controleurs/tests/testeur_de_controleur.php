<?php

// programme de test d'un controlleur

// forcer les parametre GET, POST ou tout autre necessaire au fonctionnement d'un controlleur
$_GET = ["idUtilisateur" => 3]; // mettre les champs valeur désiré
$_POST = ['mail' => 'test@test']; // mettre les champs valeur désiré
$_REQUEST = array_merge($_GET, $_POST); // si on a des test sur request on rassemble les 2 tableaux


// on inclu le controleur 
include "../retourner_produits_json.php"; // pas de header car on a pas initialiser ce fichier
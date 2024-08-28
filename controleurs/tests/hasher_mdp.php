<?php


// controleur de générations d'un hash directement via un echo sur page vierge. a toute fin de le rentrer dans la bdd

ini_set("display_errors", 1);       // Aficher les erreurs
error_reporting(E_ALL);             // Toutes les erreurs


$mdp = "Antoine1";
$hash = password_hash($mdp, PASSWORD_DEFAULT);
echo"$mdp : $hash";
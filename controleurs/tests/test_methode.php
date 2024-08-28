<?php


use fraldev\classes\Produit;
use fraldev\classes\Utilisateur;

// contrôlleur de test d'une méthode simple

include "./utils/init.php";

$idUtilisateur = isset($_GET['idUtilisateur']) ? $_GET['idUtilisateur'] : 0;
$mail = isset($_POST['mail']) ? $_POST['mail'] : '';
$utilisateur = new Utilisateur($idUtilisateur);
$utilisateur->mail = $mail;
print_r($utilisateur);
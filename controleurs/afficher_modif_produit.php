<?php

// Contrôleur : Demande l'affichage du formulaire de modification d'un produit et fournit le produit à modifier
// Paramètre : $_SESSION['idUtilisateurConnecte'] : id de l'utilisateur connecte
//             $_POST['idProduit'] : id du produit à modifier

// initialisation

use fraldev\classes\Produit;
use fraldev\classes\Utilisateur;

use function fraldev\utils\session_idconnected;
use function fraldev\utils\session_isconnected;

include "utils/init.php";
include "utils/verif_connexion.php";

// récupération
//récupération de l'utilisateur connecté
$utilisateurConnecte = new Utilisateur($idUtilisateurConnecte);
// si l'utilisateur a les droit ADMIN, on continue, sinon on retourne sur la page d'accueil
$statut = $utilisateurConnecte->statut;
if ($statut != 'ADMIN') {
    header('Location: index.php');
    exit;
}
// récupération du produit à modifier
$idProduit = isset($_GET['idProduit']) ? $_GET['idProduit'] : 0;
if($idProduit == 0){
    $page = 'accueil';
    include 'utils/appel_pages.php';
}
$produit = new Produit($idProduit);

// traitement

// affichage

$page = "modif_produit";
include "utils/appel_pages.php";
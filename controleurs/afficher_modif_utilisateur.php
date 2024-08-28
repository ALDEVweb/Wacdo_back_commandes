<?php

// Contrôleur : Demande l'affichage du formulaire de modification d'un utilisateur et fournit l'utilisateur à modifier
// Paramètres : $_SESSION['idUtilisateurConnecte'] : id de l'utilisateur connecte
//              $_GET['idUtilisateur'] : id de l'utilisateur à modifier
//              $_GET['erreur'] : si erreur lors de la saisie du mail par exemple

// initialisation

use fraldev\classes\Utilisateur;

include "utils/init.php";
include "utils/verif_connexion.php";

// récupération
$erreur = isset($_GET['erreur']) ? isset($_GET['erreur']) : '';

//récupération de l'utilisateur connecté
$utilisateurConnecte = new Utilisateur($idUtilisateurConnecte);
// si l'utilisateur a les droit ADMIN, on continue, sinon on retourne sur la page d'accueil
$statut = $utilisateurConnecte->statut;
if ($statut != 'ADMIN') {
    header('Location: index.php');
    exit;
}
// récupération du produit à modifier
$idUtilisateur = $_GET['idUtilisateur'];
$utilisateurModif = new Utilisateur($idUtilisateur);

// traitement

// affichage

$page = "modif_utilisateur";
include "utils/appel_pages.php";
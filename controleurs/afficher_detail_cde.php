<?php

// Controleur : récupère les infos de la commande et affiche une checklist pour la préparé
// parametres : $_SESSION['idUtilisateurConnecte'] : id de l'utilisateur connecte
//              $_GET['idCommande'] : id de la commande a afficher

//initialisation

use fraldev\classes\Commande;
use fraldev\classes\Composition;
use fraldev\classes\Option;
use fraldev\classes\Utilisateur;

include "utils/init.php";
include "utils/verif_connexion.php";

// récupération
// utilisateur connecté si pas prep ou admin redirige vers l'accueil
$utilisateurConnecte = new Utilisateur($idUtilisateurConnecte);
$idCommande = isset($_GET['idCommande']) ? $_GET['idCommande'] : 0;
if($utilisateurConnecte->statut == 'ACC'){
    header('Location: index.php?controleur=afficher_accueil');
    exit;
}
// la cde a afficher
$commande = new Commande($idCommande);
$composition = new Composition(); 
$listeCompos = $composition->listeCompo($idCommande);

// traitement
$commande->etat = 'ENC';
$commande->update();

// affichage
$page = "prepa_cde";
include "utils/appel_pages.php";
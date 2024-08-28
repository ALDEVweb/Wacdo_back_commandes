<?php

// Contrôleur : si EC devient PRE, si PRE devient LIVR, puis redirige vers afficher_accueil.php
// Paramètres : $_GET['idCommande'] : id de la commande à modifier
//              $_POST : toutes les checkbox envoyé
//              $_SESSION['idUtilisateurConnecte'] : id de l'utilisateur connecte

// initialisation

use fraldev\classes\Commande;
use fraldev\classes\Utilisateur;

include "utils/init.php";
include "utils/verif_connexion.php";

// récupération
$utilisateurConnecte = new Utilisateur($idUtilisateurConnecte);
$idCommande = isset($_GET['idCommande']) ? $_GET['idCommande'] : 0;
$commande = new Commande($idCommande);
$allCheck = isset($_GET['nbrCheckbox']) ? $_GET['nbrCheckbox'] : 0;
$nbrCheck = isset($_POST) ? count($_POST) : 0;

// traitement


// si etat cde = PRE et statut utilisateur = ACC ou ADMIN, on passe l'etat à livré
if ($commande->etat == 'PRE' && ($utilisateurConnecte->statut == 'ACC' || $utilisateurConnecte->statut == 'ADMIN')){
    $commande->etat = 'LIV';
    $commande->update();
} 

// si etat cde = ENC et statut utilisateur = PREP ou ADMIN, on passe l'état à preparé
if ($commande->etat == 'ENC' && ($utilisateurConnecte->statut == 'PREP' || $utilisateurConnecte->statut == 'ADMIN')){
    if($nbrCheck == $allCheck){
        $commande->etat = 'PRE';
        $commande->update();
    }else{
        $erreur = "La commande n'est pas complète";
        header("Location: index.php?controleur=afficher_detail_cde&idCommande=$idCommande&erreur=$erreur");
        exit;
    }
} 

// affichage
header('Location: index.php?controleur=afficher_accueil');
exit;
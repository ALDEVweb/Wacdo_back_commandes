<?php

// Contrôleur : enregistre l'utilisateur modifié dans la bdd
// Paramètres : Les infos de l'utilisateur à modifier :
//              $_GET['idUtilisateur'] : id de l'utilisateur à modifier
//              $_POST['nom'] : nom de l'utilisateur
//              $_POST['prenom'] : prenom de l'utilisateur
//              $_POST['statut'] : statut de l'utilisateur
//              $_POST['mail'] : mail de l'utilisateur
//              $_POST['mdp'] : mdp de l'utilisateur

// initialisation

use fraldev\classes\Utilisateur;

include 'utils/init.php';
include 'utils/verif_connexion.php';
if($utilisateurConnecte->statut != 'ADMIN'){
    $page = 'accueil';
    include "utils/appel_pages.php";
}

// récupération
$idUtilisateur = isset($_GET['idUtilisateur']) ? $_GET['idUtilisateur'] : 0;
$nom = isset($_POST['nom']) ? $_POST['nom'] : '';
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
$statut = isset($_POST['statut']) ? $_POST['statut'] : '';
$mail = isset($_POST['mail']) ? $_POST['mail'] : '';
$mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';

// s'il existe on récupère l'utilisateur
if($idUtilisateur != 0) $utilisateur = new Utilisateur($idUtilisateur);

// traitement
$utilisateur->nom = strtoupper($nom);
$utilisateur->prenom = ucfirst(strtolower($prenom));
if($statut == 'ACC' || $statut == 'PREP' || $statut == '$ADMIN') $utilisateur->statut = $statut;
else{
    $erreur = 'Statut non valide';
    header(`Location: index.php?controleur=afficher_modif_utilisateur&erreur=$erreur`);
    exit;
} 

if ($mail != ''){
    if(filter_var($mail, FILTER_VALIDATE_EMAIL)) $utilisateur->mail = $mail;
    else{
        $erreur = 'Adresse mail non valide';
        header(`Location: index.php?controleur=afficher_modif_utilisateur&erreur=$erreur`);
        exit;
    }
}
if($mdp != '') $utilisateur->mdp = password_hash($mdp, PASSWORD_DEFAULT);

$utilisateur->update();

// affichage
header('Location: afficher_accueil.php');
exit;
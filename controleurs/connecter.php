<?php

// Contrôleur : Vérifie la cohérence des parametres avec les infos de la base de données et redireige vers afficher_accueil.php
// Paramètres : $_POST['mail'] : mail de l'utilisateur à connecter
//              $_POST['mdp'] : mdp de l'utilisateur à connecter

// initialisation

use fraldev\classes\Utilisateur;
use function fraldev\utils\session_connect;

include "utils/init.php";

// récupération
$mail = isset($_POST["mail"]) ? $_POST["mail"] : "";
$mdp = isset($_POST["mdp"]) ? $_POST["mdp"] : "";

// traitement
// instanciation d'un objet utilisateur vierge
$utilisateur = new Utilisateur();
// vérification de la correspondance des identifiant (récupération de l'id)
$idUtilisateur = $utilisateur->checkPwd($mail, $mdp);

// si l'id est égal à 0, echec de l'authentification, je renvoi sur la page connexion
if($idUtilisateur == 0){
    $erreur = 'Erreur de saisie sur le mail ou le mot de passe';
    header("Location: index.php?controleur=afficher_accueil&erreur=$erreur");
    exit;
}

// sinon, je connecte l'utilisateur
session_connect($idUtilisateur);

// affichage
// (redirection vers le controleur afficher_accueil)
header("Location: index.php?controleur=afficher_accueil");
exit;
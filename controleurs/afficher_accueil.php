<?php

// Contrôleur : Verifie si un utilisateur est connecté,
//            - si non : demande l'affichage la page de connexion
//            - si oui : demande l'affichage de la page d'accueil et fournit si administrateur : 
//                  - liste des catégories
//                  - liste des produits
//                  - liste des utilisateur 
//Paramètres : $_SESSION['idUtilisateurConnecte'] : id de l'utilisateur connecte

// initialisation

use fraldev\classes\Categorie;
use fraldev\classes\Produit;
use fraldev\classes\Utilisateur;

use function fraldev\utils\session_idconnected;
use function fraldev\utils\session_isconnected;

include "utils/init.php";

// récupération
include "utils/verif_connexion.php";

// traitement
// on récupère l'utilisateur connecté
$utilisateurConnecte = new Utilisateur($idUtilisateurConnecte);
// on récupère son statut
$statut = $utilisateurConnecte->get("statut");
// si son statut est admin
if ($statut == "ADMIN") {
    // on récupère la liste des catégorie
    $categorie = new Categorie();
    $listeCategories = $categorie->listAll();
    // on récupère la liste des utilisateur
    $listeUtilisateurs = $utilisateurConnecte->listAll();
    // on instancie un objet produit vide
    $produit = new Produit();
}

// affichage
$page = "accueil";
include "utils/appel_pages.php";
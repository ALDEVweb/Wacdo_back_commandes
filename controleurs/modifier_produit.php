<?php

// Contrôleur : enregistre le produit modifié dans la bdd
// Paramètres : les infos du produit à modifier :
//              $_GET['idProduit'] : id du produit à modifier
//              $_POST['nom'] : nom du produit
//              $_POST['image'] : chemin de l'image du produit
//              $_POST['prix'] : prix du produit
//              $_POST['disponible'] : disponibilite du produit

// initialisation

use fraldev\classes\Produit;
use fraldev\classes\Utilisateur;

include "utils/init.php";
include "utils/verif_connexion.php";
$utilisateurConnecte = new Utilisateur($idUtilisateurConnecte);
if($utilisateurConnecte->statut != 'ADMIN'){
    $page = 'accueil';
    include "utils/appel_pages.php";
}

// récupération
$idProduit = isset($_GET['idProduit']) ? $_GET['idProduit'] : 0;
$nom = isset($_POST['nom']) ? $_POST['nom'] : '';
$image = isset($_POST['image']) ? $_POST['image'] : '';
$prix = isset($_POST['prix']) ? $_POST['prix'] : 0;
$disponible = isset($_POST['disponible']) ? $_POST['disponible'] : '';

// s'il existe on récupère le produit
if($idProduit != 0) $produit = new Produit($idProduit);

// traitement
// on charge le produit avec les valeurs du formulaire
$produit->nom = $nom;
$produit->image = $image;
$produit->prix = $prix;
$produit->disponible = $disponible;
// on met à jour le produit dans la bdd
$produit->update();

// si le produit est un burger(id 3) ou un menu(id 1)
if($produit->categorie == 1 || $produit->categorie == 3){
    // on charge un nouveau produit
    $produitCommun = new Produit();  
    // on cherche le produit correspondant
    $produitCommun->findProduitCommun($produit);
    // on charge sa disponibilite avec la valeur de disponible du produit déjà modifié
    $produitCommun->disponible = $disponible;
    // on met à jour le produit dans la bdd
    $produitCommun->update();
}

// affichage
header('Location: afficher_accueil.php');
exit;
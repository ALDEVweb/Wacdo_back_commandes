<?php 

// Utilitaire de création des infos d'une page de l'application et de l'include du layout
// parametre : $page - la page appelé par le controleur

if($page === 'accueil'){
    $title = "Page d'accueil de l'application de gestion de commandes de Wacdo";
    $metaDesc = "Gestion des commandes de Wacdo à chaque étape, à partir du moment où elles sont enregistré, en cours de préparation, prète et enfin livré au client";
}else if($page === 'connexion'){
    $title = "connexion à Wacdo back commandes";
    $metaDesc = "Page de connexion à l'application de gestion des commandes Wacdo";
    $page = "fraldev_pages/connexion";
}else if($page === 'modif_utilisateur'){
    $title = "Page de modification d'un collaborateur Wacdo";
    $metaDesc = "Gestion d'un collaborateur Wacdo, modification des nom, prénom, mail et statut";
}else if($page === 'modif_produit'){
    $title = "Page de modification d'un produit Wacdo";
    $metaDesc = "Gestion d'un produit wacdo, modification des catégorie, nom, prix, image et disponibilité";
}else if ($page === "prepa_cde"){
    $title = "Page de préparation d'une commande Wacdo";
    $metaDesc = "Page détaillant une commande Wacdo sous forme de checklist afin de la préparer";
}
include "templates/layout.php";
exit;
<?php

// Contrôleur Ajax :en fonction du statut de l'utilisateur, renvoi un template avec la liste des commandes :
//  - non livré si ADMIN
//  - non prete si PREP
//  - livrable si ACC
// Paramètres : $_SESSION['idUtilisateurConnecte'] : id de l'utilisateur connecte

// initialisation

use fraldev\classes\Commande;
use fraldev\classes\Utilisateur;

include "utils/init.php";
include "utils/verif_connexion.php";

// récupération
$utilisateurConnecte= new Utilisateur($idUtilisateurConnecte);
// on instancie une commande vierge
$commande = new Commande();
// si utilisateur connecte est Admin on liste toute les commandes
if ($utilisateurConnecte->statut == 'ADMIN') $listeCommande = $commande->listNonLivre();
// si utilisateur connecte est prep on liste les commande non livrable
else if ($utilisateurConnecte->statut == 'PREP') $listeCommande = $commande->listAll(['etat' => 'ENR', 'etat' => 'ENC'], ['+date']);
// si utilisateur connecte est acc on liste les commande livrable
else if ( $utilisateurConnecte->statut == 'ACC') $listeCommande = $commande->listAll(['etat' => 'PRE'], ['+date']);

// traitement
$html = '';
// construction de la liste à afficher
foreach($listeCommande as $commande) {
    $dateTimeCde = new DateTime($commande->date);
    $timeCde = $dateTimeCde->format('H:i');
    $consoCde = $commande->consommation;
    $numCde = $commande->id;
    $enrCde = $commande->enregistrement;
    if ( $commande->etat == 'ENR' ){
        $etatCde = 'Enregistrée';
        $action = "index.php?controleur=afficher_detail_cde&idCommande=$numCde";
        $btn = "→";
    }else if ( $commande->etat == 'ENC' ){
        $etatCde = 'En préparation';
        $action = "index.php?controleur=afficher_detail_cde&idCommande=$numCde";
        $btn = "...";
    }else if ( $commande->etat == 'PRE' ){
        $etatCde = 'Préparée';
        $action = "index.php?controleur=modifier_etat_cde&idCommande=$numCde";
        $btn = "→";
    }
    $html .= "<li class='large-12'><a class='large-12 flex a-center j-between' href='$action'><p>$timeCde</p><p>n°$numCde</p><p>$consoCde</p><p>$enrCde</p><p>$etatCde</p><p>$btn</p></a></li>";
}

// retour
echo $html;

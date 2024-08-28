<?php

namespace fraldev\classes;

use fraldev\modeles\_model;

/*

classe Produit étendu de la classe _model

    Utilisation :
            
        * Méthodes :

*/

class Produit extends _model {

    protected $table = "produit";

    protected function define(){
        // création des champs de la class
        $this->addField("nom", $type = "TEXT", $libelle = "Nom");
        $this->addField("prix", $type = "NUMBER", $libelle = "prix");
        $this->addField("image", $type = "TEXT", $libelle = "Image");
        $this->addField("categorie", $type = "NUMBER", $libelle = "Categorie", $link = "Categorie");
        $this->addField("disponible", $type = "CHECKBOX", $libelle = "Disponible");
    }

    function recapProduit($produit){
        // création d'une ligne récapitulative d'un produit à insérer dans une liste
        // param : le produit à insérer
        // return : html de la ligne récapitulative

        // récupération de l'id du produit
        $id = $produit->id;
        // récupération de l'image du produit
        $image = htmlentities($produit->image);
        // récupération du nom du produit
        $nom = htmlentities($produit->nom);
        // récupération du prix du produit
        $prix = htmlentities($produit->prix);
        // récupération de la disponibilité du produit
        $disponible = $produit->disponible == 1 ? "txt-one" : "non-valide";

        // construction du code html à retourner
        return "<li class='large-12'><a class='flex a-center gap4' href='index.php?controleur=afficher_modif_produit&idProduit=$id'><img class='image-produit-recap' src='assets/images/produits$image' alt='illustration de $nom'><p class='$disponible'>$nom, $prix</p></a></li>";
    }

    function findProduitCommun($produit){
        // recherche le produit en commun avec le nom donnée et retourne son id
        // parametre : aucun
        // retour : l'id du produit trhouvé

        if($produit->categorie == 3) $nomCommun = 'Menu ' . $produit->nom;
        else if($produit->categorie == 1) $nomCommun = str_replace('Menu ', '', $produit->nom);

        // construction
        $sql = "SELECT `id`, ". $this->makeFields() . " FROM `$this->table` WHERE `nom` = :nom";
        $param = [":nom" => $nomCommun];
        
        // préparation/execution
        $req = $this->runSql($sql, $param);

        // récupération / retour
        return $this->recoverReqSimple($req);
    }
}
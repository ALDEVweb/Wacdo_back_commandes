<?php

namespace fraldev\classes;

use fraldev\modeles\_model;

/*

classe Menu étendu de la classe _model

    Utilisation :
            
        * Méthodes :

*/

class Menu extends _model {

    protected $table = "menu";

    protected function define(){
        // création des champs de la class
        $this->addField("burger", $type = "LINK", $libelle = "Burger", $link = "Produit");
        $this->addField("frite", $type = "TEXT", $libelle = "Frite");
        $this->addField("sauce", $type = "LINK", $libelle = "Sauce", $link = "Produit");
        $this->addField("boisson", $type = "LINK", $libelle = "Boisson", $link = "Produit");
    }

    function createMenu($article){
        // fonction de création d'un menu
        // parametre : $article = l'article reçu dans la commande
        // retour : l'id du menu créé

        // on charge le burger du menu avec le prodId de l'article
        $this->burger = $article['prodId'];
        // on charge la frite du menu avec l'option frites de l'article
        $this->frite = $article['options'][0]['frites'];
        // on charge la sauce du menu avec l'option sauces de l'article
        $this->sauce = $article['options'][0]['sauces'];
        // on charge la boisson du menu avec l'option boisson de l'article
        $this->boisson = $article['options'][0]['boissons'];       
        
        // on insert l'article dans la bdd
        $this->insert();

        // on retourne l'id
        return $this->id;

    }
}
<?php

namespace fraldev\classes;

use fraldev\modeles\_model;

/*

classe Composition étendu de la classe _model

    Utilisation :
            
        * Méthodes :

*/

class Composition extends _model {

    protected $table = "composition";

    protected function define(){
        // création des champs de la class
        $this->addField("commande", $type = "LINK", $libelle = "Commande", $link = "Commande");
        $this->addField("produit", $type = "LINK", $libelle = "Produit", $link = "Produit");
        $this->addField("menu", $type = "LINK", $libelle = "Menu", $link = "Menu");
        $this->addField("option", $type = "LINK", $libelle = "Option", $link = "Option");
        $this->addField("quantite", $type = "NUMBER", $libelle = "Quantité");
    }

    function createCompo($article){
        // fonction de création d'une composition avec les élements de l'article (idCde quantite et taille)
        // parametre : $article = l'article a ajouter à la composition
        // retour : aucun

        // on chargela quantite de la composition avec la quantite de l'article
        $this->quantite = $article['quantite'];
        // si elle existe on charge l'option de la composition avec l'options taille de l'article
        if (count($article['options']) != 0) $this->option = $article['options'][0]['taille'];

        // on insére la composition dans la bdd et on récupère l'id
        $this->insert();
    }

    function listeCompo($idCommande){
        // récupère la liste des composition d'une commande
        // parametre : $idCommande = id de la commande concerné
        // rethour : un tableau indexé des compositions

        // construction
        $sql = "SELECT id, " . $this->makeFields() . " FROM `$this->table` WHERE `commande` = :id";
        $param = [':id' => $idCommande];

        // préparation/exécution
        $req = $this->runSql($sql, $param);

        // récupération/retour
        return $this->recoverReqMulti($req);

    }
    
    function genCheckList(){
        // fonction de génération de la check list d'une composition
        // parametre : aucun
        // retour : un element html

        // on initialise le html
        $html = "";
        // on récupère l'id de la composition
        $id = $this->id;
        // on récupère la quantité
        $qte = $this->quantite;
        // si l'option est chargé, on récupère l'option lié et son nom
        if(!is_null($this->option)){
            $taille = $this->getTarget("option");
            $nomTaille = $taille->nom;
        }else $nomTaille = "";
        // si produit est chargé
        if(!is_null($this->produit)){
            // on récupère le produit lié
            $produit = $this->getTarget("produit");
            // on récupère le nom du produit
            $nomProduit = $produit->nom;
            // on ajoute une ligne au html
            $html = "<label class='flex a-center gap8 mb16'><input type='checkbox' name='produit-$id' id='produit-$id'><b>$qte $nomProduit $nomTaille</b></label>";
        }else if(!is_null($this->menu)){
        // sinon si c'est le menu qui est chargé
            // on récupère le menu lié
            $menu = $this->getTarget("menu");
            // on ajoute la taille et la quantité du menu en priorité
            $html = "";
            // on récupère ensuite les burger, frite, sauce et boisson lié ainsi que leur nom
            $burger = $menu->getTarget('burger');
            $sauce = $menu->getTarget('sauce');
            $boisson = $menu->getTarget('boisson');
            $nomBurger = $burger->nom;
            $nomFrite = $menu->frite;
            $nomSauce = $sauce->nom;
            $nomBoisson = $boisson->nom;
            // on ajoute une ligne au html
            $html .= "
                <label class='flex a-center gap8 mb8'><input type='checkbox' name='menu-$id' id='menu-$id'><b>$qte $nomBurger $nomTaille :</b></label>
                <div class='ml32 mb16'>
                    <label class='flex a-center gap8 mb8'><input type='checkbox' name='frite-$id' id='frite-$id'>$nomFrite</label>
                    <label class='flex a-center gap8 mb8'><input type='checkbox' name='sauce-$id' id='sauce-$id'>$nomSauce</label>
                    <label class='flex a-center gap8 mb8'><input type='checkbox' name='boisson-$id' id='boisson-$id'>$nomBoisson</label>
                </div>
            ";
        }
        // on retourne le html
        echo $html;       
    }
}
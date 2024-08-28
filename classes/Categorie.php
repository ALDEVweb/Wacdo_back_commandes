<?php

namespace fraldev\classes;

use fraldev\modeles\_model;

/*

classe Categorie étendu de la classe _model

    Utilisation :
            
        * Méthodes :

*/

class Categorie extends _model {

    protected $table = "categorie";

    protected function define(){
        // création des champs de la class
        $this->addField("nom", $type = "TEXT", $libelle = "Nom");
        $this->addField("image", $type = "TEXT", $libelle = "Image");
    }

}
<?php

namespace fraldev\classes;

use fraldev\modeles\_model;

/*

classe Option étendu de la classe _model

    Utilisation :
            
        * Méthodes :

*/

class Option extends _model {

    protected $table = "option";

    protected function define(){
        // création des champs de la class
        $this->addField("type", $type = "TEXT", $libelle = "Type");
        $this->addField("nom", $type = "TEXT", $libelle = "Nom");
        $this->addField("prix", $type = "NUMBER", $libelle = "Prix");
    }

}
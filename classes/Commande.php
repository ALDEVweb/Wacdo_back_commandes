<?php

namespace fraldev\classes;

use fraldev\modeles\_model;

/*

classe Commande étendu de la classe _model

    Utilisation :
            
        * Méthodes :

*/

class Commande extends _model {

    protected $table = "commande";

    protected function define(){
        // création des champs de la class
        $this->addField("consommation", $type = "TEXT", $libelle = "Consommation");
        $this->addField("enregistrement", $type = "NUMBER", $libelle = "Enregistrement");
        $this->addField("date", $type = "DATETIME", $libelle = "Date");
        $this->addField("etat", $type = "TEXT", $libelle = "Etat");
    }

    function enregistrementCde($enregistrement){
        // fonction d'enregistrement d'une commande reçu depuis l'application front (numero d'enregistrement, date, etat=ENR)
        // parametre : $enregistrement = le numéro saisi par le client lors du paiement
        // retour : aucun

        // on charge la commande avec le numéro d'enregistrement
        $this->enregistrement = $enregistrement;
        // on charge la commande avec la date
        $this->date = date('Y-m-d H:i:s');
        // on charge l'état de la commande à ENR
        $this->etat = "ENR";
                
        // on met à jour la commande
        $this->update();

    }

    function listNonLivre(){
        // fonction de listage des commande non livré
        // parametre : aucun
        // retour : $tab, la liste des cde non livré sous forme de tableau

        // construction
        $sql = "SELECT id, " . $this->makeFields() . " FROM `$this->table` WHERE `etat` != 'LIV' ORDER BY `date` ASC";
        //$param = [':etat' => 'LIV'];

        // préparation/execution
        $req = $this->runSql($sql);

        // récupération/retour
        return $this->recoverReqMulti($req);
    }

}
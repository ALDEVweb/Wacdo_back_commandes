<?php

namespace fraldev\classes;

use fraldev\modeles\_user;

/*

classe utilisateur étendu de la classe _user

    Utilisation :

        * Parametrage : à définir 
            const LOGIN = "" - champ utilisé pour stocker l'identifiant
            const PWD = "" - champ utilisé pour stockerle mot de passe
            protected $table = "utilisateur" - table correspondante dans la bdd (à modifier si nécessaire)
            protected function define() - fonction de definition des champs de la table
            
        * Méthodes :

*/

class Utilisateur extends _user {

    const LOGIN = "mail";
    const PWD = "mdp";

    protected $table = "utilisateur";

    protected function define(){
        // création des champs de la class
        $this->addField("nom", $type = "TEXT", $libelle = "Nom");
        $this->addField("prenom", $type = "TEXT", $libelle = "Prénom");
        $this->addField("mail", $type = "EMAIL", $libelle = "Mail");
        $this->addField("mdp", $type = "PASSWORD", $libelle = "Mot de passe");
        $this->addField("statut", $type = "TEXT", $libelle = "Statut");
        $this->addField("token", $type = "TEXT", $libelle = "Token");
    }

    function recapUtilisateur($utilisateur){
        // création d'une ligne récapitulative d'un utilisateur à insérer dans une liste
        // param : l'utilisateur à insérer
        // return : html de la ligne récapitulative

        // on récupère l'id de l'utilisateur
        $id = $utilisateur->id;
        // on récupère le nom de l'utilisateur
        $nom = strtoupper(htmlentities($utilisateur->nom));
        // on récupère le prénom de l'utilisateur
        $prenom = ucfirst(strtolower(htmlentities($utilisateur->prenom)));
        // on récupère le statut de l'utilisateur
        $statut = htmlentities($utilisateur->statut);

        // on construit et retourne le html
        return "<li class='large-12'><a class='flex large-12 j-center' href='index.php?controleur=afficher_modif_utilisateur&idUtilisateur=$id'><p class='large-8 txt-center'>$nom $prenom</p><p class='large-4 txt-center'>$statut</p></a></li>";
    }
}
?>


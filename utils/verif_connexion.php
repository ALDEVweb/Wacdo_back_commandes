<?php

namespace fraldev\utils;

/*

Code à inclure dans les controleurs qui ont besoin de la connexion

*/
$erreur = isset($_GET['erreur']) ? $_GET['erreur'] : null;
// Si on n'est pas connexté, on redirige vers la page de connexion, sinon on récupère l'id de l'utilisateur connecté
if ( ! session_isconnected()) {
    $page = "connexion";
    include "utils/appel_pages.php";
}else {
    $idUtilisateurConnecte = session_idconnected();
}
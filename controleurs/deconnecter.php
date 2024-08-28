<?php

// Contrôleur : Deconnecte l'utilisateur
// Parametres : aucun

// initialisation

use function fraldev\utils\session_deconnect;

include "utils/init.php";

// récupération

// traitement
session_deconnect();

// affichage
header('Location: index.php');
exit;
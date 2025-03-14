<?php

// utilitaire de configuration pour les controleurs API

// Liste des origines autorisées
$origineAutorise = [
    "https://wacdo.aldev-web.fr",
    "https://www.wacdo.aldev-web.fr",
];

// on vérifie si la requete fait partit des origine autorisé
if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $origineAutorise)) {
    header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
}

header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
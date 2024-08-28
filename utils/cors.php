<?php

// utilitaire de configuration pour les controleurs API

// Liste des origines autorisées
$origineAutorise = [
    "http://exam-front.alaugier.mywebecom.ovh",
    "https://aldevweb.github.io/Wacdo_front/",
    "http://127.0.0.1:5500"
];

// on vérifie si la requete fait partit des origine autorisé
if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $origineAutorise)) {
    header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
}

header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
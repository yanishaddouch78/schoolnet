<?php
    // Connexion à la base de données
    $mysqli = new mysqli("localhost", "adminbdd", "bddconnect", "ecolebdd");

    // Vérification de la connexion
    if ($mysqli->connect_error) {
        die("Erreur de connexion : " . $mysqli->connect_error);
    }

    // Définir l'encodage UTF-8
    $mysqli->set_charset("utf8");
?>
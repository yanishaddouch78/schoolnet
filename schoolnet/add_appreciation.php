<?php
require('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_eleve = intval($_POST['id_eleve']);
    $commentaire = $mysqli->real_escape_string($_POST['commentaire']);
    $id_matiere = $mysqli->real_escape_string($_POST['id_matiere']);

    $sql = "INSERT INTO appreciations (id_eleve, commentaire, id_matiere) VALUES ($id_eleve, '$commentaire', $id_matiere)";
    if ($mysqli->query($sql)) {
        // Redirection vers la page de la classe après l'ajout
        header("Location: page_eleve.php?id_eleve=$id_eleve&success=1");
        exit;
    } else {
        echo "Erreur : " . $mysqli->error;
    }
} else {
    echo "Méthode non autorisée.";
}
?>
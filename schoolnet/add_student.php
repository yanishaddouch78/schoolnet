<?php
require('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_classe = intval($_POST['id_classe']);
    $prenom = $mysqli->real_escape_string($_POST['prenom']);
    $nom = $mysqli->real_escape_string($_POST['nom']);
    $sexe = $mysqli->real_escape_string($_POST['sexe']);

    $sql = "INSERT INTO eleves (Prénom, Nom, Sexe, id_classe) VALUES ('$prenom', '$nom', '$sexe', $id_classe)";
    if ($mysqli->query($sql)) {
        // Redirection vers la page de la classe après l'ajout
        header("Location: page_classe.php?id_classe=$id_classe&success=1");
    } else {
        echo "Erreur : " . $mysqli->error;
    }
} else {
    echo "Méthode non autorisée.";
}
?>

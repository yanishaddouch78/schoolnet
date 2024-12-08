<?php
require('config.php');

if (isset($_GET['id_appreciation']) && isset($_GET['id_eleve']) ) {
    $id_appreciation = intval($_GET['id_appreciation']);
    $id_eleve = intval($_GET['id_eleve']);
    // Requête pour supprimer la note
    $sql = "DELETE FROM appreciations WHERE id_appreciation = $id_appreciation";
    
    if ($mysqli->query($sql)) {
        header("Location: page_eleve.php?id_eleve=$id_eleve&success=1");
        exit;
    } else {
        die("Erreur lors de la suppression : " . $mysqli->error);
    }
} else {
    die("ID de l'appreciation manquante.");
}
?>

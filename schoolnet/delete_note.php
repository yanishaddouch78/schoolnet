<?php
require('config.php');

if (isset($_GET['id_note']) && isset($_GET['id_eleve']) ) {
    $id_note = intval($_GET['id_note']);
    $id_eleve = intval($_GET['id_eleve']);
    // Requête pour supprimer la note
    $sql = "DELETE FROM notes WHERE id_note = $id_note";
    
    if ($mysqli->query($sql)) {
        header("Location: page_eleve.php?id_eleve=$id_eleve&success=1");
        exit;
    } else {
        die("Erreur lors de la suppression : " . $mysqli->error);
    }
} else {
    die("ID de la note manquant.");
}
?>

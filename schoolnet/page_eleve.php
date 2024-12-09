<?php
require('config.php');

// Vérifiez si l'ID de l'élève est fourni et valide
if (!isset($_GET['id_eleve']) || intval($_GET['id_eleve']) <= 0) {
    die("ID de l'élève invalide ou non fourni.");
}

$id_eleve = intval($_GET['id_eleve']);

// Requête SQL pour récupérer les informations de l'élève
$sql = "SELECT 
    eleves.id_classe, 
    CONCAT(eleves.Prénom, ' ', eleves.Nom) AS eleve_nom_prenom, 
    eleves.Sexe, 
    classes.niveau, 
    eleves.id_eleve
FROM 
    eleves
JOIN 
    classes 
ON 
    eleves.id_classe = classes.id_classe
WHERE 
    eleves.id_eleve = $id_eleve
";
$result = $mysqli->query($sql);

// Vérifiez si la requête a été exécutée correctement
if (!$result) {
    die("Erreur SQL : " . $mysqli->error);
}

// Vérifiez si un résultat a été trouvé
if ($result->num_rows === 0) {
    die("Aucun élève trouvé avec l'ID $id_eleve.");
}

// Récupérez les informations de l'élève
$eleve = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=delete" />
    <link href="style.css" rel="stylesheet">
    <title>Détails de l'élève</title>
</head>
<body>
    <div class="dashboard-container">
        <h1>Détails de l'élève</h1>
        <p><strong>Nom et prénom :</strong> <?php echo htmlspecialchars($eleve['eleve_nom_prenom']); ?></p>
        <p><strong>Sexe :</strong> <?php echo htmlspecialchars($eleve['Sexe']); ?></p>
        <p><strong>Classe :</strong> <?php echo htmlspecialchars($eleve['niveau']); ?></p>
        <h2 style="padding-top: 50px; padding-bottom: 20px;">Notes de l'élève :</h2> 
        
        <!-- Fenêtre modale pour ajouter une note -->
        <div class="modal fade" id="addGradeModal" tabindex="-1" aria-labelledby="addGradeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addGradeModalLabel">Ajouter une note</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="add_grade.php">
                        <div class="modal-body">
                            <input type="hidden" name="id_eleve" value="<?php echo $id_eleve; ?>">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Note</label>
                                <input type="text" class="form-control" id="valeur" name="valeur" min="0" max="20" required>
                            </div>
                            <div class="mb-3">
                                <label for="matiere" class="form-label">Matière</label>
                                <select class="form-control" id="matiere" name="id_matiere" required>
                                <?php
                                $sql ="SELECT id_matiere, Nom FROM matiere";
                                $result = $mysqli->query($sql);
                                
                                while($row = $result -> fetch_assoc()){
                                    echo "<option value='".htmlspecialchars($row['id_matiere'])."'>".htmlspecialchars($row['Nom'])."</option>";
                                }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Fenêtre modale pour ajouter une appréciation -->
        <div class="modal fade" id="addAppreciationModal" tabindex="-1" aria-labelledby="addAppreciationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAppreciationModalLabel">Ajouter une note</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="add_appreciation.php">
                        <div class="modal-body">
                            <input type="hidden" name="id_eleve" value="<?php echo $id_eleve; ?>">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Commentaire</label>
                                <input type="textarea" class="form-control" id="commentaire" name="commentaire"required>
                            </div>
                            <div class="mb-3">
                                <label for="matiere" class="form-label">Matière</label>
                                <select class="form-control" id="matiere" name="id_matiere" required>
                                <?php
                                $sql ="SELECT id_matiere, Nom FROM matiere";
                                $result = $mysqli->query($sql);
                                
                                while($row = $result -> fetch_assoc()){
                                    echo "<option value='".htmlspecialchars($row['id_matiere'])."'>".htmlspecialchars($row['Nom'])."</option>";
                                }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div style="padding-top: 20px; padding-bottom: 20px;">
            <?php 
                $sql = "SELECT matiere.Nom, notes.valeur, notes.id_note, eleves.id_eleve FROM matiere 
                        JOIN notes ON notes.id_matiere = matiere.id_matiere 
                        JOIN eleves ON eleves.id_eleve = notes.id_eleve 
                        WHERE eleves.id_eleve = $id_eleve;";
                $result = $mysqli->query($sql);

                // Vérifiez si la requête a été exécutée correctement
                if (!$result) {
                    die("Erreur SQL : " . $mysqli->error);
                }

                if ($result && $result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr>
                            <th>Matière</th>
                            <th>Note</th>
                            <th>Action</th>
                        </tr>";

                    // Affichage des résultats dans un tableau HTML
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['Nom']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['valeur']) . " /20</td>";
                        echo "<td class='action-column'>"; // Nouvelle colonne
                        echo "<a href='delete_note.php?id_eleve=".htmlspecialchars($row['id_eleve'])."&id_note=" . htmlspecialchars($row['id_note']) . "' class='delete-icon' title='Supprimer'>";
                        echo "<span class='material-symbols-outlined'>delete</span>"; 
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "Aucune note pour le moment";
                }
            ?>
            
        </div>
        <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#addGradeModal'>Ajouter une note</button>
        <h2 style="padding-top: 50px; padding-bottom: 20px;">Appréciations de l'élève :</h2>

        <div style="padding-top: 20px; padding-bottom: 20px;">
            <?php 
                $sql = "SELECT appreciations.id_appreciation, appreciations.commentaire, eleves.id_eleve, matiere.id_matiere, matiere.Nom 
                FROM appreciations 
                JOIN eleves ON eleves.id_eleve = appreciations.id_eleve 
                JOIN matiere ON matiere.id_matiere = appreciations.id_matiere 
                WHERE eleves.id_eleve = $id_eleve";
                $result = $mysqli->query($sql);

                // Vérifiez si la requête a été exécutée correctement
                if (!$result) {
                    die("Erreur SQL : " . $mysqli->error);
                }

                if ($result && $result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr>
                            <th>Matière</th>
                            <th>Appréciation</th>
                            <th>Action</th>
                        </tr>";

                    // Affichage des résultats dans un tableau HTML
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['Nom']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['commentaire']) . "</td>";
                        echo "<td class='action-column'>"; // Nouvelle colonne
                        echo "<a href='delete_appreciation.php?id_eleve=".htmlspecialchars($row['id_eleve'])."&id_appreciation=" . htmlspecialchars($row['id_appreciation']) . "' class='delete-icon' title='Supprimer'>";
                        echo "<span class='material-symbols-outlined'>delete</span>"; 
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "Aucune appréciation pour le moment";
                }
            ?>
            
        </div>
        <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#addAppreciationModal'>Ajouter une appréciation</button>
        <script>
        setTimeout(function() {
            var message = document.getElementById('successMessage');
            if (message) {
                message.style.display = 'none';
            }
        }, 500); 
        </script>

        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div id="successMessage" class="alert alert-success">Information ajoutée avec succès !</div>
        <?php endif; ?>



    </div>
</body>
</html>

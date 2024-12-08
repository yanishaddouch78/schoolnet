<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit("Vous devez être connecté pour accéder à cette page.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="style.css" rel="stylesheet">
    
</head>
    <body>
        <div class="dashboard-container">
            <?php

            require('config.php');

            if (isset($_GET['id_classe'])) {
                $id_classe = intval($_GET['id_classe']);

                // Récupérer les informations de la classe
                $sql = "SELECT * FROM classes WHERE id_classe = $id_classe";
                $result = $mysqli->query($sql);

                if ($result && $result->num_rows > 0) {
                    $classe = $result->fetch_assoc();
                    echo "<title>Classe de ". htmlspecialchars($classe['niveau'])." </title>";
                    echo "<h3>Détails de la classe : " . htmlspecialchars($classe['niveau']) . "</h3>";

                    // Récupérer les élèves de la classe
                    $sql = "SELECT CONCAT(eleves.Prénom, ' ', eleves.Nom) AS eleve_nom_prenom, eleves.Sexe 
                            FROM eleves 
                            WHERE eleves.id_classe = $id_classe";
                    $result = $mysqli->query($sql);

                    // Vérification des résultats
                    if ($result && $result->num_rows > 0) {
                        echo "<table>";
                        echo "<tr>
                                <th>Nom et Prénom de l'élève</th>
                                <th>Sexe</th>
                            </tr>";

                        // Affichage des résultats dans un tableau HTML
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['eleve_nom_prenom']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Sexe']) . "</td>";
                            echo "</tr>";
                        }

                        echo "</table>";
                    } else {
                        echo "Aucun élève trouvé pour cette classe.";
                    }
                } else {
                    echo "Classe introuvable.";
                }
            } else {
                echo "Aucun identifiant de classe fourni.";
            }

            ?>

            <!-- Bouton pour ouvrir la fenêtre modale -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                Ajouter un élève
            </button>

            <!-- Fenêtre modale pour ajouter un élève -->
            <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addStudentModalLabel">Ajouter un élève</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="add_student.php">
                            <div class="modal-body">
                                <input type="hidden" name="id_classe" value="<?php echo $id_classe; ?>">
                                <div class="mb-3">
                                    <label for="prenom" class="form-label">Prénom</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom" required>
                                </div>
                                <div class="mb-3">
                                    <label for="sexe" class="form-label">Sexe</label>
                                    <select class="form-control" id="sexe" name="sexe" required>
                                        <option value="M">Masculin</option>
                                        <option value="F">Féminin</option>
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
            
            <script>
                setTimeout(function() {
                    var message = document.getElementById('successMessage');
                    if (message) {
                        message.style.display = 'none';
                    }
                }, 500); 
            </script>

            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                <div class="alert alert-success">Élève ajouté avec succès !</div>
            <?php endif; ?>




        </div>
    </body>

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
    <link href="style.css" rel="stylesheet">
    <title>Tableau de bord</title>
</head>
<body>

<div class="dashboard-container">
    <h2>Bienvenue sur votre tableau de bord</h2>
        <div class="table_info">
            <h3>Les matières</h3>
                <?php 
                    require('config.php');
                    // Requête SQL pour récupérer les matières et les professeurs (concaténation du nom et prénom)
                    $sql = "
                    SELECT 
                        matiere.id_matiere, 
                        matiere.Nom AS matiere_nom, 
                        CONCAT(profs.Prénom, ' ', profs.Nom) AS prof_nom_prenom 
                    FROM matiere
                    JOIN profs ON matiere.id_prof = profs.id_prof
                    ";
                    $result = $mysqli->query($sql);

                    // Vérification des résultats
                    if ($result && $result->num_rows > 0) {
                        echo "<table>";
                        echo "<tr>
                                <th>Nom de la Matière</th>
                                <th>Professeur</th>
                            </tr>";

                        // Affichage des résultats dans un tableau HTML
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['matiere_nom']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['prof_nom_prenom']) . "</td>";
                            echo "</tr>";
                        }

                        echo "</table>";
                    } else {
                        echo "Aucune matière trouvée.";
                    }

                    // Fermeture de la connexion
                    // $mysqli->close();
                ?>
            <h3>Les classes</h3>
                <?php
                    $sql = "
                    SELECT
                        classes.id_classe,
                        classes.niveau AS niveau_classe,
                        CONCAT(profs.Prénom, ' ', profs.Nom) AS prof_nom_prenom
                    FROM classes
                    JOIN profs ON classes.id_profprincip = profs.id_prof
                    ";

                    $result = $mysqli->query($sql);

                    // Vérification des résultats
                    if ($result && $result->num_rows > 0) {
                        echo "<table>";
                        echo "<tr>";
                        echo "<th>Classes</th>";
                        echo "<th>Professeur Principal</th>";
                        echo "</tr>";

                        // Affichage des résultats dans un tableau HTML
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            // Ajout du lien cliquable pour la classe
                            echo "<td><a href='page_classe.php?id_classe=" . htmlspecialchars($row['id_classe']) . "'>" 
                                . htmlspecialchars($row['niveau_classe']) . "</a></td>";
                            echo "<td>" . htmlspecialchars($row['prof_nom_prenom']) . "</td>";
                            echo "</tr>";
                        }

                        echo "</table>";
                    } else {
                        echo "Aucune classe trouvée.";
                    }
                ?>
            <h3>Les élèves</h3>

           <a href="student.php" style="text-decoration:none;"> <button type="button"> Voir la liste des élèves</a></button>

        </div>

        <div style="padding-top: 20px;">
            <a href="logout.php">Se déconnecter</a>
        </div>
</div>

</body>
</html>

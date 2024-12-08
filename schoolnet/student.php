<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Liste des élèves</title>
</head>
<body>
    <div class="dashboard-container">
        <h1>Liste des élèves</h1>
        <?php
            require('config.php');

            $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'eleve_nom_prenom';
            $sql = "SELECT eleves.id_classe, CONCAT(eleves.Prénom, ' ', eleves.Nom) AS eleve_nom_prenom, eleves.Sexe, classes.niveau, eleves.id_eleve
                    FROM eleves 
                    JOIN classes WHERE eleves.id_classe = classes.id_classe
                    ORDER BY $sort_by";
            $result = $mysqli->query($sql);

            if ($result && $result->num_rows > 0) {
                echo "<table>";
                echo "<tr>
                        <th><a href='?sort_by=eleve_nom_prenom'>Élève</a></th>
                        <th><a href='?sort_by=Sexe'>Sexe</a></th>
                        <th><a href='?sort_by=niveau'>Classe</a></th>
                    </tr>";
            }

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='page_eleve.php?id_eleve=" . htmlspecialchars($row['id_eleve']) . "'>" 
                                . htmlspecialchars($row['eleve_nom_prenom']) . "</a></td>";
                echo "<td>" . htmlspecialchars($row['Sexe']) . "</td>";
                echo "<td>" . htmlspecialchars($row['niveau']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";

        ?>
    </div>
</body>
</html>

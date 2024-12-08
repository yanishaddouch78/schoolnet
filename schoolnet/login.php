<?php
session_start();

// Si le bouton "Connexion" est cliqué
if (isset($_POST['connexion'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        echo "Veuillez remplir tous les champs.";
    } else {
      require('config.php');

        $sql = "SELECT * FROM admin WHERE username = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $_POST['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Debug : vérifier les résultats
        echo "Requête exécutée, résultat : ";
        var_dump($user);

        // Vérification du mot de passe brut
        if ($user && $_POST['password'] === $user['password']) {
            $_SESSION['username'] = $user['username'];
            echo "Vous êtes connecté !";
            header('Location: dashboard.php');
            exit;
        } else {
            echo "Le pseudo ou le mot de passe est incorrect.";
        }

        $stmt->close();
        $mysqli->close();
    }
}
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Connexion</title>
</head>
<body>

<div class="login-container">
    <h2>Connexion</h2>

    <?php if (!empty($message)): ?>
        <p style="color:red" class="txt_error"><?= $message ?></p>
    <?php endif; ?>

    <form action="login.php" method="post">
        <div>
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username">
        </div>

        <div>
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password">
        </div>

        <div>
            <input type="submit" name="connexion" value="Se connecter">
        </div>
    </form>
</div>

</body>
</html>
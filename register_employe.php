<?php
session_start();
include "db.php";

$msg = '';
if (isset($_POST["btn_register"])) {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];
    $sql_check = "SELECT * FROM employes WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        $msg = "Cet email est déjà utilisé.";
    } else {
        $sql = "INSERT INTO employes (nom, email, mot_de_passe) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nom, $email, $mdp);
        if ($stmt->execute()) {
            $_SESSION["employe"] = $email;
            header("Location: compte_employe.php");
            exit();
        } else {
            $msg = "Erreur lors de la création du compte.";
        }
        $stmt->close();
    }

    $stmt_check->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un compte Employé</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('emp.jpg');
            background-size: cover;
            font-family: Arial;
        }
        .overlay {
            background: rgba(0, 0, 0, 0.5);
            position: fixed;
            width: 100%;
            height: 100%;
        }
        .container {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .box {
            background-color: rgba(255,255,255,0.1);
            padding: 30px;
            border-radius: 10px;
            width: 300px;
        }
        h2, label {
            color: white;
        }
        input, button {
            width: 100%;
            padding: 8px;
            margin-top: 10px;
            border-radius: 5px;
            border: none;
        }
        button {
            background-color:rgb(255, 7, 226);
            color: white;
        }
        .alert {
            background-color: #dc3545;
            color: white;
            padding: 8px;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="container">
        <div class="box">
            <?php if ($msg): ?>
                <div class="alert"><?= $msg ?></div>
            <?php endif; ?>
            <h2>Créer un compte</h2>
            <form method="post">
                <label>Nom :</label>
                <input type="text" name="nom" required>
                <label>Email :</label>
                <input type="email" name="email" required>
                <label>Mot de passe :</label>
                <input type="password" name="mdp" required>
                <button type="submit" name="btn_register">S'inscrire</button>
            </form>
        </div>
    </div>
</body>
</html>

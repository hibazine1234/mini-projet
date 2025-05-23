<?php
session_start();
include "db.php";

$msg = '';

if (isset($_POST["btn_login_employe"])) {
    $email = trim($_POST["email"]);
    $mdp = trim($_POST["mdp"]);

    $sql = "SELECT * FROM employes WHERE email = ? AND mot_de_passe = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $mdp);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION["employe"] = $email;
        header("Location: compte_employe.php");
        exit();
    } else {
        $msg = "Email ou mot de passe incorrect.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Employé</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('emp.jpg');
            background-size: cover;
            font-family: Arial, sans-serif;
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
            background-color: rgba(255, 255, 255, 0.1);
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
            background-color: #28a745;
            color: white;
            cursor: pointer;
        }
        .alert {
            background-color: #dc3545;
            color: white;
            padding: 8px;
            text-align: center;
            margin-bottom: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="container">
        <div class="box">
            <?php if ($msg): ?>
                <div class="alert"><?= htmlspecialchars($msg) ?></div>
            <?php endif; ?>
            <h2>Connexion Employé</h2>
            <form method="post" action="">
                <label>Email :</label>
                <input type="email" name="email" required autocomplete="off">
                <label>Mot de passe :</label>
                <input type="password" name="mdp" required autocomplete="off">
                <button type="submit" name="btn_login_employe">Connexion</button>
            </form>
            <p style="text-align:center; margin-top:10px; color:#FFFFFF;">
                Pas de compte ? <a href="register_employe.php" style="color:#FFFFFF; text-decoration:underline;">Créer un compte</a>
            </p>
        </div>
    </div>
</body>
</html>

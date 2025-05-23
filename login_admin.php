<?php
session_start();
include "db.php";

$msg = '';
if (isset($_POST["btn_login_admin"])) {
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];
    $sql = "SELECT * FROM admins WHERE email = ? AND mot_de_passe = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $mdp);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $_SESSION["admin"] = $email; 
        header("Location: liste.php");
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
    <title>Connexion Admin</title>
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
            background-color: #007bff;
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
            <h2>Admin Login</h2>
            <form method="post">
                <label>Email :</label>
                <input type="email" name="email" required>
                <label>Mot de passe :</label>
                <input type="password" name="mdp" required>
                <button type="submit" name="btn_login_admin">Connexion</button>
            </form>
        </div>
    </div>
</body>
</html>

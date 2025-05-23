<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Employé</title>
    <style>
        body {
            background-color: #f3f4f6;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #1D4ED8;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
        }

        h1 {
            font-size: 2rem;
            font-weight: bold;
        }

        button {
            background-color: #3B82F6;
            color: white;
            padding: 10px 24px;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #2563EB;
        }

        .message {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            margin-left: 40px;
            margin-right: 40px;
        }

        .message.success {
            background-color: #D1FAE5;
            color: #16A34A;
            border: 1px solid #34D399;
        }

        .message.error {
            background-color: #FEE2E2;
            color: #EF4444;
            border: 1px solid #F87171;
        }

        .form-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container label {
            font-size: 1.1rem;
            color: #374151;
        }

        .form-container input {
            margin-top: 10px;
            padding: 10px;
            width: 100%;
            border: 1px solid #D1D5DB;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-container input:focus {
            outline: none;
            border-color: #3B82F6;
        }

        .form-container button {
            background-color: #10B981;
            color: white;
            padding: 12px 24px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1rem;
            margin-top: 20px;
        }

        .form-container button:hover {
            background-color: #16A34A;
        }
    </style>
</head>
<body>

<header>
    <h1>Ajouter un Employé</h1>
    <a href="liste.php">
        <button>Voir la Liste</button>
    </a>
</header>

<?php
include 'db.php';

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $age = (int)$_POST['age'];
    $position = htmlspecialchars($_POST['position']);
    $salary = (float)$_POST['salary'];

    $stmt = $conn->prepare("INSERT INTO employees (name, age, position, salary) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sisd", $name, $age, $position, $salary);

    if ($stmt->execute()) {
        echo "<div class='message success'>Employé ajouté avec succès.</div>";
    } else {
        echo "<div class='message error'>Erreur : " . $stmt->error . "</div>";
    }

    $stmt->close();
}

$conn->close();
?>

<div class="form-container">
    <form method="POST">
        <div class="mb-4">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="mb-4">
            <label for="age">Âge</label>
            <input type="number" id="age" name="age" required>
        </div>

        <div class="mb-4">
            <label for="position">Poste</label>
            <input type="text" id="position" name="position" required>
        </div>

        <div class="mb-6">
            <label for="salary">Salaire</label>
            <input type="number" id="salary" name="salary" required>
        </div>

        <button type="submit">Ajouter</button>
    </form>
</div>

</body>
</html>

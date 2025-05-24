<?php
include 'db.php';
$message = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM employees WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
    } else {
        echo "Employé introuvable";
        exit();
    }
} else {
    echo "Aucun ID spécifié.";
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $sql = "UPDATE employees SET name = ?, age = ?, position = ?, salary = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisis", $name, $age, $position, $salary, $id);
    if ($stmt->execute()) {
        $message = "Informations mises à jour avec succès.";
        header("Location: liste.php");
        exit();
    } else {
        $message = "Erreur: " . $stmt->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mettre à jour l'employé</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #007BFF;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .container {
            max-width: 600px;
            background-color: white;
            margin: 30px auto;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            margin-top: 20px;
            padding: 12px;
            width: 100%;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            padding: 10px;
            margin: 20px auto;
            width: 90%;
            text-align: center;
            border-radius: 5px;
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
        }
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .retour {
            text-decoration: none;
            color: white;
            background-color: #0056b3;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .retour:hover {
            background-color: #003d80;
        }
    </style>
</head>
<body>
<header>
    <h1>Mettre à jour l'employé</h1>
    <a href="liste.php" class="retour">Retourner à la liste</a>
</header>

<?php if ($message): ?>
    <div class="message <?php echo ($message == "Informations mises à jour avec succès.") ? 'success' : 'error'; ?>">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<div class="container">
    <form method="POST">

        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" value="<?php echo $employee['name']; ?>" required>

        <label for="age">Âge :</label>
        <input type="number" id="age" name="age" value="<?php echo $employee['age']; ?>" required>

        <label for="position">Poste :</label>
        <input type="text" id="position" name="position" value="<?php echo $employee['position']; ?>" required>

        <label for="salary">Salaire :</label>
        <input type="number" id="salary" name="salary" value="<?php echo $employee['salary']; ?>" required>

        <button type="submit">Mettre à jour</button>
    </form>
</div>

</body>
</html>

<?php $conn->close(); ?>

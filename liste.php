<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

include 'db.php';

// Récupérer tous les employés
$sql = "SELECT * FROM employees";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Employés</title>
</head>
<body>

<header style="background-color: #1D4ED8; color: white; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center;">
    <h1 style="font-size: 20px; font-weight: bold;">Gestion des Employés</h1>
    <a href="logout.php" style="background-color: white; color: #1D4ED8; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Déconnexion</a>
</header>

<div style="padding: 20px;">
    <h2 style="font-size: 24px; font-weight: 600; margin-bottom: 15px;">Liste des employés</h2>
    <table style="width: 100%; background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 8px; overflow: hidden;">
        <thead>
            <tr style="background-color: #1D4ED8; color: white;">
                <th style="padding: 15px; text-align: left;">ID</th>
                <th style="padding: 15px; text-align: left;">Nom</th>
                <th style="padding: 15px; text-align: left;">Âge</th>
                <th style="padding: 15px; text-align: left;">Poste</th>
                <th style="padding: 15px; text-align: left;">Salaire</th>
                <th style="padding: 15px; text-align: left;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr style='border-bottom: 1px solid #ddd;'>
                            <td style='padding: 15px;'>" . $row['id'] . "</td>
                            <td style='padding: 15px;'>" . $row['name'] . "</td>
                            <td style='padding: 15px;'>" . $row['age'] . "</td>
                            <td style='padding: 15px;'>" . $row['position'] . "</td>
                            <td style='padding: 15px;'>" . $row['salary']." DH" . "</td>
                            <td style='padding: 15px;'>
                               <a href='updateEmployee.php?id=" . $row['id'] . "' style='background-color: #10B981; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;'>Modifier</a>
                               <a href='deleteEmployee.php?id=" . $row['id'] . "' style='background-color: #EF4444; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;'>Supprimer</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6' style='padding: 15px; text-align: center;'>Aucun employé trouvé</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div style="margin-top: 20px;">
        <a href="addEmployee.php" style="background-color: #3B82F6; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Ajouter un employé</a>
    </div>
</div>

</body>
</html>

<?php $conn->close(); ?>

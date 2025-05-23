<?php
session_start();

// Vérification si l'employé est connecté
if (!isset($_SESSION['employe'])) {
    header("Location: login_employe.php");
    exit();
}

// Exemple d'emploi de temps (cela peut être remplacé par des données dynamiques)
$emploi_temps = [
    'titre' => 'Emploi de Temps de la Semaine',
    'description' => 'Horaire de travail de la semaine pour l\'employé.',
    'jours' => [
        ['jour' => 'Lundi', 'debut' => '09:00', 'fin' => '17:00'],
        ['jour' => 'Mardi', 'debut' => '09:00', 'fin' => '17:00'],
        ['jour' => 'Mercredi', 'debut' => '09:00', 'fin' => '17:00'],
        ['jour' => 'Jeudi', 'debut' => '09:00', 'fin' => '17:00'],
        ['jour' => 'Vendredi', 'debut' => '09:00', 'fin' => '17:00'],
    ]
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Emploi de Temps</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="bg-blue-800 text-white p-4 flex justify-between items-center">
        <div>
            Bienvenue, Employé
        </div>
        <div>
            <form method="post" action="logout_employe.php">
                <button class="bg-red-500 px-4 py-2 rounded text-white" type="submit">Déconnexion</button>
            </form>
        </div>
    </div>

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Emploi de Temps</h1>

        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-4">Emploi de Temps : <?php echo htmlspecialchars($emploi_temps['titre']); ?></h2>
            
            <!-- Tableau pour afficher l'emploi de temps -->
            <table class="min-w-full bg-white border border-gray-200 shadow-lg rounded-lg">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border-b text-left">Jour</th>
                        <th class="px-4 py-2 border-b text-left">Heure de Début</th>
                        <th class="px-4 py-2 border-b text-left">Heure de Fin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($emploi_temps['jours'] as $jour): ?>
                        <tr>
                            <td class="px-4 py-2 border-b"><?php echo htmlspecialchars($jour['jour']); ?></td>
                            <td class="px-4 py-2 border-b"><?php echo htmlspecialchars($jour['debut']); ?></td>
                            <td class="px-4 py-2 border-b"><?php echo htmlspecialchars($jour['fin']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>

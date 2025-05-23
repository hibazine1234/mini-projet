<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portail de Connexion</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background-image: url('emp.jpg');
            background-size: cover;
            background-position: center;
            color: #fff;
        }
        .overlay {
            background-color: rgba(0, 0, 0, 0.6);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
        }

        .box {
            background-color: rgba(0, 0, 0, 0.75);
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            width: 350px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        p {
            font-size: 18px;
            margin-bottom: 30px;
            line-height: 1.6;
            color: #ddd;
        }

        .button {
            display: block;
            padding: 14px;
            margin: 15px 0;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.2s ease;
            font-size: 16px;
        }

        .button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .employe {
            background-color: #28a745;
        }

        .employe:hover {
            background-color: #1e7e34;
        }

        .footer {
            position: fixed;
            bottom: 10px;
            width: 100%;
            text-align: center;
            color: #fff;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="container">
        <div class="box">
            <h1>Bienvenue sur le Portail</h1>
            <p>Nous sommes ravis de vous accueillir. Veuillez choisir votre rôle pour accéder à votre espace personnel.</p>
            <a href="login_admin.php" class="button"> Admin</a>
            <a href="login_employe.php" class="button employe">Employé</a>
        </div>
    </div>
    <div class="footer">
        <p>&copy; 2025 Employee Management. Tous droits réservés.</p>
    </div>
</body>
</html>

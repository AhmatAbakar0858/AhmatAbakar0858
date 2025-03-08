<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dawn & ASRS E-commerce</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: #333;
        }

        header {
            background-color: #ffffff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 1rem;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2c3e50;
            text-decoration: none;
        }

        .nav-links a {
            margin-left: 2rem;
            color: #7f8c8d;
            text-decoration: none;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #3498db;
        }

        main {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .card h2 {
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .card p {
            color: #7f8c8d;
            line-height: 1.6;
        }

        .price {
            color: #e74c3c;
            font-weight: bold;
            font-size: 1.2rem;
        }

        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }

        form {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        form input, form select {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #bdc3c7;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        table th, table td {
            padding: 0.8rem;
            text-align: left;
            border-bottom: 1px solid #ecf0f1;
        }

        table th {
            background-color: #f8f9fa;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .card {
                margin-bottom: 1.5rem;
            }

            form {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="index.php" class="logo">Dawn & ASRS</a>
            <div class="nav-links">
                <a href="index.php">Accueil</a>
                <a href="catalogue.php">Catalogue</a>
                <a href="panier.php">Panier</a>
                <a href="commande.php">Commande</a>
                <?php if (!isset($_SESSION['user_id'])) : ?>
                    <a href="connexion.php">Connexion</a>
                    <a href="inscription.php">Inscription</a>
                <?php else : ?>
                    <span>Bienvenue, <?php echo htmlspecialchars($_SESSION['user_name']) . ' ' . htmlspecialchars($_SESSION['user_prenom']); ?></span>
                    <a href="deconnexion.php">Déconnexion</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
</body>
</html>

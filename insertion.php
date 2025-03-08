<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Vérification des champs
    if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
        header('Location: inscription.php?error=empty_fields');
        exit();
    }

    // Vérification de l'e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: inscription.php?error=invalid_email');
        exit();
    }

    // Vérification de l'unicité de l'e-mail
    $stmt = $pdo->prepare('SELECT id FROM clients WHERE email = ?');
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        header('Location: inscription.php?error=email_exists');
        exit();
    }

    // Hachage du mot de passe
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Insertion de l'utilisateur
    $stmt = $pdo->prepare('INSERT INTO clients (nom, prenom, email, password) VALUES (?, ?, ?, ?)');
    try {
        $stmt->execute([$nom, $prenom, $email, $passwordHash]);
        header('Location: connexion.php?success=1');
        exit();
    } catch (PDOException $e) {
        error_log('Erreur lors de l\'inscription : ' . $e->getMessage());
        header('Location: inscription.php?error=database_error');
        exit();
    }
} else {
    // Redirection si la méthode n'est pas POST
    header('Location: inscription.php');
    exit();
}
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérification des champs
    if (empty($email) || empty($password)) {
        header('Location: connexion.php?error=empty_fields');
        exit();
    }

    // Récupération de l'utilisateur
    $stmt = $pdo->prepare('SELECT * FROM clients WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Vérification du mot de passe
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nom'];
        $_SESSION['user_prenom'] = $user['prenom'];
        header('Location: index.php');
        exit();
    } else {
        header('Location: connexion.php?error=invalid_credentials');
        exit();
    }
} else {
    // Redirection si la méthode n'est pas POST
    header('Location: connexion.php');
    exit();
}
?>

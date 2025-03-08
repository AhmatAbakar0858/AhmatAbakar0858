<?php
session_start();
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Assainir l'entrée

    // Vérifier si l'article existe
    $stmt = $pdo->prepare("SELECT id FROM articles WHERE id = ?");
    $stmt->execute([$id]);
    if ($stmt->fetch()) {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        if (isset($_SESSION['panier'][$id])) {
            $_SESSION['panier'][$id]++;
        } else {
            $_SESSION['panier'][$id] = 1;
        }
    }
}

header('Location: panier.php');
exit();
?>

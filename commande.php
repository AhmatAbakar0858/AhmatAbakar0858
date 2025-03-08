<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php?error=1');
    exit();
}

if (empty($_SESSION['panier'])) {
    header('Location: panier.php?error=1');
    exit();
}

$user_id = $_SESSION['user_id'];
$total = 0;

// Récupérer tous les articles du panier en une seule requête
$ids = array_keys($_SESSION['panier']);
$placeholders = implode(',', array_fill(0, count($ids), '?'));
$stmt = $pdo->prepare("SELECT id, prix FROM articles WHERE id IN ($placeholders)");
$stmt->execute($ids);
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($articles as $article) {
    $quantite = $_SESSION['panier'][$article['id']];
    $total += $article['prix'] * $quantite;
}

$stmt = $pdo->prepare("INSERT INTO commandes (user_id, total) VALUES (?, ?)");
$stmt->execute([$user_id, $total]);

$commande_id = $pdo->lastInsertId();

foreach ($articles as $article) {
    $quantite = $_SESSION['panier'][$article['id']];
    $stmt = $pdo->prepare("INSERT INTO commande_articles (commande_id, article_id, quantite) VALUES (?, ?, ?)");
    $stmt->execute([$commande_id, $article['id'], $quantite]);
}

unset($_SESSION['panier']);
header('Location: confirmation.php?commande_id=' . $commande_id);
exit();
?>

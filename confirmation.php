<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php?error=1');
    exit();
}

if (!isset($_GET['commande_id'])) {
    header('Location: index.php');
    exit();
}

$commande_id = $_GET['commande_id'];
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM commandes WHERE id = ? AND user_id = ?");
$stmt->execute([$commande_id, $user_id]);
$commande = $stmt->fetch();

if (!$commande) {
    header('Location: index.php');
    exit();
}

$stmt = $pdo->prepare("SELECT a.nom, a.prix, ca.quantite FROM commande_articles ca JOIN articles a ON ca.article_id = a.id WHERE ca.commande_id = ?");
$stmt->execute([$commande_id]);
$articles = $stmt->fetchAll();
?>
<?php include 'header.php'; ?>
<main>
    <h1>Confirmation de commande</h1>
    <p>Merci pour votre commande ! Voici les détails :</p>
    <table>
        <tr>
            <th>Article</th>
            <th>Prix unitaire</th>
            <th>Quantité</th>
            <th>Total</th>
        </tr>
        <?php foreach ($articles as $article) : ?>
            <tr>
                <td><?= $article['nom'] ?></td>
                <td><?= $article['prix'] ?>€</td>
                <td><?= $article['quantite'] ?></td>
                <td><?= $article['prix'] * $article['quantite'] ?>€</td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3">Total</td>
            <td><?= $commande['total'] ?>€</td>
        </tr>
    </table>
</main>
<?php include 'footer.php'; ?>

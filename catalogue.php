<?php 
include 'config.php';
include 'header.php'; 
?>
<main>
    <?php
    if (isset($_GET['id'])) {
        $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $article = $stmt->fetch();
        ?>
        <div class="card">
            <img src="<?= $article['photo'] ?>" width="200" alt="<?= $article['nom'] ?>">
            <h2><?= $article['nom'] ?></h2>
            <p class="price"><?= $article['prix'] ?>€</p>
            <p><?= $article['description'] ?></p>
            <form method="GET" action="ajouter_panier.php">
                <input type="hidden" name="id" value="<?= $article['id'] ?>">
                <button type="submit">Ajouter au panier</button>
            </form>
        </div>
        <?php
    } else {
        echo '<p>Article non trouvé</p>';
    }
    ?>
</main>
<?php include 'footer.php'; ?>

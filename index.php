<?php 
include 'config.php'; // Ajout de la configuration de la base de données
include 'header.php'; 
?>
<main>
    <h1>Nos articles</h1>
    <div class="card-grid">
        <?php
        try {
            $req = $pdo->query("SELECT * FROM articles");
            while ($article = $req->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="card">
                        <img src="'.$article['photo'].'" width="100" alt="'.$article['nom'].'">
                        <h2>'.$article['nom'].'</h2>
                        <p class="price">'.$article['prix'].'€</p>
                        <p>'.$article['description'].'</p>
                        <a href="catalogue.php?id='.$article['id'].'" class="btn">Voir détail</a>
                      </div>';
            }
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
        ?>
    </div>
</main>
<?php include 'footer.php'; ?>

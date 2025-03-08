<?php 
include 'config.php';
include 'header.php'; 
?>
<main>
    <h1>Votre panier</h1>
    <?php
    if (empty($_SESSION['panier'])) {
        echo '<p>Votre panier est vide</p>';
    } else {
        // Récupérer tous les articles du panier en une seule requête
        $ids = array_keys($_SESSION['panier']);
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $pdo->prepare("SELECT * FROM articles WHERE id IN ($placeholders)");
        $stmt->execute($ids);
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo '<table>
                <tr>
                    <th>Article</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>';
        $total = 0;
        foreach ($articles as $article) {
            $quantite = $_SESSION['panier'][$article['id']];
            $total += $article['prix'] * $quantite;
            echo "<tr>
                    <td>{$article['nom']}</td>
                    <td>{$article['prix']}€</td>
                    <td>
                        <form method='POST' action=''>
                            <input type='number' name='quantite' value='$quantite' min='1' max='10'>
                            <input type='hidden' name='id' value='{$article['id']}'>
                            <button type='submit'>Modifier</button>
                        </form>
                    </td>
                    <td>".($article['prix'] * $quantite)."€</td>
                    <td>
                        <a href='panier.php?delete={$article['id']}'>Supprimer</a>
                    </td>
                  </tr>";
        }
        echo "<tr>
                <td colspan='3'>Total</td>
                <td>$total €</td>
              </tr>";
        echo '</table>';
        echo '<a href="commande.php" class="btn">Valider commande</a>';
    }
    ?>
</main>
<?php include 'footer.php'; ?>

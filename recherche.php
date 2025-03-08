<?php 
include 'config.php'; // Ajout de la configuration de la base de données
include 'header.php'; 
?>
<main>
    <h1>Recherche d'articles</h1>
    <form method="GET">
        <input type="number" name="min" placeholder="Prix min" required>
        <input type="number" name="max" placeholder="Prix max" required>
        <button type="submit">Rechercher</button>
    </form>
    
    <?php
    if (isset($_GET['min']) && isset($_GET['max'])) {
        $min = intval($_GET['min']);
        $max = intval($_GET['max']);
        
        $stmt = $pdo->prepare("SELECT * FROM articles WHERE prix BETWEEN ? AND ?");
        $stmt->execute([$min, $max]);
        $resultats = $stmt->fetchAll();
        
        if (count($resultats) > 0) {
            echo '<h2>Résultats trouvés :</h2>';
            echo '<table>
                    <tr>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Description</th>
                    </tr>';
            foreach ($resultats as $row) {
                echo "<tr>
                        <td>{$row['nom']}</td>
                        <td>{$row['prix']}€</td>
                        <td>{$row['description']}</td>
                      </tr>";
            }
            echo '</table>';
        } else {
            echo '<p>Aucun article trouvé dans cette plage de prix</p>';
        }
    }
    ?>
</main>
<?php include 'footer.php'; ?>

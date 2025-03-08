<?php include 'header.php'; ?>
<main>
    <h1>Tri par catégorie</h1>
    <form method="GET">
        <select name="type">
            <option value="">Toutes catégories</option>
            <option value="Electronique">Electronique</option>
            <option value="Electroménager">Electroménager</option>
            <option value="Vêtement">Vêtement</option>
            <option value="Jouet">Jouet</option>
        </select>
        <button type="submit">Filtrer</button>
    </form>
    
    <?php
    $type = isset($_GET['type']) ? $_GET['type'] : '';
    $stmt = $pdo->prepare("SELECT * FROM articles". ($type ? " WHERE type = ?" : ""));
    $stmt->execute($type ? [$type] : []);
    $resultats = $stmt->fetchAll();
    
    if (count($resultats) > 0) {
        echo '<h2>Résultats :</h2>';
        echo '<table>
                <tr>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Prix</th>
                    <th>Description</th>
                </tr>';
        foreach ($resultats as $row) {
            echo "<tr>
                    <td>{$row['nom']}</td>
                    <td>{$row['type']}</td>
                    <td>{$row['prix']}€</td>
                    <td>{$row['description']}</td>
                  </tr>";
        }
        echo '</table>';
    } else {
        echo '<p>Aucun article trouvé dans cette catégorie</p>';
    }
    ?>
</main>
<?php include 'footer.php'; ?>
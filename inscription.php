<?php 
include 'config.php'; // Ajout de la configuration de la base de données
include 'header.php'; 
?>
<main>
    <h1>S'inscrire</h1>
    <form method="POST" action="insertion.php">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">S'inscrire</button>
    </form>
    <p>Vous avez déjà un compte ? <a href="connexion.php">Se connecter</a></p>
</main>
<?php include 'footer.php'; ?>

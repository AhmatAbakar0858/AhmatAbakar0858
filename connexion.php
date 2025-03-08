<?php 
include 'config.php'; // Ajout de la configuration de la base de données
include 'header.php'; 
?>
<main>
    <h1>Connexion</h1>
    <?php if (isset($_GET['success'])) : ?>
        <p style="color: green;">Inscription réussie ! Veuillez vous connecter.</p>
    <?php endif; ?>
    <form method="POST" action="traitement.php">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>
    <p>Vous n'avez pas de compte ? <a href="inscription.php">S'inscrire</a></p>
</main>
<?php include 'footer.php'; ?>

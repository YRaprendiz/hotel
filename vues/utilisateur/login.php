<?php include('vues/communs/header.php'); ?>
<?php 
if ($user = $controller->login($_POST['email'], $_POST['password'])) {
    FlashMessage::set('success', 'Connexion réussie. Bienvenue ' . htmlspecialchars($user['nom']) . ' !');
    header('Location: index.php?page=profile');
} else {
    FlashMessage::set('danger', 'Échec de la connexion. Vérifiez vos identifiants.');
    header('Location: index.php?page=login');
}
exit;
?>

<div class="container">
    <h2>Connexion</h2>
    <form action="index.php?page=loginAction" method="POST">
        <div>
            <label>Email :</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Mot de passe :</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Se connecter</button>
    </form>
    <p>Pas encore inscrit ? <a href="index.php?page=register">Créer un compte</a></p>
</div>
<?php include('vues/communs/footer.php'); ?>

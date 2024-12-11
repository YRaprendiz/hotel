<?php include('./vue/communs/header.php'); ?>

<div class="container">
    <h2>Inscription</h2>
    <form action="index.php?page=registerAction" method="POST">
        <div>
            <label>Nom :</label>
            <input type="text" name="nom" required>
        </div>
        <div>
            <label>Prénom :</label>
            <input type="text" name="prenom" required>
        </div>
        <div>
            <label>Email :</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Mot de passe :</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>Adresse :</label>
            <input type="text" name="adresse">
        </div>
        <button type="submit">S'inscrire</button>
    </form>
    <p>Déjà inscrit ? <a href="index.php?page=login">Connectez-vous ici</a></p>
</div>
<?php include('./vue/communs/footer.php'); ?> 
<!--<?php
if ($controller->register($_POST['email'])) {
    FlashMessage::set('success', 'Inscription réussie ! Bienvenue !');
    header('Location: index.php?page=login');
} else {
    FlashMessage::set('danger', 'Échec de l’inscription. Veuillez réessayer.');
    header('Location: index.php?page=register');
}
exit;
?>-->

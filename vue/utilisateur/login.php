<?php include('./vue/communs/header.php'); ?>

<div class="container mt-5">
    <h2>Connexion</h2>

    <!-- Exibir mensagem flash se existir -->
    <?php if (isset($_SESSION['flash'])): ?>
        <div class="alert alert-<?php echo htmlspecialchars($_SESSION['flash']['type']); ?>">
            <?php echo htmlspecialchars($_SESSION['flash']['message']); ?>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <form action="index.php?page=loginAction" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="pass" class="form-label">Mot de passe :</label>
            <input type="pass" id="pass" name="pass" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
    <p class="mt-3">Pas encore inscrit ? <a href="index.php?page=register">Créer un compte</a></p>
</div>

<?php include('./vue/communs/footer.php'); ?>
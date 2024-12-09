<?php include('./communs/header.php') ?>

<?php if (isset($_SESSION['utilisateur'])): ?>
        <p>Bienvenue, <?= htmlspecialchars($_SESSION['utilisateur']['prenom']); ?> </p>
        <?= htmlspecialchars($_SESSION['utilisateur']['nom']);?>
        <?php else: ?>
            <p><a href="?page=profile">profile</a>
        <?php endif; 
?>
<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hôtel Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">
    <!-- fin -->    
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?page=accueil">Accueil</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=listeChambres">Chambres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=contact">Contact</a>
                    </li>
                    <?php if (isset($_SESSION['id_user']) && $_SESSION['id_user']['role'] === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=adminDashboard">Admin Dashboard</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['id_user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=profile">Mon Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=logout">Déconnexion</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=login">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=register">Inscription</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php if (isset($_SESSION['flash'])): ?>
    <div class="alert alert-<?php echo htmlspecialchars($_SESSION['flash']['type']); ?>">
        <?php echo htmlspecialchars($_SESSION['flash']['message']); ?>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>
</header>
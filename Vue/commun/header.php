<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotel Management</title>
    <!-- Ajout de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico">
</head>
<body>

    <!-- Barre de navigation principale -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php?page=accueil">Hotel Management</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=accueil">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=inscription">Inscription</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=login">Connexion</a>
                        </li>
                        
                        <!-- Afficher uniquement si l'utilisateur est connecté -->
                        <?php if (isset($_SESSION['utilisateur'])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?page=chambres">Chambres</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?page=contact">Contact</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Déconnexion</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


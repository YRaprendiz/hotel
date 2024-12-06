<?php
session_start();

// Supprimer toutes les données de session
session_unset();

// Détruire la session
session_destroy();

// Rediriger vers la page d'accueil ou de connexion
header('Location: index.php?page=accueil');
exit;
?>

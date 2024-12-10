<?php include('vues/communs/header.php'); ?>
<?php
if ($userController->editProfile($_SESSION['user']['id'], $_POST)) {
    FlashMessage::set('success', 'Votre profil a été mis à jour avec succès.');
} else {
    FlashMessage::set('danger', 'Erreur lors de la mise à jour du profil.');
}
header('Location: index.php?page=profile');
exit;

?>
<?php if (!isset($_SESSION['user'])): header('Location: index.php?page=login'); exit; endif; ?>
<div class="container">
    <h2>Mon Profil</h2>
    <p>Nom : <?= htmlspecialchars($_SESSION['user']['nom']) ?></p>
    <p>Email : <?= htmlspecialchars($_SESSION['user']['email']) ?></p>
    <p>Adresse : <?= htmlspecialchars($_SESSION['user']['adresse'] ?? 'Non renseignée') ?></p>
</div>
<?php include('vues/communs/footer.php'); ?>

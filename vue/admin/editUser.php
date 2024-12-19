<?php include('./vues/communs/header.php'); ?>
<?php
if ($adminController->deleteUser($_GET['id'])) {
    FlashMessage::set('success', 'Utilisateur supprimé avec succès.');
} else {
    FlashMessage::set('danger', 'Erreur lors de la suppression de l’utilisateur.');
}
header('Location: index.php?page=adminDashboard');
exit;

?>
<div class="container">
    <h1>Modifier un utilisateur</h1>
    <form action="index.php?page=editUserAction&id=<?= $user['id_user'] ?>" method="POST">
        <label>Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>
        <label>Prénom :</label>
        <input type="text" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" required>
        <label>Email :</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
        <label>Rôle :</label>
        <select name="role">
            <option value="1" <?= $user['role'] == '1' ? 'selected' : '' ?>>Client</option>
            <option value="2" <?= $user['role'] == '2' ? 'selected' : '' ?>>Administrateur</option>
        </select>
        <button type="submit">Modifier</button>
    </form>
</div>
<?php include('./vues/communs/footer.php'); ?>

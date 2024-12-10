<?php include('./vues/communs/header.php'); ?>
<div class="container">
    <h1>Ajouter un utilisateur</h1>
    <form action="index.php?page=addUserAction" method="POST">
        <label>Nom :</label>
        <input type="text" name="nom" required>
        <label>Prénom :</label>
        <input type="text" name="prenom" required>
        <label>Email :</label>
        <input type="email" name="email" required>
        <label>Mot de passe :</label>
        <input type="password" name="password" required>
        <label>Rôle :</label>
        <select name="role">
            <option value="1">Client</option>
            <option value="2">Administrateur</option>
        </select>
        <button type="submit">Ajouter</button>
    </form>
</div>
<?php include('./vues/communs/footer.php'); ?>

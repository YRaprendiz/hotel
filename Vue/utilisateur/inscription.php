<!-- /vue/inscription.php -->
<h2>Inscription</h2>
<form action="index.php?route=inscription" method="POST" action="Controller/utilisateurController.php">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required><br><br>

    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required><br><br>

    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required><br><br>

    <label for="telephone ">telephone :</label>
    <input type="telephone " id="telephone " name="telephone " required><br><br>

    <input type="submit" value="S'inscrire">
</form>
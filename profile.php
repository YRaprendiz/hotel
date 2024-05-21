<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <?php
    include("./connexion.php");
    include("./header.php");

    // Puxar os dados do usuário da sessão
    $user = [
        'id' => $_SESSION['user']['id'],
        'prenom' => $_SESSION['user']['prenom'],
        'nom' => $_SESSION['user']['nom'],
        'email' => $_SESSION['user']['email'],
        'password' => $_SESSION['user']['password']
    ];

    // Inicializar mensagem de feedback
    $message = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Coletar os dados do formulário
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Criptografar a nova senha         $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Atualizar os dados do usuário no banco de dados
        $sql = "UPDATE user SET prenom = ?, nom = ?, email = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt->execute([$prenom, $nom, $email, $Password, $user['id']])) {
            $message = "Perfil atualizado com sucesso.";
            // Atualizar os dados da sessão
            $_SESSION['user']['prenom'] = $prenom;
            $_SESSION['user']['nom'] = $nom;
            $_SESSION['user']['email'] = $email;
        } else {
            $message = "Erro ao atualizar perfil. Tente novamente.";
        }
    }
    ?>

    <div class="container">
        <h2>Editar Perfil</h2>
        <?php if ($message): ?>
            <p class="message"><?= $message ?></p>
        <?php endif; ?>
        <form action="edit_profile.php" method="POST">
            <table class="form-table">
                <tr>
                    <td><label for="prenom">Nom:</label></td>
                    <td><input type="text" id="prenom" name="prenom" value="<?= $user['prenom'] ?>" required></td>
                </tr>
                <tr>
                    <td><label for="nom">Prenom:</label></td>
                    <td><input type="text" id="nom" name="nom" value="<?= $user['nom'] ?>" required></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="text" id="email" name="email" value="<?= $user['email'] ?>" required></td>
                </tr>
                <tr>
                    <td><label for="password">Mot de Pass:</label></td>
                    <td><input type="password" id="password" name="password" value=""></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit" class="button">Salvar Alterações</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>

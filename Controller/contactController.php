<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérification des champs
    if (empty($_POST['nom']) || empty($_POST['email']) || empty($_POST['message'])) {
        header('Location: ../vue/contact.php?error=1');
        exit;
    }

    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Simule l'envoi d'un message (par exemple, insertion en base de données ou envoi d'un e-mail)
    $to = 'admin@exemple.com'; // Remplace par l'adresse e-mail du destinataire
    $subject = 'Nouveau message de contact';
    $body = "Nom : $nom\nEmail : $email\nMessage :\n$message";

    // Envoi du message via mail()
    if (mail($to, $subject, $body)) {
        header('Location: ../vue/contact.php?success=1');
    } else {
        header('Location: ../vue/contact.php?error=1');
    }
}
?>

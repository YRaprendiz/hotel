<!-- ContactController.php -->
<?php

include_once('./models/ContactModel.php');

class ContactController {
    protected function setFlashMessage($type, $message) {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }

    private $model;

    public function __construct() {
        $this->model = new ContactModel();
    }

    public function handleForm($data) {
        $nom = $data['nom'] ?? null;
        $email = $data['email'] ?? null;
        $message = $data['message'] ?? null;

        if (!$nom || !$email || !$message) {
            $this->setFlashMessage('error', 'Tous les champs sont requis.');
            return false;
        }

        if ($this->model->saveMessage($nom, $email, $message)) {
            $this->setFlashMessage('success', 'Message envoyé avec succès.');
            return true;
        } else {
            $this->setFlashMessage('error', 'Erreur lors de l\'envoi du message.');
            return false;
        }
    }

    public function listMessages() {
        $messages = $this->model->getMessages();
        if (!empty($messages)) {
            $this->setFlashMessage('success', 'Messages récupérés avec succès.');
        } else {
            $this->setFlashMessage('info', 'Aucun message trouvé.');
        }
        return $messages;
    }
}
?>
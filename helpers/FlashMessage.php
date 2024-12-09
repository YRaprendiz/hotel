<?php
class FlashMessage {
    /**
     * Définit un message flash à afficher.
     * 
     * @param string $type Le type de message (success, danger, warning, info).
     * @param string $message Le contenu du message.
     */
    public static function set($type, $message) {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }

    /**
     * Affiche le message flash s'il est défini.
     * Supprime le message après l'affichage.
     */
    public static function display() {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['flash'])) {
            $type = $_SESSION['flash']['type'];
            $message = $_SESSION['flash']['message'];

            echo "<div class='alert alert-{$type} text-center' role='alert'>{$message}</div>";

            // Supprimer le message flash après affichage
            unset($_SESSION['flash']);
        }
    }
}
?>

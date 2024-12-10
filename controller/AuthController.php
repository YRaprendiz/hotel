<!-- AuthController.php -->
 <?php
session_start();
include_once('./bdd/connexion.php');

class AuthController {
    protected function setFlashMessage($type, $message) {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }

    public static function isLoggedIn() {
        return isset($_SESSION['utilisateur']);
    }

    public static function logout() {
        session_start();
        session_unset();
        session_destroy();

        $this->setFlashMessage('success', 'Déconnexion réussie.');
        header('Location: index.php');
        exit;
    }
}
?>
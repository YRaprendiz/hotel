<?php
include_once('./bdd/connexion.php');
class UtilisateurModel {
    private $bdd;

    public function __construct($bdd) {
        $this->bdd = $bdd;
    }

    public function login($email, $password) {
        $stmt = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function register($nom, $prenom, $email, $password, $adresse) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->bdd->prepare("
            INSERT INTO utilisateurs (nom, prenom, email, password, adresse, role)
            VALUES (:nom, :prenom, :email, :password, :adresse, 'client')
        ");
        return $stmt->execute(compact('nom', 'prenom', 'email', 'password', 'adresse'));
    }

    public function getAllUsers() {
        $stmt = $this->bdd->query("SELECT * FROM utilisateurs");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>

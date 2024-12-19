<!-- UtilisateurModel.php--> 
 <?php
include_once('./bdd/connexion.php');
class UtilisateurModel {
    private $bdd;

    public function __construct($bdd) {
        $this->bdd = $bdd;
    }

    public function login($email, $pass) {
        $stmt = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($pass, $user['pass'])) {
            return $user;
        }
        return false;
    }

    public function register($nom, $prenom, $email, $pass, $adresse) {
        $hash = password_hash($pass, PASSWORD_BCRYPT);
        $stmt = $this->bdd->prepare("
            INSERT INTO utilisateurs (nom, prenom, email, pass, adresse, role)
            VALUES (:nom, :prenom, :email, :pass, :adresse, 'client')
        ");
        return $stmt->execute(compact('nom', 'prenom', 'email', 'pass', 'adresse'));
    }

    public function getAllUsers() {
        $stmt = $this->bdd->query("SELECT * FROM utilisateurs");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id_user) {
        $stmt = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE id_user = :id_user");
        $stmt->execute(['id_user' => $id_user]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    
}
?>

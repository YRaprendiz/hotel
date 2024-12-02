<?php
class Utilisateur
{
    private $bdd;

    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function ajouterUtilisateur($nom, $prenom, $email, $password)
    {
        try {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO utilisateurs (nom, prenom, email, password) VALUES (:nom, :prenom, :email, :password)";
            $stmt = $this->bdd->prepare($sql);
            $stmt->execute([
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':email' => $email,
                ':password' => $passwordHash
            ]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // Log erreur
            return false;
        }
    }
    
    public function connexionUtilisateur($email)
    {
        $stmt = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt;
    }


}
?>

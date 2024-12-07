<?php

class Utilisateur
{
    private $connexion;

    public function __construct($bdd)
    {
        $this->connexion = $bdd;
    }

    // Inscription d'un nouvel utilisateur
    public function inscription($nom, $prenom, $email, $pass, $telephone)
	{
        try{
		$req = $this->connexion->prepare("INSERT INTO utilisateurs (nom, prenom, email, pass, telephone) VALUES (:nom, :prenom, :email, :pass, :telephone)");
                /** Hash du mot de passe
                 * $hashed_password = password_hash($this->password, PASSWORD_BCRYPT); */
                
		$req->bindParam(':nom',     $nom);
		$req->bindParam(':prenom',  $prenom);
		$req->bindParam(':email',   $email);
        $req->bindParam(':pass',$pass);
        $req->bindParam(':telephone',$telephone);
		return $req->execute();
        }catch (PDOException $e) {
            // Gestion d'erreur : Affichage dans les logs
            error_log("Erreur lors de l'ajout d'un utilisateur : " . $e->getMessage());
            return false;
        }

            }
        // Connexion utilisateur
        public function login($email, $password) {
    {

        $stmt = $this->connexion->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && $password === $user['password']) {
            return $user; 
        }
        return false; 
       // var_dump($stmt->fetch());
       // die;
    }

     // Récupérer tous les utilisateurs (pour l'admin)
     public function getAllUsers() {
        $query = "SELECT id, nom, prenom, email, role, created_at FROM " . $this->table_name;
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


        
	public function allUtilisateur()
	{
        try {
		$req = $this->connexion->prepare("SELECT * FROM utilisateurs");
		$req->execute();
		return $req->fetchAll();
        }catch (PDOException $e) {
            error_log("Erreur lors de la récupération des utilisateurs : " . $e->getMessage());
            return [];
        }
	}
    //Supprimer un utilisateur par son identifiant.
	public function supprimerUtilisateur($id)
	{
        try {
		$req = $this->connexion->prepare("DELETE FROM utilisateurs WHERE id_utilisateur = ?");
		return $req->execute([$id]);
        } catch (PDOException $e) {
            error_log("Erreur lors de la suppression de l'utilisateur : " . $e->getMessage());
            return false;
	    }
    }
    public function updateUtilisateur($nom, $prenom, $email, $telephone, $pass, $id)
    {
        try{
        $stmt = $this->connexion->prepare("UPDATE utilisateurs SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone, pass = :pass WHERE id_utilisateur = :id");

        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':id', $id);
       return $stmt->execute([$id]);// Retourne vrai si la mise à jour a réussi
        } catch (PDOException $e) {
        error_log("Erreur lors de la update de l'utilisateur : " . $e->getMessage());
        return false;
        }
    
    }

    public function getUtilisateurById($id) 
    {
        $stmt = $this->connexion->prepare('SELECT * FROM utilisateurs WHERE id_utilisateur = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

	public function selectUtilisateur() 
    {
        try{
        $stmt = $this->connexion->prepare('SELECT COUNT(*) AS nombre_de_utilisateurs FROM utilisateurs');
        $stmt->execute();
        return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Erreur lors de la get l'utilisateur : " . $e->getMessage());
            return false;
        }
    }       

    


}
?>

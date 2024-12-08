<?php

class Utilisateur
{
    private $connexion_hc;

    public function __construct($connexion_hc)
    {
        $this->connexion_hc = $connexion_hc;
    }

    // Inscription d'un nouvel utilisateur
    public function register($nom, $prenom, $email, $pass, $telephone)
	{
        try{
		$req = $this->connexion_hc->prepare("INSERT INTO utilisateurs (nom, prenom, email, pass, telephone) VALUES (:nom, :prenom, :email, :pass, :telephone)");
                /** Hash du mot de passe
                 * $hashed_password = password_hash($this->password, PASSWORD_BCRYPT); */
                
		$req->bindParam(':nom',$nom);
		$req->bindParam(':prenom',$prenom);
		$req->bindParam(':email',$email);
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

        $stmt = $this->connexion_hc->prepare("SELECT * FROM utilisateurs WHERE email = :email");

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
        $query = "SELECT id_utilisateur, nom, prenom, email, role_id , created_at FROM utilisateurs";
        
        $stmt = $this->connexion_hc->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function updateUtilisateur($id,$dados){
        $query="UPDATE utilisateurs SET nom=:nom , prenom=:prenom , email=:email, pass=:pass ,adress=:adress WHERE id_utilisateur=:id_utilisateur";

        $stmt=$this->connexion_hc->prepare($query);

        $stmt->bindParam(':id_utilisateur',$id);
        $stmt->bindParam(':nom',$dados['nom']);
        $stmt->bindParam(':prenom',$dados['prenom']);
        $stmt->bindParam(':email',$dados['email']);
        $stmt->bindParam(':adress',$dados['adress']);

        return $stmt->execute();

    }


        
    //Supprimer un utilisateur par son identifiant.
	public function supprimerUtilisateur($id_utilisateur)
	{
        try {
		$req = $this->connexion_hc->prepare("DELETE FROM utilisateurs WHERE id_utilisateur = ?");
		return $req->execute([$id_utilisateur]);
        } catch (PDOException $e) {
            error_log("Erreur lors de la suppression de l'utilisateur : " . $e->getMessage());
            return false;
	    }
    }
     
}
?>

<?php

class Utilisateur
{
    private $bdd;

    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function ajouterUtilisateur($nom, $prenom, $email, $password, $telephone)
	{
        try{
		$req = $this->bdd->prepare("INSERT INTO utilisateurs (nom, prenom, email, password, telephone) VALUES (:nom, :prenom, :email, :password, :telephone)");

		$req->bindParam(':nom',     $nom);
		$req->bindParam(':prenom',  $prenom);
		$req->bindParam(':email',   $email);
        $req->bindParam(':password',$password);
        $req->bindParam(':telephone',$telephone);
		return $req->execute();
        }catch (PDOException $e) {
            // Gestion d'erreur : Affichage dans les logs
            error_log("Erreur lors de l'ajout d'un utilisateur : " . $e->getMessage());
            return false;
        }

	}

	public function allUtilisateur()
	{
        try {
		$req = $this->bdd->prepare("SELECT * FROM utilisateurs");
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
		$req = $this->bdd->prepare("DELETE FROM utilisateurs WHERE id_utilisateur = ?");
		return $req->execute([$id]);
        } catch (PDOException $e) {
            error_log("Erreur lors de la suppression de l'utilisateur : " . $e->getMessage());
            return false;
	    }
    }
    public function updateUtilisateur($nom, $prenom, $email, $telephone, $password, $id)
    {
        try{
        $stmt = $this->bdd->prepare("UPDATE utilisateurs SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone, password = :password WHERE id_utilisateur = :id");

        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':id', $id);
       return $stmt->execute([$id]);// Retourne vrai si la mise à jour a réussi
        } catch (PDOException $e) {
        error_log("Erreur lors de la update de l'utilisateur : " . $e->getMessage());
        return false;
        }
    
    }

    public function getUtilisateurById($id) 
    {
        $stmt = $this->bdd->prepare('SELECT * FROM utilisateurs WHERE id_utilisateur = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

	public function selectUtilisateur() 
    {
        try{
        $stmt = $this->bdd->prepare('SELECT COUNT(*) AS nombre_de_utilisateurs FROM utilisateurs');
        $stmt->execute();
        return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Erreur lors de la get l'utilisateur : " . $e->getMessage());
            return false;
        }
    }       

    public function selectUtilisateur2_Cloude()
    {
        try {
            $stmt = $this->bdd->prepare("SELECT COUNT(*) AS nombre_de_utilisateur FROM utilisateurs");
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log("Erreur lors du comptage des utilisateurs : " . $e->getMessage());
            return 0;
        }
    }

    public function connexionUtilisateur($email, $password)
    {

        $stmt = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && $password === $user['password']) {
            return $user; 
        }
        return false; 
       // var_dump($stmt->fetch());
       // die;
        }
        


}
?>

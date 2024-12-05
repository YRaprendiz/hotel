<?php
class Utilisateur
{
    private $bdd;

    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function ajouterUtilisateur2($nom, $prenom, $email, $password)
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

    public function ajouterUtilisateur($nom, $prenom, $email)
	{
		$req = $this->bdd->prepare("INSERT INTO utilisateurs (Nom, Prenom, Email) VALUES (:nom , :prenom, :email)");
		$req->bindParam(':nom', $nom);
		$req->bindParam(':prenom', $prenom);
		$req->bindParam(':email', $email);

		return $req->execute();
	}



	public function allUtilisateur()
	{
		$req = $this->bdd->prepare("SELECT * FROM utilisateurs");
		$req->execute();
		return $req->fetchAll();
	}

	public function supprimerUtilisateur($id)
	{

		$req = $this->bdd->prepare("DELETE FROM utilisateurs WHERE ID_Utilisateur = ?");
		return $req->execute([$id]);
	}

    public function updateUtilisateur($nom, $prenom, $email, $id)
    {
        $stmt = $this->bdd->prepare("UPDATE utilisateurs SET nom = :nom, prenom = :prenom WHERE ID_Utilisateurs = :id");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':id', $id);
       return $stmt->execute();
    }

    public function getUtilisateurById($id) {
        $stmt = $this->bdd->prepare('SELECT * FROM utilisateurs WHERE ID_Utilisateur = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
	public function selectUtilisateur( ) {
        $stmt = $this->bdd->prepare('select COUNT(*) AS nombre_de_Utilisateur FROM Utilisateur');
        $stmt->execute();
        return $stmt->fetch();
    }       


    public function connexionUtilisateur($email)
    {

        $stmt = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->execute(['email' => $email]);

       // var_dump($stmt->fetch());
       // die;
        return $stmt->fetch();

    }


}
?>

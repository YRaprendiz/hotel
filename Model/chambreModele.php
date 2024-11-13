<?php//CRUD

class Chambre 
{
	
	function __construct($bdd)
	{
		$this->bdd = $bdd;
	}


	public function ajouterChambre($nom, $prenom, $matiere, $salle)
	{
		$req = $this->bdd->prepare("INSERT INTO chambre (Nom, Prenom, matiere, salle) VALUES (:nom , :prenom, :matiere, :salle)");
		$req->bindParam(':nom', $nom);
		$req->bindParam(':prenom', $prenom);
		$req->bindParam(':matiere', $matiere);
		$req->bindParam(':salle', $salle);

		return $req->execute();
	}



	public function allChambre()
	{
		$req = $this->bdd->prepare("SELECT * FROM chambre");
		$req->execute();
		return $req->fetchAll();
	}

	public function supprimerChambre($id)
	{

		$req = $this->bdd->prepare("DELETE FROM chambre WHERE ID_Chambre = ?");
		return $req->execute([$id]);
	}

    public function updateChambre($nom, $prenom, $matiere, $salle, $id)
    {
        $stmt = $this->bdd->prepare("UPDATE chambre SET nom = :nom, prenom = :prenom 
        	matiere= :matiere, salle = :salle WHERE ID_Chambre = :id");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':matiere', $matiere);
        $stmt->bindParam(':salle', $salle);
        $stmt->bindParam(':id', $id);
       return $stmt->execute();
    }

    public function getChambreById($id) {
        $stmt = $this->bdd->prepare('SELECT * FROM chambre WHERE ID_Chambre = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

	public function countChambre() {
        $stmt = $this->bdd->prepare('select COUNT(*) AS nombre_de_chambres FROM chambre');
        $stmt->execute();
        return $stmt->fetch();
    }

}


?>
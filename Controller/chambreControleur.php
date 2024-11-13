<?php
include('../model/chambreModel.php');
include ("../base_de_donne/connexion.php");

if(isset($_POST['action'])) {


	    $chambreController = new chambreController($bdd);

	switch ($_POST['action']) {

		case 'ajouter':

		 $chambreController->create();
			break;

		case 'supprimer':
		 $chambreController->delete();
			break;

		default:
			# code...
			break;
	}
}


class ChambreController 
{
	private $chambre;

	function __construct($bdd)
	{
		$this->chambre = new Chambre($bdd);
	}

	public function create()
	{

		//verif

		$this->chambre->ajouterChambre($_POST['nom'], $_POST['prenom'], $_POST['matiere'], $_POST['salle']);

		//redirection 
		header('Location:http://127.0.0.1/ecole/');

	}

	public function delete()
	{

		$this->chambre->supprimerChambre($_POST['idChambre']);
		header('Location:http://127.0.0.1/ecole/');
	}

}

?>
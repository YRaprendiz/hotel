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
		 $profController->delete();
			break;

		default:
			# code...
			break;
	}
}


class ProfController 
{
	private $prof;

	function __construct($bdd)
	{
		$this->prof = new Prof($bdd);
	}

	public function create()
	{

		//verif

		$this->prof->ajouterProf($_POST['nom'], $_POST['prenom'], $_POST['matiere'], $_POST['salle']);

		//redirection 
		header('Location:http://127.0.0.1/ecole/');

	}

	public function delete()
	{

		$this->prof->supprimerProf($_POST['idProf']);
		header('Location:http://127.0.0.1/ecole/');
	}

}

?>
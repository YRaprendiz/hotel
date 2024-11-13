<?php
include('../model/utilisateurModel.php');
include ("../base_de_donne/connexion.php");

if(isset($_POST['action'])) {


	    $utilisateurController = new UtilisateurController($bdd);

	switch ($_POST['action']) {

		case 'ajouter':
		 $utilisateurController->create();
			break;

		case 'supprimer':
		 $utilisateurController->delete();
			break;

		default:
			# code...
			break;
	}
}


class UtilisateurController 
{
	private $utilisateur;

	function __construct($bdd)
	{
		$this->utilisateur = new Utilisateur($bdd);
	}

	public function create()
	{

		//verif

		$this->utilisateur->ajouterUtilisateur($_POST['nom'], $_POST['prenom'], $_POST['email']);

		//redirection 
		header('Location:http://127.0.0.1/ecole/');

	}

	public function delete()
	{

		$this->utilisateur->supprimerUtilisateur($_POST['idEleve']);
		header('Location:http://127.0.0.1/ecole/');
	}

}

?>
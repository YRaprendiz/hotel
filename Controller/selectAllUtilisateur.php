<?php

include('model/utilisateurModel.php');
include('bdd/bdd.php');


$utilisateur = new Utilisateur($bdd);
$allUtilisateurs = $utilisateur->allUtilisateur();

$countUtilisateur = $Utilisateur->countUtilisateur()

//var_dump($allUtilisateurs);
//die();


?>
<?php
include ("../vue/listeChambre.php");
include ("../modele/chambreModele.php");
include ("../vue/detailsChambre.php");

if (isset($_GET['id'])) {
    $chambre = getChambreById($_GET['id']);
    include "../vue/detailsChambre.php";
} else {
    $listeChambre = getListeChambre();
    include "../vue/listeChambre.php";
}
<?php
session_start();
include "Modeles/monPdo.php";
include "Modeles/personne.class.php" ;

if (empty($_GET["uc"])) {
    $uc = "accueil";
} else {
    $uc = $_GET["uc"];
}

switch ($uc) {
    case"ajoutpersonne":
                $personne= new personne();
                $personne->setNOM(personne::securiser($_POST['nom']));
                $personne->setPRENOM(personne::securiser($_POST['prenom']));
                $personne->setMAIL(personne::securiser($_POST['mail']));
                $ajoutpersonne = personne::ajouterpersonne($personne);
                include("vues/accueil.php");
                break;
}

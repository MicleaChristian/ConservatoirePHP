<?php
session_start();

include "Modeles/monPdo.php";
include "Modeles/personne.class.php";

if (empty($_GET["uc"])) {
    $uc = "accueil";
} else {
    $uc = $_GET["uc"];
}

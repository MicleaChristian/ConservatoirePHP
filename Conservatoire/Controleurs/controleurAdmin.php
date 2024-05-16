<?php
session_start(); // Démarre une session PHP

include "Modeles/monPdo.php"; // Inclut le fichier monPdo.php qui contient les paramètres de connexion à la base de données
include "Modeles/personne.class.php"; // Inclut le fichier personne.class.php qui définit la classe Personne

if (empty($_GET["uc"])) { // Vérifie si la variable GET "uc" est vide
    $uc = "accueil"; // Si oui, défini la variable $uc sur la valeur "accueil"
} else {
    $uc = $_GET["uc"]; // Si non, récupère la valeur de la variable GET "uc" et l'assigne à la variable $uc
}

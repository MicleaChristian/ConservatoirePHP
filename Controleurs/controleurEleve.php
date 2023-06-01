<?php
$action = $_GET["action"]; // Récupère la valeur de la variable GET "action" et l'assigne à la variable $action
switch ($action) { // Commence la structure de contrôle switch en utilisant la valeur de $action
    case "liste":
        $lesEleves = personne::affichereleve(); // Appelle la méthode statique "afficherTous" de la classe eleve et assigne le résultat à la variable $lesEleves
        include("Vues/affichereleves.php"); // Inclut le fichier de vue "affichereleves.php"
        break;

    case "ajout_form":
        include "Vues/ajoutereleves.php"; // Inclut le fichier de vue "ajoutereleves.php"
        break;

    case "supprimer":
        $ideleve = $_GET['ideleve']; // Récupère la valeur de la variable GET "ideleve" et l'assigne à la variable $ideleve
        eleve::supprimereleve($ideleve); // Appelle la méthode statique "supprimereleve" de la classe eleve en utilisant la valeur de $ideleve
        header('Location: index.php?uc=eleve&action=liste'); // Redirige vers l'URL index.php?uc=eleve&action=liste
        break;

    case "editer_form":
        $ideleve = $_GET["ideleve"]; // Récupère la valeur de la variable GET "ideleve" et l'assigne à la variable $ideleve
        $eleve = eleve::getById($ideleve); // Appelle la méthode statique "getById" de la classe eleve en utilisant la valeur de $ideleve et assigne le résultat à la variable $eleve
        if ($eleve) {
            include "Vues/editereleve.php"; // Inclut le fichier de vue "editereleve.php"
        } else {
            echo "Eleve not found."; // Affiche un message si l'élève n'est pas trouvé
        }
        include "Vues/editereleve.php"; // Inclut le fichier de vue "editereleve.php"
        break;

    case "editer":
        $eleve = new eleve(); // Crée une nouvelle instance de la classe eleve
        $eleve->setIDELEVE($_POST["ideleve"]); // Définit la propriété "IDELEVE" de $eleve avec la valeur de $_POST["ideleve"]
        $eleve->setNIVEAU(eleve::securiser($_POST["niveau"])); // Appelle la méthode statique "securiser" de la classe eleve pour sécuriser la valeur de $_POST["niveau"] et l'assigne à la propriété "NIVEAU" de $eleve
        $eleve->setBOURSE(eleve::securiser($_POST['bourse'])); // Appelle la méthode statique "securiser" de la classe eleve pour sécuriser la valeur de $_POST["bourse"] et l'assigne à la propriété "BOURSE" de $eleve
        $updateeleve = eleve::updateeleve($eleve); // Appelle la méthode statique "updateeleve" de la classe eleve en utilis
    }
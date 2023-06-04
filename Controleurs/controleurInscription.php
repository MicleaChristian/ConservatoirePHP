<?php
$action = $_GET["action"];

switch ($action) {

    case "liste":
        include("Vues/inscription.php");
        break;

    case "ajout_form":
        include "Vues/afficherinscription.php";
        break;

    case "ajouter":
        $inscription = new Inscription();
        $inscription->setIDELEVE(Inscription::securiser($_POST["ideleve"]));
        $inscription->setIDSEANCE(Inscription::securiser($_POST['idseance']));
        $ajoutInscription = Inscription::ajouterInscription($inscription);
        // Redirection vers la liste des personnes
        header('Location: index.php?uc=inscription&action=liste');
        exit;
        break;
}
?>

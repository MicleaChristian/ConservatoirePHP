<?php
require_once 'Modeles/monPdo.php';
require_once 'Modeles/inscription.class.php';
require_once 'Modeles/cours.class.php';
require_once 'Modeles/personne.class.php';

$action = $_GET["action"];
switch ($action) {
    case "liste":
        $lesInscriptions = Inscription::afficherTous();
        include("Vues/affichercours.php");
        break;

    case "nombre_eleves":
        $classId = intval($_GET['classId']);
        $studentCount = Inscription::getStudentCountByClass($classId);
        include("Vues/AfficherNombreEleves.php");
        break;

    case "ajout_form":
        include "Vues/ajouterinscription.php";
        break;

    case "ajouter":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ideleve = Inscription::securiser($_POST['ideleve']);
            $numseance = Inscription::securiser($_POST['numseance']);
            $idprof = Seance::getBynumseance($numseance)->getIDPROF();
            $dateInscription = date('Y-m-d'); // Current date for DATEINSCRIPTION

            $inscription = new Inscription();
            $inscription->setIDPROF($idprof);
            $inscription->setIDELEVE($ideleve);
            $inscription->setNUMSEANCE($numseance);
            $inscription->setDATEINSCRIPTION($dateInscription);

            try {
                Inscription::ajouterInscription($inscription);
                echo "Inscription added successfully.";
                header('Location: index.php?uc=cours&action=liste');
            } catch (Exception $e) {
                echo "Failed to add inscription: " . $e->getMessage();
            }
        }
        break;

    case "supprimer":
        $ideleve = $_GET['ideleve'];
        Inscription::supprimerinscription($ideleve);
        header('Location: index.php?uc=inscription&action=liste');
        break;
}
?>

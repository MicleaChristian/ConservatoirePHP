<?php
require_once 'Modeles/monPdo.php';
require_once 'Modeles/inscription.class.php';
require_once 'Modeles/cours.class.php';
require_once 'Modeles/personne.class.php';

$action = $_GET["action"] ?? '';

switch ($action) {
    case "liste":
        $lesInscriptions = Inscription::afficherTous();
        include("Vues/affichercours.php");
        break;

    case "nombre_eleves":
        $classId = intval($_GET['classId']);
        $students = Inscription::getStudentsByClass($classId);
        include("Vues/afficherNombreEleves.php");
        break;

    case "ajout_form":
        $lesSeances = Seance::afficherTous();
        $lesEleves = personne::affichereleve();
        $assignedStudents = [];
        foreach ($lesSeances as $seance) {
            $assignedStudents[$seance->getNUMSEANCE()] = Inscription::getAssignedStudentsByClass($seance->getNUMSEANCE());
        }
        include "Vues/ajouterinscription.php";
        break;   
                
    case "assign_form":
        $eleveId = $_GET['eleve'];
        $lesSeances = Seance::afficherTous();
        $eleve = personne::getById($eleveId);
        $assignedSeances = Inscription::getAssignedStudentsByClass($eleveId);
        include "Vues/assignerclasses.php";
        break;

    case "ajouter":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || !Inscription::verifyCSRFToken($_POST['csrf_token'])) {
                die('Invalid CSRF token');
            }
            $numseance = Inscription::securiser($_POST['numseance']);
            $ideleves = $_POST['ideleve'];
            $dateInscription = date('Y-m-d');
                
            try {
                $pdo = MonPdo::getInstance();
                $pdo->beginTransaction();
                
                foreach ($ideleves as $ideleve) {
                    $ideleve = Inscription::securiser($ideleve);
                    $idprof = Seance::getBynumseance($numseance)->getIDPROF();
                
                    $inscription = new Inscription();
                    $inscription->setIDPROF($idprof);
                    $inscription->setIDELEVE($ideleve);
                    $inscription->setNUMSEANCE($numseance);
                    $inscription->setDATEINSCRIPTION($dateInscription);
                
                    Inscription::ajouterInscription($inscription);
                }
                
                $pdo->commit();
                echo "Inscriptions ajoutées avec succès.";
                header('Location: index.php?uc=cours&action=liste');
            } catch (Exception $e) {
                $pdo->rollBack();
                echo "Échec de l'ajout des inscriptions : " . $e->getMessage();
            }
        }
        break;
                
    case "ajouterclass":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || !Inscription::verifyCSRFToken($_POST['csrf_token'])) {
                die('Invalid CSRF token');
            }
            $eleveId = Inscription::securiser($_POST['eleveId']);
            $numseances = $_POST['numseance'];
            $dateInscription = date('Y-m-d');
                    
            try {
                $pdo = MonPdo::getInstance();
                $pdo->beginTransaction();
                    
                Inscription::supprimerinscription($eleveId);
                    
                foreach ($numseances as $numseance) {
                    $numseance = Inscription::securiser($numseance);
                    $idprof = Seance::getBynumseance($numseance)->getIDPROF();
                    
                    $inscription = new Inscription();
                    $inscription->setIDPROF($idprof);
                    $inscription->setIDELEVE($eleveId);
                    $inscription->setNUMSEANCE($numseance);
                    $inscription->setDATEINSCRIPTION($dateInscription);
                    
                    Inscription::ajouterInscription($inscription);
                }
                    
                $pdo->commit();
                echo "Inscriptions ajoutées avec succès.";
                header('Location: index.php?uc=personne&action=liste');
            } catch (Exception $e) {
                $pdo->rollBack();
                echo "Échec de l'ajout des inscriptions : " . $e->getMessage();
            }
        }
        break;

    case "supprimer":
        $ideleve = Inscription::securiser($_GET['ideleve']);
        Inscription::supprimerinscription($ideleve);
        header('Location: index.php?uc=inscription&action=liste');
        break;
}
?>

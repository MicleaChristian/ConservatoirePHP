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
                        $numseance = Inscription::securiser($_POST['numseance']);
                        $ideleves = $_POST['ideleve']; // No need to securiser here as we will do it for each element
                        $dateInscription = date('Y-m-d'); // Current date for DATEINSCRIPTION
                
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
                            echo "Inscriptions added successfully.";
                            header('Location: index.php?uc=cours&action=liste');
                        } catch (Exception $e) {
                            $pdo->rollBack();
                            echo "Failed to add inscriptions: " . $e->getMessage();
                        }
                    }
                    break;
                
                    case "ajouterclass":
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $eleveId = Inscription::securiser($_POST['eleveId']);
                            $numseances = $_POST['numseance']; // No need to securiser here as we will do it for each element
                            $dateInscription = date('Y-m-d'); // Current date for DATEINSCRIPTION
                    
                            try {
                                $pdo = MonPdo::getInstance();
                                $pdo->beginTransaction();
                    
                                // First, delete existing inscriptions for the student
                                Inscription::supprimerinscription($eleveId);
                    
                                // Now, add new inscriptions
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
                                echo "Inscriptions added successfully.";
                                header('Location: index.php?uc=personne&action=liste');
                            } catch (Exception $e) {
                                $pdo->rollBack();
                                echo "Failed to add inscriptions: " . $e->getMessage();
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

<?php
    $action = $_GET["action"];
    switch ($action) {
        case "liste":
            $lesSeances = cours::afficherTous();
            include("vues/affichercours.php");
            break;

            case "ajout_form" :
                include "Vues/ajoutercours.php" ;
                break ;


        case "ajouter":
        
                // Traitement du formulaire d'ajout de personne
                $seance = new cours();
                $seance->setIDPROF(cours::securiser($_POST["idprof"]));
                $seance->setTRANCHE(cours::securiser($_POST['tranche']));
                $seance->setJOUR(cours::securiser($_POST['jour']));
                $seance->setNIVEAU(cours::securiser($_POST['niveau']));
                $seance->setCAPACITE(cours::securiser($_POST['capacite']));
                $ajoutCours = cours::ajouterCours($seance);
                // Redirection vers la liste des personnes
                header('Location: index.php?uc=cours&action=liste');
                exit;
        
            break;

        case "supprimer":
            $id = $_GET['id'];
            cours::supprimercours($id);
        
            header('Location: index.php?uc=cours&action=liste');
            break;

            case "editer_form":
                $id = $_GET["id"];
                $seance = cours::getBynumseance($id);
                if ($seance) {
                    include "vues/editercours.php";
                } else {
                    echo "Class not found.";
                }
                break;
            
            case "editer":
                $seance = new cours();
                $seance->setNUMSEANCE($_POST["numseance"]);
                $seance->setIDPROF(cours::securiser($_POST["idprof"]));
                $seance->setTRANCHE(cours::securiser($_POST['tranche']));
                $seance->setJOUR(cours::securiser($_POST['jour']));
                $seance->setNIVEAU(cours::securiser($_POST['niveau']));
                $seance->setCAPACITE(cours::securiser($_POST['capacite']));
                $updateCours = cours::updateCours($seance);
                header('Location: index.php?uc=cours&action=liste');
                exit;
                break;
            
    }

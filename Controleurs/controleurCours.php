<?php
    $action = $_GET["action"];
    switch ($action) {
        case "liste":
            $lesSeances = Seance::afficherTous();
            include("vues/affichercours.php");
            break;

            case "ajout_form":
                require_once 'Modeles/prof.class.php';
                $profs = prof::getAll();
                require_once 'Modeles/heure.class.php';
                $heures = heure::getAll();
                include "Vues/ajoutercours.php";
                break;


        case "ajouter":

                // Traitement du formulaire d'ajout de personne
                $seance = new Seance();
                $seance->setIDPROF(Seance::securiser($_POST["idprof"]));
                $seance->setTRANCHE(Seance::securiser($_POST['tranche']));
                $seance->setJOUR(Seance::securiser($_POST['jour']));
                $seance->setNIVEAU(Seance::securiser($_POST['niveau']));
                $seance->setCAPACITE(Seance::securiser($_POST['capacite']));
                $ajoutCours = Seance::ajouterSeance($seance);
                // Redirection vers la liste des personnes
                header('Location: index.php?uc=cours&action=liste');
                exit;

            break;

        case "supprimer":
            $id = $_GET['id'];
            Seance::supprimercours($id);

            header('Location: index.php?uc=cours&action=liste');
            break;

            case "editer_form":
                $id = $_GET["id"];
                $seance = Seance::getByNumseance($id);
                if ($personne) {
                    include "vues/editercours.php";
                } else {
                    echo "Class not found.";
                }
                include "vues/editercours.php";
                break;

            case "editer":
                $personne = new personne();
                $personne->setID($_POST["id"]);
                $personne->setNOM(personne::securiser($_POST["nom"]));
                $personne->setPRENOM(personne::securiser($_POST['prenom']));
                $personne->setMAIL(personne::securiser($_POST['mail']));
                $personne->setTEL(personne::securiser($_POST['tel']));
                $updatePersonne = personne::updatePersonne($personne);
                header('Location: index.php?uc=personne&action=liste');
                exit;
                break;
    }

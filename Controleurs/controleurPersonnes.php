<?php
require_once 'Modeles/personne.class.php';
require_once 'Modeles/cours.class.php';

$action = $_GET["action"] ?? '';

switch ($action) {
    case "liste":
        $lesPersonnes = personne::affichereleve();
        include("Vues/afficherpersonnes.php");
        break;

    case "listeprof":
        $lesPersonnes = personne::afficherprof();
        include("Vues/afficherprof.php");
        break;

    case "ajout_form":
        include "Vues/ajoutereleve.php";
        break;

    case "ajoutprof_form":
        include "Modeles/instrument.class.php";
        $instruments = Instrument::getAll();
        include "Vues/ajouterprof.php";
        break;

    case "ajouter":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || !personne::verifyCSRFToken($_POST['csrf_token'])) {
                die('Invalid CSRF token');
            }

            $personne = new personne();
            $personne->setNOM(personne::securiser($_POST["nom"]));
            $personne->setPRENOM(personne::securiser($_POST['prenom']));
            $personne->setMAIL(personne::securiser($_POST['mail']));
            $personne->setTEL(personne::securiser($_POST['tel']));
            $personne->setADRESSE(personne::securiser($_POST['adress']));
            $eleve = new eleve();
            $eleve->setNIVEAU(personne::securiser($_POST['niveau']));
            $eleve->setBOURSE(personne::securiser($_POST['bourse']));
            $eleve->setPARENTID(personne::securiser($_POST['parentId']));

            $ajoutPersonne = personne::ajoutereleve($personne, $eleve);
            header('Location: index.php?uc=personne&action=liste');
        }
        break;

    case "ajouterprof":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || !personne::verifyCSRFToken($_POST['csrf_token'])) {
                die('Invalid CSRF token');
            }

            $personne = new personne();
            $personne->setNOM(personne::securiser($_POST["nom"]));
            $personne->setPRENOM(personne::securiser($_POST['prenom']));
            $personne->setMAIL(personne::securiser($_POST['mail']));
            $personne->setTEL(personne::securiser($_POST['tel']));
            $personne->setADRESSE(personne::securiser($_POST['adress']));
            $prof = new prof();
            $prof->setINSTRUMENT(personne::securiser($_POST['libelle']));
            $prof->setSALAIRE(personne::securiser($_POST['salaire']));

            $ajoutPersonne = personne::ajouterprof($personne, $prof);
            header('Location: index.php?uc=personne&action=listeprof');
        }
        break;

    case "supprimer":
        $id = personne::securiser($_GET['id']);
        personne::supprimereleve($id);
        header('Location: index.php?uc=personne&action=liste');
        break;

    case "supprimerprof":
        $id = personne::securiser($_GET['id']);
        try {
            personne::supprimerprof($id);
            header('Location: index.php?uc=personne&action=listeprof');
        } catch (PDOException $e) {
            echo "Error deleting professor: " . $e->getMessage();
        }
        break;

    case "editer_form":
        $id = personne::securiser($_GET["id"]);
        $personne = personne::getById($id);
        if ($personne) {
            include "Vues/editerpersonne.php";
        } else {
            echo "Person not found.";
        }
        break;

    case "editer_formprof":
        $id = personne::securiser($_GET["id"]);
        $personne = personne::getById($id);
        if ($personne) {
            include "Vues/editerprof.php";
        } else {
            echo "Person not found.";
        }
        break;

    case "editer":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || !personne::verifyCSRFToken($_POST['csrf_token'])) {
                die('Invalid CSRF token');
            }

            $personne = new personne();
            $personne->setID(personne::securiser($_GET["id"]));
            $personne->setNOM(personne::securiser($_POST["nom"]));
            $personne->setPRENOM(personne::securiser($_POST['prenom']));
            $personne->setMAIL(personne::securiser($_POST['mail']));
            $personne->setTEL(personne::securiser($_POST['tel']));
            $personne->setBOURSE(personne::securiser($_POST['bourse']));
            $updatePersonne = personne::updatePersonne($personne);
            header('Location: index.php?uc=personne&action=liste');
        }
        break;

    case "editerprof":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || !personne::verifyCSRFToken($_POST['csrf_token'])) {
                die('Invalid CSRF token');
            }

            $personne = new personne();
            $personne->setID(personne::securiser($_GET["id"]));
            $personne->setNOM(personne::securiser($_POST["nom"]));
            $personne->setPRENOM(personne::securiser($_POST['prenom']));
            $personne->setMAIL(personne::securiser($_POST['mail']));
            $personne->setTEL(personne::securiser($_POST['tel']));
            $updatePersonne = personne::updateprof($personne);
            header('Location: index.php?uc=personne&action=listeprof');
        }
        break;
}
?>

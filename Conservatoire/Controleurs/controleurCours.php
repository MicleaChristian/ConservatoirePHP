<?php
$action = $_GET["action"];
switch ($action) {
    case "liste":
        $lesSeances = Seance::afficherTous();
        include("Vues/affichercours.php");
        break;

    case "ajout_form":
        require_once 'Modeles/prof.class.php';
        $profs = prof::getAll();
        require_once 'Modeles/heure.class.php';
        $heures = heure::getAll();
        require_once 'Modeles/jour.class.php';
        $jours = jour::getAll();
        require_once 'Modeles/niveau.class.php';
        $niveaux = niveau::getAll();
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
        $idSeance = $_GET['idseance'];
        Seance::supprimercours($idSeance);
        header('Location: index.php?uc=cours&action=liste');
        break;

        case "editer_form":
            $id = $_GET["idseance"];
            $seance = Seance::getByNumseance($id);
            if ($seance) {
                require_once 'Modeles/prof.class.php';
                $profs = prof::getAll();
                require_once 'Modeles/heure.class.php';
                $heures = heure::getAll();
                require_once 'Modeles/jour.class.php';
                $jours = jour::getAll();
                require_once 'Modeles/niveau.class.php';
                $niveaux = niveau::getAll();
                include "Vues/editercours.php";
            } else {
                echo "Cours non trouvé.";
            }
            break;

        case "editer":
            $id = $_GET["idseance"];
            $seance = Seance::getByNumseance($id);
            if ($seance) {
                $seance->setIDPROF(Seance::securiser($_POST["idprof"]));
                $seance->setTRANCHE(Seance::securiser($_POST['tranche']));
                $seance->setJOUR(Seance::securiser($_POST['jour']));
                $seance->setNIVEAU(Seance::securiser($_POST['niveau']));
                $seance->setCAPACITE(Seance::securiser($_POST['capacite']));
                Seance::updateSeance($seance);
                header('Location: index.php?uc=cours&action=liste');
                exit;
            } else {
                echo "Cours non trouvé.";
            }
            break;

}
?>

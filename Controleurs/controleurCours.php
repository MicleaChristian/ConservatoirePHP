<?php
require_once 'Modeles/inscription.class.php';
require_once 'Modeles/personne.class.php';
require_once 'Modeles/cours.class.php';

$action = $_GET["action"] ?? '';

switch ($action) {
    case "liste":
        $lesSeances = Seance::afficherTous();
        foreach ($lesSeances as $seance) {
            $seanceObject = (object)$seance;
            $seanceObject->studentCount = Inscription::getStudentCountByClass($seanceObject->getNUMSEANCE());
        }
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || !Seance::verifyCSRFToken($_POST['csrf_token'])) {
                die('Invalid CSRF token');
            }
            $idprofs = Seance::securiser($_POST['idprof']);
            $numseances = Seance::securiser($_POST['numseance']);
            $ideleve = Seance::securiser($_POST['ideleve']);
            $dateInscription = date('Y-m-d');

            try {
                $pdo = MonPdo::getInstance();
                $pdo->beginTransaction();

                for ($i = 0; $i < count($idprofs); $i++) {
                    $idprof = $idprofs[$i];
                    $numseance = $numseances[$i];

                    $stmt = $pdo->prepare("INSERT INTO inscription (IDPROF, IDELEVE, NUMSEANCE, DATEINSCRIPTION) VALUES (:idprof, :ideleve, :numseance, :dateinscription)");
                    $stmt->bindParam(':idprof', $idprof);
                    $stmt->bindParam(':ideleve', $ideleve);
                    $stmt->bindParam(':numseance', $numseance);
                    $stmt->bindParam(':dateinscription', $dateInscription);
                    $stmt->execute();
                }

                $pdo->commit();
                echo "Inscription ajoutée avec succès.";
            } catch (Exception $e) {
                $pdo->rollBack();
                echo "Échec de l'ajout de l'inscription : " . $e->getMessage();
            }
        }
        break;

        case "ajoutercours":
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_POST['csrf_token']) || !Seance::verifyCSRFToken($_POST['csrf_token'])) {
                    die('Invalid CSRF token');
                }
                $idprof = Seance::securiser($_POST['idprof']);
                $tranche = Seance::securiser($_POST['tranche']);
                $jour = Seance::securiser($_POST['jour']);
                $niveau = Seance::securiser($_POST['niveau']);
                $capacite = Seance::securiser($_POST['capacite']);
        
                // Check for duplicates
                if (Seance::checkDuplicate($idprof, $tranche, $jour)) {
                    echo "Erreur : Un cours avec le même professeur, jour et tranche horaire existe déjà.";
                } else {
                    $seance = new Seance();
                    $seance->setIDPROF($idprof);
                    $seance->setTRANCHE($tranche);
                    $seance->setJOUR($jour);
                    $seance->setNIVEAU($niveau);
                    $seance->setCAPACITE($capacite);
        
                    try {
                        Seance::ajouterSeance($seance);
                        echo "Cours ajouté avec succès.";
                        header('Location: index.php?uc=cours&action=liste');
                        exit;
                    } catch (Exception $e) {
                        echo "Erreur lors de l'ajout du cours : " . $e->getMessage();
                    }
                }
            }
            break;
        

    case "supprimer":
        $idSeance = Seance::securiser($_GET['idseance']);
        Seance::supprimercours($idSeance);
        header('Location: index.php?uc=cours&action=liste');
        break;

    case "editer_form":
        $id = Seance::securiser($_GET["idseance"]);
        $seance = Seance::getBynumseance($id);
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || !Seance::verifyCSRFToken($_POST['csrf_token'])) {
                die('Invalid CSRF token');
            }
            $id = Seance::securiser($_GET["idseance"]);
            $seance = Seance::getBynumseance($id);
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
        }
        break;
}
?>

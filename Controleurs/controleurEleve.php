    <?php
    $action = $_GET["action"];
    switch ($action) {
        case "liste":
            $lesEleves = eleve::afficherTous();
            include("vues/affichereleves.php");
            break;

            case "ajout_form" :
                include "Vues/ajoutereleves.php" ;
                break ;


        case "ajouter":
        
                // Traitement du formulaire d'ajout de eleve
                $eleve = new eleve();
                $eleve->setIDELEVE(eleve::securiser($_POST[""]));
                $eleve->setNIVEAU(eleve::securiser($_POST['niveau']));
                $eleve->setBOURSE(eleve::securiser($_POST['bourse']));
                // Redirection vers la liste des eleves
                header('Location: index.php?uc=eleve&action=liste');
                exit;
        
            break;

        case "supprimer":
            $ideleve = $_GET['ideleve'];
            eleve::supprimereleve($ideleve);
        
            header('Location: index.php?uc=eleve&action=liste');
            break;

            case "editer_form":
                $ideleve = $_GET["ideleve"];
                $eleve = eleve::getById($ideleve);
                if ($eleve) {
                    include "vues/editereleve.php";
                } else {
                    echo "Eleve not found.";
                }
                include "vues/editereleve.php";
                break;
            
            case "editer":
                $eleve = new eleve();
                $eleve->setIDELEVE($_POST["ideleve"]);
                $eleve->setNIVEAU(eleve::securiser($_POST["niveau"]));
                $eleve->setBOURSE(eleve::securiser($_POST['bourse']));
                $updateeleve = eleve::updateeleve($eleve);
                header('Location: index.php?uc=eleve&action=liste');
                exit;
                break;
    }

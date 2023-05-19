    <?php
    $action = $_GET["action"];
    switch ($action) {
        case "liste":
            $lesPersonnes = personne::afficherTous();
            include("vues/afficherpersonnes.php");
            break;

            case "ajout_form" :
                include "Vues/ajouterpersonnes.php" ;
                break ;


        case "ajouter":
        
                // Traitement du formulaire d'ajout de personne
                $personne = new personne();
                $personne->setNOM(personne::securiser($_POST["nom"]));
                $personne->setPRENOM(personne::securiser($_POST['prenom']));
                $personne->setMAIL(personne::securiser($_POST['mail']));
                $personne->setTEL(personne::securiser($_POST['tel']));
                $ajoutPersonne = personne::ajouterPersonne($personne);
                // Redirection vers la liste des personnes
                header('Location: index.php?uc=personne&action=liste');
                exit;
        
            break;

        case "supprimer":
            $id = $_GET['id'];
            personne::supprimerpersonne($id);
        
            header('Location: index.php?uc=personne&action=liste');
            break;

            case "editer_form":
                $id = $_GET["id"];
                $personne = personne::getById($id);
                if ($personne) {
                    include "vues/editerpersonne.php";
                } else {
                    echo "Person not found.";
                }
                include "vues/editerpersonne.php";
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

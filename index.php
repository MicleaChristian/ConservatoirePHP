<?php

ini_set('session.cookie_lifetime', 86400); // Durée de vie des cookies de session en secondes
ini_set('session.gc_maxlifetime', 86400); // Durée de vie des données de session en secondes
session_start();

include "Modeles/monPdo.php";
include "Modeles/personne.class.php" ;
include "Controleurs/login_controller.php" ;
include "Modeles/cours.class.php" ;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (empty($_GET["uc"])) {
    $uc = "accueil_login";
} else {
    $uc = $_GET["uc"];
}

/*partie de debug débile pour déterminer si une sesison est bien ouverte en affichant le nom de la session
echo 'Session user_id: ' . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'not set');
echo '<br>UC: ' . $uc;
*/






$loginController = new LoginController();

switch ($uc) {
    case "accueil_login" :
        $uc = $_POST['uc'] ?? 'default';
        $action = $_POST['action'] ?? 'default';
    
        if ($uc === 'login' && $action === 'submit') {
            $loginController = new LoginController();
            $loginController->login();
            exit;
        } elseif ($uc === 'default') {
            header('Location: index.php?uc=login');
            exit;
        }

    case "login":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $loginController->login();
        } else {
            $loginController->show();
        }
        break;

    case "accueil";
        include("Vues/accueil.php");
        break;

    case "personne":
        include("controleurs/controleurPersonnes.php");
        break;

    case "cours":
        include("controleurs/controleurCours.php");
        break;

    case "Admin":
        include "controleurs/controleurAdmin.php";
        break;

    case "eleve";
        include("controleurs/controleurEleve.php");
        break;

    case "logout":
        $loginController->logout();
        include("Vues/login_view.php");
        break;

    case "ajouter":
        include("Vues/ajouterpersonnes.php");
        break;



}

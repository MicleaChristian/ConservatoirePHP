<?php
$action = $_GET["action"];

switch ($action) {

    case "liste":
        // affiche les cours au bon emplacement sur le calendrier
        include("Vues/planning.php");
        break;

}
?>

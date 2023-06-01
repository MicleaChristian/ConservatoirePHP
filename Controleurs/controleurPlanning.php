<?php
$action = $_GET["action"];
switch ($action) {
    // redirection vers le planning
    case "planning":
        include("Vues/planning.php");
        break;
    // redirection vers la liste des cours
    }
?>

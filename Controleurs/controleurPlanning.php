<?php
$action = $_GET["action"];

switch ($action) {

    case "liste":
        include("Vues/planning.php");
        break;

}
?>

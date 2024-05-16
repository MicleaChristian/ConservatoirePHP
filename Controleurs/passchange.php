<?php
class Passup{
    public function login()
    {
        $id = $_POST['id'];
        $result = users::getById($id);
        if ($result) {
            header('Location:index.php?uc=accueil');
            exit;
        } else {
            $error_message = "Compte introuvable";
            require_once('Vues/upform.php');
        }
    }
}

$action = $_GET["action"]; // Récupère la valeur de la variable GET "action" et l'assigne à la variable $action
switch ($action) { // Commence la structure de contrôle switch en utilisant la valeur de $action

    case "upform":
        require_once("Modeles/user.class.php");
        include("Vues/upform.php");
        $id = $_POST['id'];
        $userid = users::getById($id);
        if ($userid) {
            include "index.php";
        } else {
            echo "Compte introuvable.";
            require_once('Vues/upform.php');
        }
        break;

    case "idfound":
        require_once('Modeles/user.class.php');
        include('Vues/passup.php');
        $id = $_POST['id'];
        
    }
<?php

require 'Modeles/user.class.php';

$action = htmlspecialchars($_GET['action'], ENT_QUOTES, 'UTF-8');

switch ($action) {
    case "upform":
        include("Vues/upform.php");
        break;

    case "idfound":
        $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
        $user = users::getByUsername($username);
        if ($user) {
            include('Vues/passup.php');
        } else {
            $error_message = "Compte introuvable.";
            require_once('Vues/upform.php');
        }
        break;

    case "updatepassword":
        $id = intval($_POST['id']);
        $newPassword = $_POST['password'];

        $long = (strlen($newPassword) >= 16);
        $min = preg_match('@[a-z]@', $newPassword);
        $maj = preg_match('@[A-Z]@', $newPassword);
        $num = preg_match('@[0-9]@', $newPassword);
        $Carspec = preg_match('@[^\w]@', $newPassword);

        if (!$long || !$min || !$maj || !$num || !$Carspec) {
            $error_message = 'Le mot de passe ne convient pas aux paramètres attendus!';
            include('Vues/passup.php');
        } else {
            users::updatePassword($id, $newPassword);
            echo 'Mot de passe changé avec succès!';
            include('Vues/mdpchange.php');
        }
        break;

    default:
        echo "Action non reconnue.";
        break;
}
?>

<?php

require 'Modeles/user.class.php';

// Debugging statement to confirm the file inclusion
if (!class_exists('users')) {
    echo "Class 'users' not found after including user.class.php";
    exit;
}

$action = $_GET['action'];

switch ($action) {
    case "upform":
        include("Vues/upform.php");
        break;

    case "idfound":
        $username = $_POST['username'];
        // Debugging statement to confirm the class exists before using it
        if (class_exists('users')) {
            $user = users::getByUsername($username);
            if ($user) {
                include('Vues/passup.php');
            } else {
                $error_message = "Compte introuvable.";
                require_once('Vues/upform.php');
            }
        } else {
            echo "Class 'users' not found at runtime";
        }
        break;

    case "updatepassword":
        $id = $_POST['id'];
        $newPassword = $_POST['password'];

        // Password validation
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
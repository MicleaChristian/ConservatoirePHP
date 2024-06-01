<?php
require_once 'Modeles/user.class.php';

$action = $_GET["action"];
switch ($action) {
    case "ajout_form":
        include "Vues/ajouteruser.php";
        break;

    case "ajouter":
        $username = users::securiser($_POST["username"]);
        $existingUser = users::getByUsername($username);
        
        if ($existingUser) {
            $error_message = "Le nom d'utilisateur est déjà utilisé.";
            include "Vues/ajouteruser.php";
        } else {
            $user = new users();
            $user->setUSERNAME($username);
            $user->setPASS(users::securiser($_POST["password"]));
            $user->setROLE(users::securiser($_POST["role"]));
            users::ajouterUser($user);
            header('Location: index.php?uc=usersucc&action=display');
        }
        break;

    case "supprimer":
        $id = $_GET['id'];
        $pdo = MonPdo::getInstance();
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header('Location: index.php?uc=user&action=display');
        break;

    case "editer_form":
        $id = $_GET['id'];
        include "Vues/editeruser.php";
        break;

    case "editer":
        $user = new users();
        $user->setID(users::securiser($_POST['id']));
        $user->setUSERNAME(users::securiser($_POST['username']));
        $user->setROLE(users::securiser($_POST['role']));
        users::updateUser($user);
        header('Location: index.php?uc=user&action=display');
        break;

    case "display":
        include "Vues/afficherusers.php";
        break;
}
?>

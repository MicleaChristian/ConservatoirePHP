<?php
$action = $_GET["action"];
switch ($action) {
    case "ajout_form":
        include "Vues/ajouteruser.php";
        break;

    case "ajouter":
        // Handle the form submission
        $user = new users();
        $user->setUSERNAME(users::securiser($_POST["username"]));
        $user->setPASS(users::securiser($_POST["password"]));  // Password will be hashed in the model
        $user->setROLE(users::securiser($_POST["role"]));
        
        $ajoutUser = users::ajouterUser($user);
        // Redirect to a success page or login page
        header('Location: index.php?uc=user&action=ajout_form');
        break;
}

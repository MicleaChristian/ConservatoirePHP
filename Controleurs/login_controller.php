<?php
require_once('Modeles/monPdo.php');

class LoginController 
{
    public function show() 
    {
        require_once('Vues/login_view.php');
    }

    public function login()
    {
        $username = $_POST['id'];
        $password = $_POST['password'];
        $result = MonPdo::login($username, $password);
        if ($result) {
            session_start();
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['password'] = $user['password'];
            header('Location: index.php?uc=accueil');
            exit;
        } 
        else
        {
            $error_message = "Invalid username or password.";
            require_once('Vues/login_view.php');
        }
    }
    
    public function logout() 
    {
        unset($_SESSION['id']);
        unset($_SESSION['password']);
        session_destroy();

        header('Location:index.php?uc=logout');
        exit;
    }
}

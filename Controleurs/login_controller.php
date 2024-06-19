<?php

class LoginController
{
    public function show()
    {
        require_once('Vues/login_view.php');
    }

    public function login()
    {
        $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
        $password = sha1($_POST['password']);
        
        $result = MonPdo::login($username, $password);
        
        if ($result) {
            session_start();
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['user_name'] = $result['username'];
            $_SESSION['user_role'] = $result['role'];
            header('Location:index.php?uc=accueil');
            exit;
        } else {
            $error_message = "Invalid username or password.";
            require_once('Vues/login_view.php');
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: index.php?uc=login');
    }
}
?>

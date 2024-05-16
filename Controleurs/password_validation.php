<?php
    if(isset($_POST['password'])){
        $password = $_POST['password'];


        $long = (strlen($password) == 16);
        
        $min = preg_match('@[a-z]@', $password);
        
        $maj = preg_match('@[A-Z]@', $password);
        
        $num = preg_match('@[0-9]@', $password);
        
        $Carspec = preg_match('@[^\w]@', $password);
        
        if(!$long || !$min || !$maj || !$num || !$Carspec){
            echo 'Le mot de passe ne convient pas aux paramètres attendus!';
        }else{
            
            echo 'Mot de passe changé avec succès!';
        }
    }
?>

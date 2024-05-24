<?php
class MonPdo
{
    private static $serveur='mysql:host=localhost';
    private static $bdd='dbname=kurghsvm_conservatoire'; 
    private static $user='root'; 
    private static $mdp='';
    private static $monPdo;
    private static $unPdo = null;
    
    private function __construct()
    {
        MonPdo::$unPdo = new PDO(MonPdo::$serveur.';'.MonPdo::$bdd, MonPdo::$user, MonPdo::$mdp);
        MonPdo::$unPdo->query("SET CHARACTER SET utf8");
        MonPdo::$unPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function __destruct()
    { 
        MonPdo::$unPdo = null;
    }

    public static function getInstance()
    {
        if (self::$unPdo == null) {
            self::$monPdo = new MonPdo();
        }
        return self::$unPdo;
    }

    public static function checkSessionAndRedirect()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?uc=redirlogin');
            exit();
        }
    }

    public static function getUserRole($userId)
    {
        $instance = self::getInstance();
        $stmt = $instance->prepare("SELECT role FROM users WHERE id = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public static function login($username, $password) 
    {
        $instance = self::getInstance();
        $stmt = $instance->prepare("SELECT * FROM users WHERE username=:username AND password=:password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}

<?php
class users
{
    private int $ID;
    private string $PASS;
    private string $USERNAME;
    private string $ROLE;

    public function getID()
    {
        return $this->ID;
    }

    public function setID($ID)
    {
        $this->ID = $ID;
        return $this;
    }

    public function getPASS()
    {
        return $this->PASS;
    }

    public function setPASS($PASS)
    {
        $this->PASS = $PASS;
        return $this;
    }

    public function getUSERNAME()
    {
        return $this->USERNAME;
    }

    public function setUSERNAME($USERNAME): self
    {
        $this->USERNAME = $USERNAME;
        return $this;
    }

    public function getROLE()
    {
        return $this->ROLE;
    }

    public function setROLE($ROLE): self
    {
        $this->ROLE = $ROLE;
        return $this;
    }

    public static function updateUser(users $user)
    {
        $pdo = MonPdo::getInstance();
        $stmt = $pdo->prepare("UPDATE users SET username = :username, role = :role WHERE id = :id");
        $stmt->bindValue(':username', $user->getUSERNAME(), PDO::PARAM_STR);
        $stmt->bindValue(':role', $user->getROLE(), PDO::PARAM_STR);
        $stmt->bindValue(':id', $user->getID(), PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function updatePassword($id, $password)
    {
        $pdo = MonPdo::getInstance();
        $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->bindValue(':password', hash('sha512', $password), PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function ajouterUser(users $user)
    {
        $pdo = MonPdo::getInstance();
        $req = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
        $req->bindValue(':username', $user->getUSERNAME(), PDO::PARAM_STR);
        $req->bindValue(':password', $user->getPASS(), PDO::PARAM_STR);
        $req->bindValue(':role', $user->getROLE(), PDO::PARAM_STR);
        $req->execute();
    }

    public static function securiser($donnees)
    {
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees, ENT_QUOTES, 'UTF-8');
        return $donnees;
    }

    public static function getById($id)
    {
        $pdo = MonPdo::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return self::mapUserProperties($row);
        }
        return null;
    }

    public static function getByUsername($username)
    {
        $pdo = MonPdo::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return self::mapUserProperties($row);
        }
        return null;
    }

    private static function mapUserProperties($row)
    {
        $user = new users();
        $user->setID($row['id']);
        $user->setUSERNAME($row['username']);
        $user->setPASS($row['password']);
        $user->setROLE($row['role']);
        return $user;
    }
}
?>

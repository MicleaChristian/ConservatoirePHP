<?php
class users
{
    private $ID;
    private $PASS;






    /**
     * Get the value of ID
     */ 
    public function getID()
    {
        return $this->ID;
    }

    /**
     * Set the value of ID
     *
     * @return  self
     */ 
    public function setID($ID)
    {
        $this->ID = $ID;

        return $this;
    }

    /**
     * Get the value of PASS
     */ 
    public function getPASS()
    {
        return $this->PASS;
    }

    /**
     * Set the value of PASS
     *
     * @return  self
     */ 
    public function setPASS($PASS)
    {
        $this->PASS = $PASS;

        return $this;
    }

    public static function updateuser(users $user)
    {
            $pdo = MonPdo::getInstance();
            $req = $pdo->prepare("UPDATE users SET password=SHA1(:pass), WHERE ID=:id");
            $req->bindValue(':id', $user->getID(), PDO::PARAM_INT);
            $req->bindValue(':pass', $user->getPASS(), PDO::PARAM_STR);
            $req->execute();
    }

    public static function getById($id)
    {
            $req = MonPdo::getInstance()->prepare("SELECT * FROM users WHERE ID = :id");
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'users');
            $req->execute();
            return $req->fetch();
    }

}

<?php
class users
{
    private $ID;
    private $PASS;
    private $USERNAME;
    private $ROLE;

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

    /**
     * Get the value of USERNAME
     */
    public function getUSERNAME() {
        return $this->USERNAME;
    }

    /**
     * Set the value of USERNAME
     */
    public function setUSERNAME($USERNAME): self {
        $this->USERNAME = $USERNAME;
        return $this;
    }

        /**
     * Get the value of ROLE
     */
    public function getROLE() {
        return $this->ROLE;
    }

    /**
     * Set the value of ROLE
     */
    public function setROLE($ROLE): self {
        $this->ROLE = $ROLE;
        return $this;
    }

    public static function updateuser(users $user)
    {
        $pdo = MonPdo::getInstance();
        $req = $pdo->prepare("UPDATE users SET password=SHA1(:pass) WHERE id=:id");
        $req->bindValue(':id', $user->getID(), PDO::PARAM_INT);
        $req->bindValue(':pass', $user->getPASS(), PDO::PARAM_STR);
        $req->execute();
    }

    public static function getById($id)
    {
        $req = MonPdo::getInstance()->prepare("SELECT * FROM users WHERE id = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'users');
        $req->execute();
        return $req->fetch();
    }


}

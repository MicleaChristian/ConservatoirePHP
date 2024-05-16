<?php
class jour
{
    private $JOUR;


    /**
     * Get the value of JOUR
     */
    public function getJOUR() {
        return $this->JOUR;
    }

    /**
     * Set the value of JOUR
     */
    public function setJOUR($JOUR): self {
        $this->JOUR = $JOUR;
        return $this;
    }

    public static function getAll()
    {
        $pdo = MonPdo::getInstance();
        $query = "SELECT jour FROM jour";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

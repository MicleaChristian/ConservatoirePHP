<?php
class Heure
{
    private $TRANCHE;


    /**
     * Get the value of IDTRANCHE
     */
    public function getTRANCHE() {
        return $this->TRANCHE;
    }

    /**
     * Set the value of IDTRANCHE
     */
    public function setTRANCHE($TRANCHE): self {
        $this->TRANCHE = $TRANCHE;
        return $this;
    }

    public static function getAll()
    {
        $pdo = MonPdo::getInstance();
        $query = "SELECT tranche FROM heure ORDER BY SUBSTRING(tranche, 1, 2)";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

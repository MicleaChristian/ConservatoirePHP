<?php
class Instrument
{
    private $INSTRUMENT;


    // ...

    /**
     * Get the value of INSTRUMENT
     */
    public function getINSTRUMENT()
    {
        return $this->INSTRUMENT;
    }

    /**
     * Set the value of INSTRUMENT
     */
    public function setINSTRUMENT($INSTRUMENT): self
    {
        $this->INSTRUMENT = $INSTRUMENT;
        return $this;
    }

    public static function getAll()
    {
        $pdo = MonPdo::getInstance();
        $query = "SELECT id, libelle FROM instrument";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
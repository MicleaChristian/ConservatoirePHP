<?php

class prof
{
    private $IDPROF;
    private $INSTRUMENT;
    private $SALAIRE;

    public function getIDPROF() {
        return $this->IDPROF;
    }

    public function setIDPROF($IDPROF): self {
        $this->IDPROF = $IDPROF;
        return $this;
    }

    public function getINSTRUMENT() {
        return $this->INSTRUMENT;
    }

    public function setINSTRUMENT($INSTRUMENT): self {
        $this->INSTRUMENT = $INSTRUMENT;
        return $this;
    }

    public function getSALAIRE() {
        return $this->SALAIRE;
    }

    public function setSALAIRE($SALAIRE): self {
        $this->SALAIRE = $SALAIRE;
        return $this;
    }

    public static function afficherTous()
    {
        $req = MonPdo::getInstance()->prepare("select * from prof");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'prof');
        $req->execute();
        $lesResultats = $req->fetchAll();
        return $lesResultats;
    }

    public static function getAll()
    {
        $pdo = MonPdo::getInstance();
        $query = "SELECT idprof, nom FROM prof JOIN personne ON prof.idprof = personne.id";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

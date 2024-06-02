
<?php
class Inscription
{
    private $IDPROF;
    private $IDELEVE;
    private $NUMSEANCE;
    private $DATEINSCRIPTION;

    /**
     * Get the value of IDPROF
     */
    public function getIDPROF()
    {
        return $this->IDPROF;
    }

    /**
     * Set the value of IDPROF
     *
     * @return  self
     */
    public function setIDPROF($IDPROF)
    {
        $this->IDPROF = $IDPROF;

        return $this;
    }

    /**
     * Get the value of NUMSEANCE
     */
    public function getNUMSEANCE()
    {
        return $this->NUMSEANCE;
    }

    /**
     * Set the value of NUMSEANCE
     *
     * @return  self
     */
    public function setNUMSEANCE($NUMSEANCE)
    {
        $this->NUMSEANCE = $NUMSEANCE;

        return $this;
    }

    /**
     * Get the value of IDELEVE
     */
    public function getIDELEVE()
    {
        return $this->IDELEVE;
    }

    /**
     * Set the value of IDELEVE
     *
     * @return  self
     */
    public function setIDELEVE($IDELEVE)
    {
        $this->IDELEVE = $IDELEVE;

        return $this;
    }

    /**
     * Get the value of DATEINSCRIPTION
     */
    public function getDATEINSCRIPTION()
    {
        return $this->DATEINSCRIPTION;
    }

    /**
     * Set the value of DATEINSCRIPTION
     *
     * @return  self
     */
    public function setDATEINSCRIPTION($DATEINSCRIPTION)
    {
        $this->DATEINSCRIPTION = $DATEINSCRIPTION;

        return $this;
    }


    public static function afficherTous()
    {

        $req = MonPdo::getInstance()->prepare("select * from inscription");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'inscription');
        $req->execute();
        $lesResultats = $req->fetchAll();
        return $lesResultats;
    }

    public static function inscriptionExists($idprof, $ideleve, $numseance)
    {
        $pdo = MonPdo::getInstance();
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM inscription WHERE IDPROF = :idprof AND IDELEVE = :ideleve AND NUMSEANCE = :numseance");
        $stmt->bindValue(':idprof', $idprof, PDO::PARAM_INT);
        $stmt->bindValue(':ideleve', $ideleve, PDO::PARAM_INT);
        $stmt->bindValue(':numseance', $numseance, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public static function ajouterInscription(Inscription $inscription)
    {
        if (self::inscriptionExists($inscription->getIDPROF(), $inscription->getIDELEVE(), $inscription->getNUMSEANCE())) {
            throw new Exception('Duplicate entry for IDPROF, IDELEVE, and NUMSEANCE');
        }

        $pdo = MonPdo::getInstance();
        $req = "INSERT INTO inscription (IDPROF, IDELEVE, NUMSEANCE, DATEINSCRIPTION) VALUES (:idprof, :ideleve, :numseance, :dateinsc)";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(':idprof', $inscription->getIDPROF(), PDO::PARAM_INT);
        $stmt->bindValue(':ideleve', $inscription->getIDELEVE(), PDO::PARAM_INT);
        $stmt->bindValue(':numseance', $inscription->getNUMSEANCE(), PDO::PARAM_INT);
        $stmt->bindValue(':dateinsc', $inscription->getDATEINSCRIPTION(), PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function supprimerinscription($ideleve)
    {
        $pdo = MonPdo::getInstance();
        $stmt = $pdo->prepare("DELETE FROM inscription WHERE IDELEVE = :ideleve");
        $stmt->bindParam(':ideleve', $ideleve, PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function securiser($donnees)
    {
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }

    public static function getByideleve($ideleve)
    {
        $req = MonPdo::getInstance()->prepare("SELECT * FROM inscription WHERE IDELEVE = :ideleve");
        $req->bindValue(':ideleve', $ideleve, PDO::PARAM_INT);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'inscription');
        $req->execute();
        return $req->fetch();
    }


    public static function getStudentCountByClass($classId) {
        $pdo = MonPdo::getInstance();
        $stmt = $pdo->prepare("SELECT COUNT(*) as student_count FROM inscription WHERE NUMSEANCE = :classId");
        $stmt->bindValue(':classId', $classId, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['student_count'] : 0;
    }

    

}

?>

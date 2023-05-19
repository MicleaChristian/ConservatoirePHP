
<?php
class cours
{
    private $IDPROF;
    private $NUMSEANCE;
    private $TRANCHE;
    private $JOUR;
    private $NIVEAU;
    private $CAPACITE;

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
     * Get the value of TRANCHE
     */
    public function getTRANCHE()
    {
        return $this->TRANCHE;
    }

    /**
     * Set the value of TRANCHE
     *
     * @return  self
     */
    public function setTRANCHE($TRANCHE)
    {
        $this->TRANCHE = $TRANCHE;

        return $this;
    }

    /**
     * Get the value of JOUR
     */
    public function getJOUR()
    {
        return $this->JOUR;
    }

    /**
     * Set the value of JOUR
     *
     * @return  self
     */
    public function setJOUR($JOUR)
    {
        $this->JOUR = $JOUR;

        return $this;
    }

    /**
     * Get the value of NIVEAU
     */
    public function getNIVEAU()
    {
        return $this->NIVEAU;
    }

    /**
     * Set the value of NIVEAU
     *
     * @return  self
     */
    public function setNIVEAU($NIVEAU)
    {
        $this->NIVEAU = $NIVEAU;

        return $this;
    }

    /**
     * Get the value of CAPACITE
     */
    public function getCAPACITE()
    {
        return $this->CAPACITE;
    }

    /**
     * Set the value of CAPACITE
     *
     * @return  self
     */
    public function setCAPACITE($CAPACITE)
    {
        $this->CAPACITE = $CAPACITE;

        return $this;
    }


    public static function afficherTous()
    {
        $req = MonPdo::getInstance()->prepare("select * from seance");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'cours');
        $req->execute();
        $lesResultats = $req->fetchAll();
        return $lesResultats;
    }

    public static function ajoutercours(cours $cours)
    {
        $pdo = MonPdo::getInstance();
        $req = $pdo->prepare("insert into cours (IDPROF,TRANCHE,JOUR,NIVEAU,CAPACITE) values (:idprof,:tranche,:jour,:niveau,:capacite)");
        $req->bindValue(':idprof', $cours->getIDPROF(), PDO::PARAM_STR);
        $req->bindValue(':tranche', $cours->getTRANCHE(), PDO::PARAM_STR);
        $req->bindValue(':jour', $cours->getJOUR(), PDO::PARAM_STR);
        $req->bindValue(':niveau', $cours->getNIVEAU(), PDO::PARAM_STR);
        $req->bindValue(':capacite', $cours->getCAPACITE(), PDO::PARAM_STR);
        $req->execute();
    }

    public static function supprimercours($numseance)
    {
        $req = MonPdo::getInstance()->prepare("DELETE FROM cours WHERE NUMSEANCE = :numseance");
        $req->bindParam(':numseance', $numseance);
        $req->execute();
    }    

    public static function securiser($donnees)
    {
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }

    public static function getBynumseance($numseance)
    {
        $req = MonPdo::getInstance()->prepare("SELECT * FROM seance WHERE NUMSEANCE = :numseance");
        $req->bindValue(':numseance', $numseance, PDO::PARAM_INT);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'seance');
        $req->execute();
        return $req->fetch();
    }

    public static function updatePersonne(cours $seance)
    {
        $pdo = MonPdo::getInstance();
        $req = $pdo->prepare("UPDATE seance SET IDPROF=:idprof, TRANCHE=:tranche, JOUR=:jour, NIVEAU=:niveau, CAPACITE=:capacite WHERE NUMSEANCE=:numseance");
        $req->bindValue(':id', $seance->getIDPROF(), PDO::PARAM_INT);
        $req->bindValue(':nom', $seance->getTRANCHE(), PDO::PARAM_STR);
        $req->bindValue(':prenom', $seance->getJOUR(), PDO::PARAM_STR);
        $req->bindValue(':mail', $seance->getNIVEAU(), PDO::PARAM_STR);
        $req->bindValue(':tel', $seance->getCAPACITE(), PDO::PARAM_STR);
        $req->execute();
    }
}

?>
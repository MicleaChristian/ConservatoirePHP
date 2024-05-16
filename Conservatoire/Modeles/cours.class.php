<?php
class Seance
{
    private $IDPROF;
    private $NUMSEANCE;
    private $TRANCHE;
    private $JOUR;
    private $NIVEAU;
    private $CAPACITE;
    private $IDSEANCE;


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

    /**
     * Set the value of IDSEANCE
     * @return  self
     */
    public function setIDSEANCE($IDSEANCE)
    {
        $this->IDSEANCE = $IDSEANCE;

        return $this;
    }

    /**
     * Get the value of IDSEANCE
     */

    public function getIDSEANCE()
    {
        return $this->IDSEANCE;
    }


    public static function afficherTous()
    {

        $req = MonPdo::getInstance()->prepare("select * from seance");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Seance');
        $req->execute();
        $lesResultats = $req->fetchAll();
        return $lesResultats;
    }

    public static function ajouterSeance(Seance $seance)
    {
        $pdo = MonPdo::getInstance();
        $req = "INSERT INTO seance (NUMSEANCE, IDPROF, TRANCHE, JOUR, NIVEAU, CAPACITE) VALUES (:numseance, :idprof, :tranche, :jour, :niveau, :capacite)";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(':numseance', $seance->getNUMSEANCE(), PDO::PARAM_INT);
        $stmt->bindValue(':idprof', $seance->getIDPROF(), PDO::PARAM_INT);
        $stmt->bindValue(':tranche', $seance->getTRANCHE(), PDO::PARAM_STR);
        $stmt->bindValue(':jour', $seance->getJOUR(), PDO::PARAM_STR);
        $stmt->bindValue(':niveau', $seance->getNIVEAU(), PDO::PARAM_STR);
        $stmt->bindValue(':capacite', $seance->getCAPACITE(), PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function supprimercours($numseance)
    {
        $pdo = MonPdo::getInstance();
        $stmt = $pdo->prepare("DELETE FROM seance WHERE NUMSEANCE = :numseance");
        $stmt->bindParam(':numseance', $numseance, PDO::PARAM_INT);
        $stmt->execute();
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

    public static function getByJourAndTranche($jour, $tranche)
    {
        $req = MonPdo::getInstance()->prepare("SELECT * FROM seance WHERE JOUR = :jour AND TRANCHE = :tranche");
        $req->bindValue(':jour', $jour, PDO::PARAM_STR);
        $req->bindValue(':tranche', $tranche, PDO::PARAM_STR);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'seance');
        $req->execute();
        return $req->fetch();
    }



    public static function updatePersonne($personne)
    {
        $pdo = MonPdo::getInstance();
        $req = "UPDATE personne SET NOM = :nom, PRENOM = :prenom, EMAIL = :email, TELEPHONE = :telephone, ADRESSE = :adresse, CODEPOSTAL = :codepostal, VILLE = :ville, MOTDEPASSE = :motdepasse WHERE IDPERSONNE = :idpersonne";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(':idpersonne', $personne->getIDPERSONNE(), PDO::PARAM_INT);
        $stmt->bindValue(':nom', $personne->getNOM(), PDO::PARAM_STR);
        $stmt->bindValue(':prenom', $personne->getPRENOM(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $personne->getEMAIL(), PDO::PARAM_STR);
        $stmt->bindValue(':telephone', $personne->getTELEPHONE(), PDO::PARAM_STR);
        $stmt->bindValue(':adresse', $personne->getADRESSE(), PDO::PARAM_STR);
        $stmt->bindValue(':codepostal', $personne->getCODEPOSTAL(), PDO::PARAM_STR);
        $stmt->bindValue(':ville', $personne->getVILLE(), PDO::PARAM_STR);
        $stmt->bindValue(':motdepasse', $personne->getMOTDEPASSE(), PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function updateSeance(Seance $seance)
    {
        $req = MonPdo::getInstance()->prepare("UPDATE seance SET IDPROF = :idprof, TRANCHE = :tranche, JOUR = :jour, NIVEAU = :niveau, CAPACITE = :capacite WHERE NUMSEANCE = :numseance");
        $req->bindValue(':numseance', $seance->getNUMSEANCE(), PDO::PARAM_INT);
        $req->bindValue(':idprof', $seance->getIDPROF(), PDO::PARAM_INT);
        $req->bindValue(':tranche', $seance->getTRANCHE(), PDO::PARAM_STR);
        $req->bindValue(':jour', $seance->getJOUR(), PDO::PARAM_STR);
        $req->bindValue(':niveau', $seance->getNIVEAU(), PDO::PARAM_STR);
        $req->bindValue(':capacite', $seance->getCAPACITE(), PDO::PARAM_INT);
        $req->execute();
    }

    public static function getSeanceforinsc()
    {
        $pdo = MonPdo::getInstance();
        $query = "SELECT nom, instrument, seance.IDPROF, NUMSEANCE, TRANCHE, JOUR, NIVEAU, CAPACITE FROM seance 
                    JOIN personne ON seance.idprof = personne.id
                    JOIN prof ON seance.idprof = prof.idprof";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
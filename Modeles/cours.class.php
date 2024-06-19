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
    private $INSTRUMENT;
    public $studentCount;

    public function getINSTRUMENT()
    {
        return $this->INSTRUMENT;
    }

    public function setINSTRUMENT($INSTRUMENT)
    {
        $this->studentCount = $INSTRUMENT;
    }

    public function getStudentCount()
    {
        return $this->studentCount;
    }

    public function setStudentCount($studentCount)
    {
        $this->studentCount = $studentCount;
    }

    public function getIDPROF()
    {
        return $this->IDPROF;
    }

    public function setIDPROF($IDPROF)
    {
        $this->IDPROF = $IDPROF;
        return $this;
    }

    public function getNUMSEANCE()
    {
        return $this->NUMSEANCE;
    }

    public function setNUMSEANCE($NUMSEANCE)
    {
        $this->NUMSEANCE = $NUMSEANCE;
        return $this;
    }

    public function getTRANCHE()
    {
        return $this->TRANCHE;
    }

    public function setTRANCHE($TRANCHE)
    {
        $this->TRANCHE = $TRANCHE;
        return $this;
    }

    public function getJOUR()
    {
        return $this->JOUR;
    }

    public function setJOUR($JOUR)
    {
        $this->JOUR = $JOUR;
        return $this;
    }

    public function getNIVEAU()
    {
        return $this->NIVEAU;
    }

    public function setNIVEAU($NIVEAU)
    {
        $this->NIVEAU = $NIVEAU;
        return $this;
    }

    public function getCAPACITE()
    {
        return $this->CAPACITE;
    }

    public function setCAPACITE($CAPACITE)
    {
        $this->CAPACITE = $CAPACITE;
        return $this;
    }

    public function setIDSEANCE($IDSEANCE)
    {
        $this->IDSEANCE = $IDSEANCE;
        return $this;
    }

    public function getIDSEANCE()
    {
        return $this->IDSEANCE;
    }

    public static function afficherTous()
    {
        $req = MonPdo::getInstance()->prepare("SELECT * FROM seance");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Seance');
        $req->execute();
        return $req->fetchAll();
    }

    public static function ajouterSeance(Seance $seance)
    {
        $pdo = MonPdo::getInstance();
        $req = "INSERT INTO seance (NUMSEANCE, IDPROF, TRANCHE, JOUR, NIVEAU, CAPACITE) VALUES (:numseance, :idprof, :tranche, :jour, :niveau, :capacite)";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(':numseance', $seance->getNUMSEANCE(), PDO::PARAM_INT);
        $stmt->bindValue(':idprof', $seance->getIDPROF(), PDO::PARAM_INT);
        $stmt->bindValue(':tranche', self::securiser($seance->getTRANCHE()), PDO::PARAM_STR);
        $stmt->bindValue(':jour', self::securiser($seance->getJOUR()), PDO::PARAM_STR);
        $stmt->bindValue(':niveau', self::securiser($seance->getNIVEAU()), PDO::PARAM_STR);
        $stmt->bindValue(':capacite', $seance->getCAPACITE(), PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function supprimercours($numseance)
    {
        $pdo = MonPdo::getInstance();
        
        $pdo->beginTransaction();
        
        try {
            $stmt = $pdo->prepare("DELETE FROM inscription WHERE NUMSEANCE = :numseance");
            $stmt->bindParam(':numseance', $numseance, PDO::PARAM_INT);
            $stmt->execute();
    
            $stmt = $pdo->prepare("DELETE FROM seance WHERE NUMSEANCE = :numseance");
            $stmt->bindParam(':numseance', $numseance, PDO::PARAM_INT);
            $stmt->execute();
    
            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
            throw $e;
        }
    }

    public static function securiser($donnees)
    {
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees, ENT_QUOTES, 'UTF-8');
        return $donnees;
    }

    public static function getBynumseance($numseance)
    {
        $req = MonPdo::getInstance()->prepare("SELECT * FROM seance WHERE NUMSEANCE = :numseance");
        $req->bindValue(':numseance', $numseance, PDO::PARAM_INT);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Seance');
        $req->execute();
        return $req->fetch();
    }

    public static function getByJourAndTranche($jour, $tranche)
    {
        $req = MonPdo::getInstance()->prepare("SELECT * FROM seance WHERE JOUR = :jour AND TRANCHE = :tranche");
        $req->bindValue(':jour', self::securiser($jour), PDO::PARAM_STR);
        $req->bindValue(':tranche', self::securiser($tranche), PDO::PARAM_STR);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Seance');
        $req->execute();
        return $req->fetch();
    }

    public static function updateSeance(Seance $seance)
    {
        $req = MonPdo::getInstance()->prepare("UPDATE seance SET IDPROF = :idprof, TRANCHE = :tranche, JOUR = :jour, NIVEAU = :niveau, CAPACITE = :capacite WHERE NUMSEANCE = :numseance");
        $req->bindValue(':numseance', $seance->getNUMSEANCE(), PDO::PARAM_INT);
        $req->bindValue(':idprof', $seance->getIDPROF(), PDO::PARAM_INT);
        $req->bindValue(':tranche', self::securiser($seance->getTRANCHE()), PDO::PARAM_STR);
        $req->bindValue(':jour', self::securiser($seance->getJOUR()), PDO::PARAM_STR);
        $req->bindValue(':niveau', self::securiser($seance->getNIVEAU()), PDO::PARAM_STR);
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

    public static function getAllByJourAndTranche($jour, $tranche)
    {
        $pdo = MonPdo::getInstance();
        $stmt = $pdo->prepare(
            "SELECT seance.*, prof.INSTRUMENT 
             FROM seance 
             JOIN prof ON seance.IDPROF = prof.IDPROF 
             WHERE jour = :jour AND tranche = :tranche"
        );
    
        $secureJour = self::securiser($jour);
        $secureTranche = self::securiser($tranche);
    
        $stmt->bindParam(':jour', $secureJour);
        $stmt->bindParam(':tranche', $secureTranche);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Seance');
    }

    public static function generateCSRFToken()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function verifyCSRFToken($token)
    {
        if (isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token)) {
            unset($_SESSION['csrf_token']);
            return true;
        }
        return false;
    }
}
?>

<form method="POST" action="ajouter_seance.php">
    <input type="hidden" name="csrf_token" value="<?php echo Seance::generateCSRFToken(); ?>">
</form>

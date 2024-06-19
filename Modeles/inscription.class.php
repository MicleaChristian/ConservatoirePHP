<?php
class Inscription
{
    private $IDPROF;
    private $IDELEVE;
    private $NUMSEANCE;
    private $DATEINSCRIPTION;

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

    public function getIDELEVE()
    {
        return $this->IDELEVE;
    }

    public function setIDELEVE($IDELEVE)
    {
        $this->IDELEVE = $IDELEVE;
        return $this;
    }

    public function getDATEINSCRIPTION()
    {
        return $this->DATEINSCRIPTION;
    }

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
        $donnees = htmlspecialchars($donnees, ENT_QUOTES, 'UTF-8');
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

    public static function getStudentCountByClass($classId)
    {
        $pdo = MonPdo::getInstance();
        $stmt = $pdo->prepare("SELECT COUNT(*) as student_count FROM inscription WHERE NUMSEANCE = :classId");
        $stmt->bindValue(':classId', $classId, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['student_count'] : 0;
    }

    public static function getStudentsByClass($classId)
    {
        $pdo = MonPdo::getInstance();
        $stmt = $pdo->prepare("SELECT personne.NOM, personne.PRENOM FROM inscription JOIN personne ON inscription.IDELEVE = personne.ID WHERE NUMSEANCE = :classId");
        $stmt->bindValue(':classId', $classId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAssignedStudentsByClass($classId)
    {
        $pdo = MonPdo::getInstance();
        $stmt = $pdo->prepare("SELECT IDELEVE FROM inscription WHERE NUMSEANCE = :classId");
        $stmt->bindValue(':classId', $classId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
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

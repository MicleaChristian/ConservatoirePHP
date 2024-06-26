<?php

require_once 'Modeles/prof.class.php';

class eleve
{
    private $IDELEVE;
    private $NIVEAU;
    private $BOURSE;
    private $PARENT_ID;

    public function getIDELEVE()
    {
        return $this->IDELEVE;
    }

    public function setIDELEVE($IDELEVE)
    {
        $this->IDELEVE = $IDELEVE;
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

    public function getBOURSE()
    {
        return $this->BOURSE;
    }

    public function setBOURSE($BOURSE)
    {
        $this->BOURSE = $BOURSE;
        return $this;
    }

    public function getPARENTID()
    {
        return $this->PARENT_ID;
    }

    public function setPARENTID($PARENT_ID)
    {
        $this->PARENT_ID = $PARENT_ID;
        return $this;
    }

    public static function getElevesByParentId($parentId)
    {
        $pdo = MonPdo::getInstance();
        $stmt = $pdo->prepare('SELECT p.NOM, p.PRENOM, p.MAIL, p.TEL, e.NIVEAU, e.BOURSE, e.IDELEVE 
                               FROM eleve e 
                               JOIN personne p ON e.IDELEVE = p.ID 
                               WHERE e.PARENT_ID = :parentId');
        $stmt->execute(['parentId' => $parentId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}

class personne
{
    private $ID;
    private $NOM;
    private $PRENOM;
    private $TEL;
    private $ADRESSE;
    private $MAIL;
    private $IDELEVE;
    private $NIVEAU;
    private $BOURSE;
    private $IDPROF;
    private $INSTRUMENT;
    private $SALAIRE;
    private $PARENT_ID;
    
    public function getID()
    {
        return $this->ID;
    }

    public function setID($ID)
    {
        $this->ID = $ID;
        return $this;
    }

    public function getNOM()
    {
        return $this->NOM;
    }

    public function setNOM($NOM)
    {
        $this->NOM = $NOM;
        return $this;
    }

    public function getPRENOM()
    {
        return $this->PRENOM;
    }

    public function setPRENOM($PRENOM)
    {
        $this->PRENOM = $PRENOM;
        return $this;
    }

    public function getTEL()
    {
        return $this->TEL;
    }

    public function setTEL($TEL)
    {
        $this->TEL = $TEL;
        return $this;
    }

    public function getADRESSE()
    {
        return $this->ADRESSE;
    }

    public function setADRESSE($ADRESSE)
    {
        $this->ADRESSE = $ADRESSE;
        return $this;
    }

    public function getMAIL()
    {
        return $this->MAIL;
    }

    public function setMAIL($MAIL)
    {
        $this->MAIL = $MAIL;
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

    public function getNIVEAU()
    {
        return $this->NIVEAU;
    }

    public function setNIVEAU($NIVEAU)
    {
        $this->NIVEAU = $NIVEAU;
        return $this;
    }

    public function getBOURSE()
    {
        return $this->BOURSE;
    }

    public function setBOURSE($BOURSE)
    {
        $this->BOURSE = $BOURSE;
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

    public function getPARENTID()
    {
        return $this->PARENT_ID;
    }

    public function setPARENTID($PARENT_ID)
    {
        $this->PARENT_ID = $PARENT_ID;
        return $this;
    }

    public static function affichereleve()
    {
        $req = MonPdo::getInstance()->prepare("
            SELECT personne.ID, personne.NOM, personne.PRENOM, eleve.NIVEAU, eleve.IDELEVE 
            FROM personne 
            INNER JOIN eleve ON personne.ID = eleve.IDELEVE
        ");
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public static function afficherprof()
    {
        $req = MonPdo::getInstance()->prepare("SELECT * FROM personne INNER JOIN prof ON ID = IDPROF;");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'personne');
        $req->execute();
        $lesResultats = $req->fetchAll();
        return $lesResultats;
    }

    public static function ajoutereleve(personne $personne, eleve $eleve)
    {
        $pdo = MonPdo::getInstance();
        $req = $pdo->prepare("insert into personne (NOM, PRENOM, TEL, MAIL, ADRESSE) values (:nom,:prenom,:tel,:mail,:adress);

        set @last_id_in_personne = LAST_INSERT_ID();

        insert into eleve (IDELEVE, NIVEAU, BOURSE, PARENT_ID)
        VALUES (@last_id_in_personne, :niveau, :bourse, :parentId);
        ");
        $req->bindValue(':nom', $personne->getNOM(), PDO::PARAM_STR);
        $req->bindValue(':prenom', $personne->getPRENOM(), PDO::PARAM_STR);
        $req->bindValue(':mail', $personne->getMAIL(), PDO::PARAM_STR);
        $req->bindValue(':tel', $personne->getTEL(), PDO::PARAM_STR);
        $req->bindValue(':adress', $personne->getADRESSE(), PDO::PARAM_STR);
        $req->bindValue(':niveau', $eleve->getNIVEAU(), PDO::PARAM_STR);
        $req->bindValue(':bourse', $eleve->getBOURSE(), PDO::PARAM_STR);
        $req->bindValue(':parentId', $eleve->getPARENTID(), PDO::PARAM_STR);
        $req->execute();
    }

    public static function ajouterprof(personne $personne, prof $prof)
    {
        $pdo = MonPdo::getInstance();
        $req = $pdo->prepare("insert into personne (NOM, PRENOM, TEL, MAIL, ADRESSE) values (:nom,:prenom,:tel,:mail,:adress);

        set @last_id_in_personne = LAST_INSERT_ID();

        insert into prof (IDPROF, INSTRUMENT , SALAIRE)
        VALUES (@last_id_in_personne, :libelle, :salaire);");
        $req->bindValue(':nom', $personne->getNOM(), PDO::PARAM_STR);
        $req->bindValue(':prenom', $personne->getPRENOM(), PDO::PARAM_STR);
        $req->bindValue(':mail', $personne->getMAIL(), PDO::PARAM_STR);
        $req->bindValue(':tel', $personne->getTEL(), PDO::PARAM_STR);
        $req->bindValue(':adress', $personne->getADRESSE(), PDO::PARAM_STR);
        $req->bindValue(':libelle', $prof->getINSTRUMENT(), PDO::PARAM_STR);
        $req->bindValue(':salaire', $prof->getSALAIRE(), PDO::PARAM_STR);
        $req->execute();
    }

    public static function supprimereleve($id)
    {
        $pdo = MonPdo::getInstance();

        $req = $pdo->prepare("DELETE FROM inscription WHERE IDELEVE = :id");
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();

        $req = $pdo->prepare("DELETE FROM eleve WHERE IDELEVE = :id");
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();

        $req = $pdo->prepare("DELETE FROM personne WHERE ID = :id");
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }

    public static function supprimerprof($id)
    {
        $pdo = MonPdo::getInstance();

        try {
            $pdo->beginTransaction();

            $req = $pdo->prepare("DELETE FROM inscription WHERE NUMSEANCE IN (SELECT NUMSEANCE FROM seance WHERE IDPROF = :id)");
            $req->bindParam(':id', $id, PDO::PARAM_INT);
            $req->execute();

            $req = $pdo->prepare("DELETE FROM seance WHERE IDPROF = :id");
            $req->bindParam(':id', $id, PDO::PARAM_INT);
            $req->execute();

            $req = $pdo->prepare("DELETE FROM inscription WHERE IDPROF = :id");
            $req->bindParam(':id', $id, PDO::PARAM_INT);
            $req->execute();

            $req = $pdo->prepare("DELETE FROM prof WHERE IDPROF = :id");
            $req->bindParam(':id', $id, PDO::PARAM_INT);
            $req->execute();

            $req = $pdo->prepare("DELETE FROM personne WHERE ID = :id");
            $req->bindParam(':id', $id, PDO::PARAM_INT);
            $req->execute();

            $pdo->commit();
        } catch (PDOException $e) {
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

    public static function getById($id)
    {
        $req = MonPdo::getInstance()->prepare("SELECT * FROM personne WHERE ID = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'personne');
        $req->execute();
        return $req->fetch();
    }

    public static function updatePersonne(personne $personne)
    {
        $pdo = MonPdo::getInstance();
        $req = $pdo->prepare("update personne set NOM=:nom, PRENOM=:prenom, MAIL=:mail, TEL=:tel, ADRESSE=:adress WHERE ID=:id");
        $req->bindValue(':id', $personne->getID(), PDO::PARAM_INT);
        $req->bindValue(':nom', $personne->getNOM(), PDO::PARAM_STR);
        $req->bindValue(':prenom', $personne->getPRENOM(), PDO::PARAM_STR);
        $req->bindValue(':mail', $personne->getMAIL(), PDO::PARAM_STR);
        $req->bindValue(':tel', $personne->getTEL(), PDO::PARAM_STR);
        $req->bindValue(':adress', $personne->getADRESSE(), PDO::PARAM_STR);
        $req->execute();
    
        $req = $pdo->prepare("update eleve set BOURSE=:bourse WHERE IDELEVE=:id");
        $req->bindValue(':bourse', $personne->getBOURSE(), PDO::PARAM_INT);
        $req->bindValue(':id', $personne->getID(), PDO::PARAM_INT);
        $req->execute();
    }
    
    public static function updateprof(personne $personne)
    {
        $req = MonPdo::getInstance()->prepare("update personne set NOM=:nom, PRENOM=:prenom, MAIL=:mail, TEL=:tel WHERE ID=:id");
        $req->bindValue(':id', $personne->getID(), PDO::PARAM_INT);
        $req->bindValue(':nom', $personne->getNOM(), PDO::PARAM_STR);
        $req->bindValue(':prenom', $personne->getPRENOM(), PDO::PARAM_STR);
        $req->bindValue(':mail', $personne->getMAIL(), PDO::PARAM_STR);
        $req->bindValue(':tel', $personne->getTEL(), PDO::PARAM_STR);
        $req->execute();
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

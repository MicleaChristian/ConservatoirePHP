<?php
class eleve
{
        private $IDELEVE;
        private $NIVEAU;
        private $BOURSE;


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
         * Get the value of BOURSE
         */ 
        public function getBOURSE()
        {
                return $this->BOURSE;
        }

        /**
         * Set the value of BOURSE
         *
         * @return  self
         */ 
        public function setBOURSE($BOURSE)
        {
                $this->BOURSE = $BOURSE;

                return $this;
        }



    public static function afficherTous()
    {
            $req = MonPdo::getInstance()->prepare("select * from eleve");
            $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'eleve');
            $req->execute();
            $lesResultats = $req->fetchAll();
            return $lesResultats;
    }

    public static function ajoutereleve(eleve $eleve)
    {
            $pdo = MonPdo::getInstance();
            $req = $pdo->prepare("insert into eleve (IDELEVE,NIVEAU,BOURSE) values (:ideleve,:niveau,:bourse)");
            $req->bindValue(':ideleve', $eleve->getIDELEVE(), PDO::PARAM_STR);
            $req->bindValue(':niveau', $eleve->getNIVEAU(), PDO::PARAM_STR);
            $req->bindValue(':bourse', $eleve->getBOURSE(), PDO::PARAM_STR);
            $req->execute();
    }

    public static function supprimereleve($id)
    {
            $req = monPdo::getInstance()->prepare("delete from eleve where ideleve = :ideleve");
            $req->bindParam(':ideleve', $ideleve);
            $req->execute();
    }

    public static function securiser($donnees)
    {
            $donnees = trim($donnees);
            $donnees = stripslashes($donnees);
            $donnees = htmlspecialchars($donnees);
            return $donnees;
    }

    public static function getById($id)
    {
            $req = MonPdo::getInstance()->prepare("SELECT * FROM eleve WHERE IDELEVE = :ideleve");
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'eleve');
            $req->execute();
            return $req->fetch();
    }

    public static function updateeleve(eleve $eleve)
    {
            $pdo = MonPdo::getInstance();
            $req = $pdo->prepare("UPDATE eleve SET NIVEAU=:niveau, BOURSE=:bourse WHERE IDELEVE=:ideleve");
            $req->bindValue(':ideleve', $eleve->getIDELEVE(), PDO::PARAM_INT);
            $req->bindValue(':niveau', $eleve->getNIVEAU(), PDO::PARAM_STR);
            $req->bindValue(':bourse', $eleve->getBOURSE(), PDO::PARAM_STR);
            $req->execute();
    }

    public static function getAll()
    {
        $pdo = MonPdo::getInstance();
        $query = "SELECT ideleve, nom FROM eleve JOIN personne ON eleve.ideleve = personne.id";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

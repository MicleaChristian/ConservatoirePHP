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


    public static function supprimereleve($id)
    {
            $req = monPdo::getInstance()->prepare("delete from eleve where ideleve = :ideleve");
            $req->bindParam(':ideleve', $ideleve);
            $req->execute();
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
}

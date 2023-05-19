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
}
class personne
{
        private $ID;
        private $NOM;
        private $PRENOM;
        private $TEL;
        private $ADRESSE;
        private $MAIL;

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

        public static function afficherTous()
        {
                $req = MonPdo::getInstance()->prepare("select * from personne");
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
                
                insert into eleve (IDELEVE, NIVEAU, BOURSE)
                VALUES (@last_id_in_personne, :niveau, :bourse);
                ");
                $req->bindValue(':nom', $personne->getNOM(), PDO::PARAM_STR);
                $req->bindValue(':prenom', $personne->getPRENOM(), PDO::PARAM_STR);
                $req->bindValue(':mail', $personne->getMAIL(), PDO::PARAM_STR);
                $req->bindValue(':tel', $personne->getTEL(), PDO::PARAM_STR);
                $req->bindValue(':adress', $personne->getADRESSE(), PDO::PARAM_STR);
                $req->bindValue(':niveau', $eleve->getNIVEAU(), PDO::PARAM_STR);
                $req->bindValue(':bourse', $eleve->getBOURSE(), PDO::PARAM_STR);
                $req->execute();
        }

        public static function supprimerpersonne($id)
        {
                $req = monPdo::getInstance()->prepare("delete from personne where id = :id");
                $req->bindParam(':id', $id);
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
                $req = MonPdo::getInstance()->prepare("SELECT * FROM personne WHERE ID = :id");
                $req->bindValue(':id', $id, PDO::PARAM_INT);
                $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'personne');
                $req->execute();
                return $req->fetch();
        }

        public static function updatePersonne(personne $personne)
        {
                $pdo = MonPdo::getInstance();
                $req = $pdo->prepare("UPDATE personne SET NOM=:nom, PRENOM=:prenom, MAIL=:mail, TEL=:tel WHERE ID=:id");
                $req->bindValue(':id', $personne->getID(), PDO::PARAM_INT);
                $req->bindValue(':nom', $personne->getNOM(), PDO::PARAM_STR);
                $req->bindValue(':prenom', $personne->getPRENOM(), PDO::PARAM_STR);
                $req->bindValue(':mail', $personne->getMAIL(), PDO::PARAM_STR);
                $req->bindValue(':tel', $personne->getTEL(), PDO::PARAM_STR);
                $req->execute();
        }
}

?>
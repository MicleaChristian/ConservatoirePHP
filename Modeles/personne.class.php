<?php
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

        public static function ajouterpersonne(personne $personne)
        {
                $pdo = MonPdo::getInstance();
                $req = $pdo->prepare("insert into personne (NOM,PRENOM,MAIL,TEL) values (:nom,:prenom,:mail,:tel)");
                $req->bindValue(':nom', $personne->getNOM(), PDO::PARAM_STR);
                $req->bindValue(':prenom', $personne->getPRENOM(), PDO::PARAM_STR);
                $req->bindValue(':mail', $personne->getMAIL(), PDO::PARAM_STR);
                $req->bindValue(':tel', $personne->getTEL(), PDO::PARAM_STR);
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
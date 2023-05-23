<?php

class prof
{
        private $IDPROF;
        private $INSTRUMENT;
        private $SALAIRE;

        /**
         * Get the value of SALAIRE
         */
        public function getSALAIRE() {
                return $this->SALAIRE;
        }

        /**
         * Set the value of SALAIRE
         */
        public function setSALAIRE($SALAIRE): self {
                $this->SALAIRE = $SALAIRE;
                return $this;
        }

        /**
         * Get the value of INSTRUMENT
         */
        public function getINSTRUMENT() {
                return $this->INSTRUMENT;
        }

        /**
         * Set the value of INSTRUMENT
         */
        public function setINSTRUMENT($INSTRUMENT): self {
                $this->INSTRUMENT = $INSTRUMENT;
                return $this;
        }

        /**
         * Get the value of IDPROF
         */
        public function getIDPROF() {
                return $this->IDPROF;
        }

        /**
         * Set the value of IDPROF
         */
        public function setIDPROF($IDPROF): self {
                $this->IDPROF = $IDPROF;
                return $this;
        }
}

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
        public $IDELEVE;
        public $NIVEAU;
        public $BOURSE;
        public $IDPROF;
        public $INSTRUMENT;
        public $SALAIRE;

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

                /**
         * Get the value of INSTRUMENT
         */
        public function getINSTRUMENT() {
                return $this->INSTRUMENT;
        }

        /**
         * Set the value of INSTRUMENT
         */
        public function setINSTRUMENT($INSTRUMENT): self {
                $this->INSTRUMENT = $INSTRUMENT;
                return $this;
        }

        /**
         * Get the value of SALAIRE
         */
        public function getSALAIRE() {
                return $this->SALAIRE;
        }

        /**
         * Set the value of SALAIRE
         */
        public function setSALAIRE($SALAIRE): self {
                $this->SALAIRE = $SALAIRE;
                return $this;
        }

        public static function affichereleve()
        {
                $req = MonPdo::getInstance()->prepare("SELECT * FROM personne INNER JOIN eleve ON ID = IDELEVE;");
                $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'personne');
                $req->execute();
                $lesResultats = $req->fetchAll();
                return $lesResultats;
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
                $req = $pdo->prepare("delete from eleve where IDELEVE = :id");
                $req->bindParam(':id', $id);
                $req->execute();
                
                $req = $pdo->prepare("delete from personne where ID = :id");
                $req->bindParam(':id', $id);
                $req->execute();
        }

        public static function supprimerprof($id)
        {
                $pdo = MonPdo::getInstance();
                $req = $pdo->prepare("delete from prof where IDPROF = :id");
                $req->bindParam(':id', $id);
                $req->execute();
                
                $req = $pdo->prepare("delete from personne where ID = :id");
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
                $req = MonPdo::getInstance()->prepare("update personne set NOM=:nom, PRENOM=:prenom, MAIL=:mail, TEL=:tel WHERE ID=:id");
                $req->bindValue(':id', $personne->getID(), PDO::PARAM_INT);
                $req->bindValue(':nom', $personne->getNOM(), PDO::PARAM_STR);
                $req->bindValue(':prenom', $personne->getPRENOM(), PDO::PARAM_STR);
                $req->bindValue(':mail', $personne->getMAIL(), PDO::PARAM_STR);
                $req->bindValue(':tel', $personne->getTEL(), PDO::PARAM_INT);                
                $req->execute();
        }


}
?>
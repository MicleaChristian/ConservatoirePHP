<?php

class prof
{
        private $IDPROF;
        private $INSTRUMENT;
        private $SALAIRE;

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

        public static function afficherTous()
        {
                $req = MonPdo::getInstance()->prepare("select * from prof");
                $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'prof');
                $req->execute();
                $lesResultats = $req->fetchAll();
                return $lesResultats;
        }

        public static function getById($id)
        {
            $req = MonPdo::getInstance()->prepare("SELECT p.*, pr.INSTRUMENT FROM personne p LEFT JOIN prof pr ON p.ID = pr.IDPROF WHERE p.ID = :id");
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->execute();
            $result = $req->fetchAll(PDO::FETCH_ASSOC);

            $personne = null;
            if ($result) {
                $row = $result[0];
                $personne = new personne($row['ID'], $row['NOM'], $row['PRENOM'], $row['ADRESSE']);
                $personne->setINSTRUMENT($row['INSTRUMENT']);
            }

            return $personne;
        }

        public static function getAll()
        {
            $pdo = MonPdo::getInstance();
            $query = "SELECT idprof, nom FROM prof JOIN personne ON prof.idprof = personne.id";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }



}

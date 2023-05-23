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

}
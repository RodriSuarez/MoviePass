<?php 
    namespace Models;

    class CreditCard
    {
        private $idCreditCard;
        private $company;
        private $number;
        private $propietary; //name
        private $expiration;

        public function setIdCreditCard($idCreditCard){$this->idCredtiCard=$idCreditCard;}
        public function getIdCreditCard(){return $this->idCreditCard;}
        public function setCompany($company){$this->company=$company;}
        public function getCompany(){return $this->company;}
        public function setNumber($number){$this->number=$number;}
        public function getNumber(){return $this->number;}
        public function setPropietary($propietary){$this->propietary=$propietary;}
        public function getPropietary(){return $this->propietary;}
        public function setExpiration($expiration){$this->expiration=$expiration;}
        public function getExpiration(){return $this->expiration;}
    }

?>
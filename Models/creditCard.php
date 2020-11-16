<?php 
    namespace Models;
    use Models\User as User;
    class CreditCard
    {
        private $company;
        private $number;
        private $propietary; //name
        private $expiration;
        private $user;
        private $id_card;

    /**
     * Class Constructor
     * @param    $company   
     * @param    $number   
     * @param    $propietary   
     * @param    $expiration   
     * @param    $user   
     */
    public function __construct($id_card= '',$company='', $number='', $propietary='', $expiration='', $user=null)
    {
        $this->id_card=$id_card;
        $this->company = $company;
        $this->number = $number;
        $this->propietary = $propietary;
        $this->expiration = $expiration;
        $this->user = $user;
    }



        public function setCompany($company){$this->company=$company;}
        public function getCompany(){return $this->company;}
        public function setNumber($number){$this->number=$number;}
        public function getNumber(){return $this->number;}
        public function setPropietary($propietary){$this->propietary=$propietary;}
        public function getPropietary(){return $this->propietary;}
        public function setExpiration($expiration){$this->expiration=$expiration;}
        public function getExpiration(){return $this->expiration;}
    
 
    public function getUser()
    {
        return $this->user;
    }

  
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdCard()
    {
        return $this->id_card;
    }

    /**
     * @param mixed $id_card
     *
     * @return self
     */
    public function setIdCard($id_card)
    {
        $this->id_card = $id_card;

        return $this;
    }
}


?>
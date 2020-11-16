<?php 
    namespace Models;

    use Models\CreditCard as creditCard;

    class CreditPayment
    {
        private $idCardPayment;
        private $total;
        private $credit_card;
        private $date;
        private $id_card;


 
    public function __construct($idCardPayment='', $total='', $credit_card='', $date='', $id_card='')
    {
        $this->idCardPayment = $idCardPayment;
        $this->total = $total;
        $this->credit_card = $credit_card;
        $this->date = $date;
        $this->id_card = $id_card;
    }

    

        public function setIdCardPayment($idCardPayment){$this->idCredtiCard=$idCardPayment;}
        public function getIdCardPayment(){return $this->idCardPayment;}
        public function setTotal($total){$this->total=$total;}
        public function getTotal(){return $this->total;}
        public function setCreditCard($credit_card){$this->credit_card=$credit_card;}
        public function getCreditCard(){return $this->credit_card;}
        public function setDate($date){$this->date=$date;}
        public function getDate(){return $this->date;}
        
    
  
    public function getIdCard()
    {
        return $this->id_card;
    }

  
    public function setIdCard($id_card)
    {
        $this->id_card = $id_card;

        return $this;
    }
}
?>
<?php 
    
    namespace Models;

    use Models\CreditCard as creditCard;

class CreditPayment{

    private $idCardPayment;
    private $total;
    private $credit_card;
    private $date;

    public function construct__()
    {
        $this->credit_card = new creditCard();
    }

    public function setIdCardPayment($idCardPayment){$this->idCredtiCard=$idCardPayment;}
    public function getIdCardPayment(){return $this->idCardPayment;}
    public function setTotal($total){$this->total=$total;}
    public function getTotal(){return $this->total;}
    public function setCreditCard($credit_card){$this->credit_card=$credit_card;}
    public function getCreditCard(){return $this->credit_card;}
    public function setDate($date){$this->date=$date;}
    public function getDate(){return $this->date;}
}

?>

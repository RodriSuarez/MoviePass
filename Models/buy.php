<?php
    namespace Models;


    class Buy{

        private $id_buy;
        private $user;
        private $cant_tickets;
        private $date;
        private $total;
        private $discount;


    public function __construct($id_buy, $user, $cant_tickets, $date, $total, $discount)
    {
        $this->id_buy = $id_buy;
        $this->user = $user;
        $this->cant_tickets = $cant_tickets;
        $this->date = $date;
        $this->total = $total;
        $this->discount = $discount;
    }

    

        /**
         * Get the value of discount
         */ 
        public function getDiscount()
        {
                return $this->discount;
        }

        /**
         * Set the value of discount
         *
         * @return  self
         */ 
        public function setDiscount($discount)
        {
                $this->discount = $discount;

                return $this;
        }

        /**
         * Get the value of total
         */ 
        public function getTotal()
        {
                return $this->total;
        }

        /**
         * Set the value of total
         *
         * @return  self
         */ 
        public function setTotal($total)
        {
                $this->total = $total;

                return $this;
        }

        /**
         * Get the value of date
         */ 
        public function getDate()
        {
                return $this->date;
        }

        /**
         * Set the value of date
         *
         * @return  self
         */ 
        public function setDate($date)
        {
                $this->date = $date;

                return $this;
        }

        /**
         * Get the value of cant_tickets
         */ 
        public function getCant_tickets()
        {
                return $this->cant_tickets;
        }

        /**
         * Set the value of cant_tickets
         *
         * @return  self
         */ 
        public function setCant_tickets($cant_tickets)
        {
                $this->cant_tickets = $cant_tickets;

                return $this;
        }
    
    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     *
     * @return self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdBuy()
    {
        return $this->id_buy;
    }

    /**
     * @param mixed $id_buy
     *
     * @return self
     */
    public function setIdBuy($id_buy)
    {
        $this->id_buy = $id_buy;

        return $this;
    }
}



?>
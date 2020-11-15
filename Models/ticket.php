<?php


    namespace Models;

    class Ticket{


        private $id_ticket;
        private $show_cinema;
        private $qr;
        private $number_ticket;


    public function __construct($id_ticket, $show_cinema, $qr, $number_ticket)
    {
        $this->id_ticket = $id_ticket;
        $this->show_cinema = $show_cinema;
        $this->qr = $qr;
        $this->number_ticket = $number_ticket;
    }
        
       
        
        /**
         * Get the value of qr
         */ 
        public function getQr()
        {
                return $this->qr;
        }

        /**
         * Set the value of qr
         *
         * @return  self
         */ 
        public function setQr($qr)
        {
                $this->qr = $qr;

                return $this;
        }

        /**
         * Get the value of id_ticket
         */ 
        public function getId_ticket()
        {
                return $this->id_ticket;
        }

        /**
         * Set the value of id_ticket
         *
         * @return  self
         */ 
        public function setId_ticket($id_ticket)
        {
                $this->id_ticket = $id_ticket;

                return $this;
        }

        /**
         * Get the value of show_cinema
         */ 
        public function getShow_cinema()
        {
                return $this->show_cinema;
        }

        /**
         * Set the value of show_cinema
         *
         * @return  self
         */ 
        public function setShow_cinema($show_cinema)
        {
                $this->show_cinema = $show_cinema;

                return $this;
        }
    
    /**
     * @return mixed
     */
    public function getNumberTicket()
    {
        return $this->number_ticket;
    }

    /**
     * @param mixed $number_ticket
     *
     * @return self
     */
    public function setNumberTicket($number_ticket)
    {
        $this->number_ticket = $number_ticket;

        return $this;
    }
}






?>
<?php


    namespace Models;

    class Ticket{


        private $id_ticket;
        private $show_cinema;
        private $qr;
        private $ticket_number;
        private $show;
        private $user;
                
        public function __construct($id_ticket='', $show_cinema = '', $qr='', $ticket_number = '', $show = ''){

            $this->id_ticket = $id_ticket;
            $this->ticket_number = $ticket_number;
            $this->show_cinema = $show_cinema;
            $this->qr= $qr;
            $this->show= $show;

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
        public function getShowCinema()
        {
                return $this->show_cinema;
        }

        /**
         * Set the value of show_cinema
         *
         * @return  self
         */ 
        public function setShowCinema($show_cinema)
        {
                $this->show_cinema = $show_cinema;

                return $this;
        }

        /**
         * Get the value of ticket_number
         */ 
        public function getTicketNumber()
        {
                return $this->ticket_number;
        }

        /**
         * Set the value of ticket_number
         *
         * @return  self
         */ 
        public function setTicketNumber($ticket_number)
        {
                $this->ticket_number = $ticket_number;

                return $this;
        }
    }






?>
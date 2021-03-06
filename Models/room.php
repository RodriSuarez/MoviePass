<?php
    namespace Models;

    class room {
        private $id_room;
        private $room_name;
        private $price;
        private $room_capacity;
        private $cinema;
        //private $showCinema;

        public function __construct($id_room='', $room_name='', $price='', $room_capacity='', $cinema='')
        {
            $this->id_room = $id_room;
            $this->room_name = $room_name;
            $this->price = $price; 
            $this->room_capacity = $room_capacity; 
            $this->cinema = $cinema;
        }

        public function getIdRoom()
        {
            return $this->id_room;
        }
    
        public function setIdRoom($id_room)
        {
            $this->id_room = $id_room;
        }

        public function getRoomName()
        {
            return $this->room_name;
        }
    
        public function setRoomName($room_name)
        {
            $this->room_name = $room_name;
        }

        public function getPrice()
        {
            return $this->price;
        }

        public function setPrice($price)
        {
            $this->price = $price;
        }
 
        public function getRoomCapacity()
        {
            return $this->room_capacity;
        }

        public function setRoomCapacity($room_capacity)
        {
            $this->room_capacity = $room_capacity;
        }

      

        /**
         * Get the value of cinema
         */ 
        public function getCinema()
        {
                return $this->cinema;
        }

        /**
         * Set the value of cinema
         *
         * @return  self
         */ 
        public function setCinema($cinema)
        {
                $this->cinema = $cinema;

                return $this;
        }
}


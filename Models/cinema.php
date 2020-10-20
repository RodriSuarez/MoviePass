<?php
    namespace Models;


    class Cinema{

        private $cinema_name;
        private $address;
        private $capacity;
        private $id;
        private $room;
        
        public function __construct($name='', $address='', $capacity='',  $room='', $id=''){
            $this->name = $name;
            $this->address = $address;
            $this->capacity = $capacity;
            $this->id = $id;
            $this->room= $room;
            if(empty($id)){
                $this->id = getdate()['0'];
            }
        }

        public function getCinemaName()
    {
        return $this->cinema_name;
    }

    public function setCinemaName($cinema_name)
    {
        $this->cinema_name = $cinema_name;

        
    }
        
        public function setAddress($address){
            $this->address = $address;
        }

        public function getAddress(){
            return $this->address;
        }

        public function setCapacity($capacity){
            $this->capacity = $capacity;
        }
        public function getCapacity(){
            return $this->capacity;
        }

    /*    public function setPriceTicket($priceTicket){
            $this->priceTicket = $priceTicket;
        }
        public function getPriceTicket(){
            return $this->priceTicket;
        }

*/
        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;
        }
 
    public function getRoom()
    {
        return $this->room;
    }

 
    public function setRoom($room)
    {
        $this->room = $room;

        
    }

   
}

?>
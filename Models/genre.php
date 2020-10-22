<?php
    namespace Models;
    
    class Genre{

        private $name;
        private $id;
        private $api_id;

        public function __construct($name='', $id='', $api_id=''){

            $this->name = $name;
            $this->id = $id;
            $this->api_id = $api_id;
        }
        
        public function setName($name){
            $this->name = $name;

        }

        public function getName(){
            return $this->name;
        }

        public function setId($id){
            $this->id = $id;

        }

        public function getId(){
            return $this->id;
        }
   

        /**
         * Get the value of api_id
         */ 
        public function getApi_id()
        {
                return $this->api_id;
        }

        /**
         * Set the value of api_id
         *
         * @return  self
         */ 
        public function setApi_id($api_id)
        {
                $this->api_id = $api_id;

                return $this;
        }
    }
?>
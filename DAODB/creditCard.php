<?php
     namespace DAODB;

     use Models\CreditCard as CreditCard;

     use \Exception as Exception;  
     use DAODB\Connection as Connection;


     
    class CreditCard{
        
        private $connection;
        private $tableName = "credit_cards";
        function __construct(){}


        public function Add(CreditCard $creditCard){

            $query = "INSERT INTO creditcards (company, number_card, propietary, expiration)
                            VALUES (:company, :number, :propietary, :expiration)";
            
            $parameters['company']=$creditCard->getCompany();
            $parameters['number_card']=$creditCard->getNumber();
            $parameters['propietary']=$creditCard->getPropietary();
            $parameters['expiration']=$creditCard->getExpiration(); 
    
            try{
                $this->connection = Connection::getInstance();
                $this->connection->executeNonQuery($query, $parameters);
            }
            catch(PDOException $ex){
                throw $ex;
            }
        }
        
        //retorna todas las tarjetas de credito creadas hasta el momento
        public function getAll(){

            $cardList = array();
    
            $query = "SELECT * FROM ".$this->tableName;
    
            try{
            
                $this->connection = Connection::getInstance();
        
                $resulSet = $this->connection->execute($query);
                
                if($resulSet){
                    foreach($resulSet as $row){

                        $creditCard = new CreditCard();

                        $creditCard->setNumber($row["number_card"]);
                        $creditCard->setCompany($row["company"]);
                        $creditCard->setPropietary($row["propietary"]);
                        $creditCard->setExpiration($row["expiration"]);
                        
                        array_push($cardList, $creditCard);
                    }
                    return $cardList;   
                }
                else{
                    return null;
                }
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }  
        }


        //retorna la tarjeta de credito buscada segun numero y compañia
        public function searchCreditCard($number_card, $company){


            $query = "SELECT * FROM " . $this->tableName();. " WHERE number_card = " . $numberCard . " AND company = " . $company . ";";
               
            $parameters["number_card"] = $number_card ;
            $parameters["company"] = $company ;
            
            try{   
                
                $this->connection = Connection::getInstance();
    
                $resultSet = $this->connection->execute($query, $parameters);
                
            }
            catch(PDOException $ex)
            {
                throw $ex;
            }
    
            if(!empty($resultSet)){

                $row = $resultSet['0'];

                $creditCard = new CreditCard();

                $creditCard->setNumber($row["number_card"]);
                $creditCard->setCompany($row["company"]);
                $creditCard->setPropietary($row["propietary"]);
                $creditCard->setExpiration($row["expiration"]);
        
                return $creditCard;

            }else{
                return null;
            }
        }



    }
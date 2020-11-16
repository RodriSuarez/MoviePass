<?php
     namespace DAODB;

     use Models\CreditCard as CreditCard;

     use \Exception as Exception;  
     use DAODB\Connection as Connection;
     use DAODB\User as userDB;

     
    class creditCard{
        
        private $connection;
        private $tableName = "credit_cards";



        public function Add(CreditCard $creditCard, $id_user){

            $query = "INSERT INTO ".$this->tableName." (company, number_card, propietary, expiration)
                            VALUES (:company, :number_card, :propietary, :expiration)";
            
            $number_card = $creditCard->getNumber();
            $array = str_split($number_card);

            if( $array [0] == 5 )
            {
                $card = 'master';
            } 
            else if($array [0] == 4)
            {
                $card = 'visa';
            }
            else 
            {
                $card = 'error';
            }
            
            if($card != 'error')
            {
                $parameters['company']=$card;
                $parameters['number_card']=$creditCard->getNumber();
                $parameters['propietary']=$creditCard->getPropietary();
                $parameters['expiration']=$creditCard->getExpiration(); 
                $this->userDB->updateCardCredit($creditCard->getNumber(), $id_user);
                try{
                    $this->connection = Connection::getInstance();
                    $this->connection->executeNonQuery($query, $parameters);
                }
                catch(PDOException $ex){
                    throw $ex;
                }
            if($card == 'error')
            {
                return $card;
            }
            
        }
    }
        
        //retorna todas las tarjetas de credito creadas hasta el momento
        public function getAll(){

            $creditCardsList = array();
    
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
                        
                        array_push($creditCardsList, $creditCard);
                    }
                    return $creditCardsList;   
                }
                else{
                    return null;
                }
            }
            catch(PDOException $ex)
            {
                throw $ex;
            }  
        }


        //retorna la tarjeta de credito buscada segun numero y compañia
        public function searchCreditCard($number_card, $company){


            $query = 'SELECT * FROM ' . $this->tableName. ' WHERE number_card = "' . $numberCard . '" AND company = "' .$company . '";';
               #$query = 'SELECT * FROM ' . $this->room_table . ' WHERE id_cinema = "' . $id_Cinema . '";';
        
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
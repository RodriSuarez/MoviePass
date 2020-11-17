<?php
     namespace DAODB;

     use Models\CreditCard as CreditCardModel;

     use \Exception as Exception;  
     use DAODB\Connection as Connection;
     use DAODB\User as userDB;

     
    class CreditCard{
        
        private $connection;
        private $tableName = "credit_cards";



        public function Add(CreditCardModel $creditCard, $id_user){

            $query = "INSERT INTO ".$this->tableName." (company, number_card, propietary, expiration, id_user)
                            VALUES (:company, :number_card, :propietary, :expiration, :id_user)";
            $number_card = $creditCard->getNumber();
            $array = str_split($number_card);

            if( $array [0] == 5 )
            {
                $card = 'master';
                $status = true;
            } 
            else if($array [0] == 4)
            {
                $card = 'visa';
                $status = true;

            }
            else 
            {
                $status = false;
            }
            
            if($status)
            {
                $parameters['company']=$card;
                $parameters['number_card']=$creditCard->getNumber();
                $parameters['propietary']=$creditCard->getPropietary();
                $parameters['expiration']=$creditCard->getExpiration(); 
                $parameters['id_user'] = $id_user;
                try{
                    $this->connection = Connection::getInstance();
                    $this->connection->executeNonQuery($query, $parameters);
                }
                catch(\PDOException $ex){
                    throw $ex;
                }
            }
            
                return $status;
            
            
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

                        $creditCard = new CreditCardModel();
                        $creditCard->setIdCard($row['id_card']);
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
            catch(\PDOException $ex)
            {
                throw $ex;
            }  
        }


        //retorna la lista tarjeta de credito buscada segun usuario 
        public function GetAllByUserId($id_user){

            
            $query = 'SELECT * FROM ' . $this->tableName. ' WHERE id_user = "' .$id_user . '";';
              
        
                $cardList=array();
            
            try{   
                
                $this->connection = Connection::getInstance();
    
                $resultSet = $this->connection->execute($query);
                
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
            $userDB = new UserDB();
            
            if(!empty($resultSet)){

               foreach ($resultSet as $row) {
                    
                 

                $creditCard = new CreditCardModel();
                
                $creditCard->setIdCard($row["id_card"]);
                $creditCard->setNumber($row["number_card"]);
                $creditCard->setCompany($row["company"]);
                $creditCard->setPropietary($row["propietary"]);
                $creditCard->setExpiration($row["expiration"]);
                $creditCard->setUser($userDB->GetOneById($row["id_user"]));
                array_push($cardList, $creditCard);    
                }
                return $cardList;

            }else{
                return null;
            }
        }

        public function GetById($id_card){

            
            $query = 'SELECT * FROM ' . $this->tableName. ' WHERE id_card =  :id_card;';
              
                $parameters['id_card'] = $id_card;
                $cardList=array();
            
            try{   
                
                $this->connection = Connection::getInstance();
    
                $resultSet = $this->connection->execute($query, $parameters);
                
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
            $userDB = new UserDB();
            
            if(!empty($resultSet)){

               foreach ($resultSet as $row) {
                    
                 

                $creditCard = new CreditCardModel();
                
                $creditCard->setIdCard($row["id_card"]);
                $creditCard->setNumber($row["number_card"]);
                $creditCard->setCompany($row["company"]);
                $creditCard->setPropietary($row["propietary"]);
                $creditCard->setExpiration($row["expiration"]);
                $creditCard->setUser($userDB->GetOneById($row["id_user"]));
                array_push($cardList, $creditCard);    
                }
                return $cardList;

            }else{
                return null;
            }
        }

    }
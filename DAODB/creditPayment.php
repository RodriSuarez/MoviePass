<?php
     namespace DAODB;

     use Models\CreditCard as CreditCard;
     use Models\CreditPayment as CreditPayment;


     use \Exception as Exception;  
     use DAODB\Connection as Connection;

     class CreditPayment
     {
        private $connection;
        private $tableName = "cards_payments";
      


        public function Add(CreditPayment $credit_payment){

            $query = "INSERT INTO ".$this->tableName." (number_card, company, date_payment, total)
                            VALUES (:number_card, :company, :date_payment, :total)";
            
            $parameters['company']=$credit_payment->getCreditCard()->getCompany();
            $parameters['number_card']=$credit_payment->getCreditCard()->getNumber();
            $parameters['date_payment']=$credit_payment->getDate();
            $parameters['total']=$credit_payment->getTotal(); 
    
            try{
                $this->connection = Connection::getInstance();
                $this->connection->executeNonQuery($query, $parameters);
            }
            catch(PDOException $ex){
                throw $ex;
            }
        }

                
        //retorna todos pagos realizados hasta el momento
        public function getAll(){

            $creditsPaymentsList = array();
    
            $query = "SELECT * FROM ".$this->tableName;
    
            try{
            
                $this->connection = Connection::getInstance();
        
                $resulSet = $this->connection->execute($query);
                
                if($resulSet){
                    foreach($resulSet as $row){

                        $CreditPayment = new CreditPayment();

                        $CreditPayment->setIdCardPayment($row["id_cards_payments"]);
                        $CreditPayment->setTotal($row["total"]);
                        $CreditPayment->setDate($row["date_payment"]);
                        
                        array_push($creditsPaymentsList, $CreditPayment);
                    }
                    return $creditsPaymentsList;   
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

        //retorna el pago buscado segun fecha compañia y numero de la tarjeta
        public function search($number_card,$company,$date){

                $query = "SELECT * FROM " . $this->tableName();. " WHERE number_card = " . $numberCard . " AND company = " . $company . "  AND date_payment = " . $company . ";";
                $parameters["number_card"]= $number_card;
                $parameters["company"]=$company;
                $parameters["date_payment"]=$date;

                try
                {
                    $this->connection = Connection::getInstance();

                    $results = $this->connection->execute($query,$parameters);

                }
                catch(PDOException $ex)
                {
                    throw $ex;
                }

                if(!empty($results)){
                    $CreditPayment = new CreditPayment();

                    $CreditPayment->setIdCardPayment($row["id_cards_payments"]);
                    $CreditPayment->setTotal($row["total"]);
                    $CreditPayment->setDate($row["date_payment"]);
                    
                    return $CreditPayment;
                }else{
                    return null;
                }  
        }



    }

?>
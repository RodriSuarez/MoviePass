<?php
     namespace DAODB;

    use \Exception as Exception;  
    use DAODB\Connection as Connection;
    use DAODB\room as roomDB;
    use DAODB\ticket as ticketDB;
    use DAODB\user as userDB;
    use Models\Room as RoomModel;
    use Models\Cinema as CinemaModel;
    use Models\showCinema as sCinemaModel;
    use Models\buy as BuyModel;
    use Models\user as UserModel;
    USE Models\ticket as TicketModel;
 

    class Buy
    {
    	private $connection;
    	private $tableBuy= "buy";
        private $tableTicket = "ticket";


        public function Add(BuyModel $buy)
        {
             
                    $query = "INSERT INTO ".$this->tableBuy." (fecha, cant_tickets, total)
                    VALUES (:fecha, :cant_tickets, :total);";
      
                    var_dump($buy);
                    $parameters["fecha"] = $buy->getDate();
                    $parameters["cant_tickets"] = $buy->getCant_tickets();
                    $parameters["total"] = $buy->getTotal();

                    try
                    {
                    $this->connection = Connection::GetInstance();

                    $this->connection->ExecuteNonQuery($query, $parameters);
               
                    }catch(Exception $ex)
                    {
                    throw $ex;
                    
                             
                
                    }
           

           return true;
        }

        public function getLastId(){
            $this->connection = Connection::GetInstance();
            return $this->connection->getLastId();
        }
  /* public function getAllBuys()
    {

        $buyList= array();
         $query = 'SELECT * FROM ' . $this->tableBuy . ';';
            try
                {
                $this->connection = Connection::GetInstance();

             
                $result = $this->connection->Execute($query);
                
                foreach ($result as $row) {
                    $userDB= new userDB();
                    $ticketDB = new ticketDB();
                    $buy= new BuyModel();
                    $buy->setIdBuy($row["id_buy"]);
                    $buy->setUser($this->userDB->GetUserById($row["id_user"]));
                    $buy->setCant_tickets($this->ticketDB->($row["id_ticket"]));
                    $buy->setDate($row["buy_date"]);
                    $buy->setTotal($row["total"]);
                    array_push($buyList, $buy);
                    
                }

            return $buyList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }*/


/*public function GetOneByIdUser()
{
  $query = "SELECT * FROM " . $this->tableTicket . " WHERE id_user = " . $id_user .";";
    try
     {

                $this->connection = Connection::GetInstance();
                $ticket = $this->connection->Execute($query);
                if($ticket)
                {

                    $this->GetOneById($ticket->)

                }
                


        }



}*/

 public function GetOneById($id_buy){
            
                $query = "SELECT * FROM " . $this->tableBuy . " WHERE id_buy = " . $id_buy .";";
try{
                $this->connection = Connection::GetInstance();
  
                $obj = $this->connection->Execute($query);
                
                $buy= null;
                    if($obj)
                    {
                    $buy= new BuyModel();
                    $buy->setIdBuy($row["id_buy"]);
                    $buy->setCant_tickets(($row["cant_tickets"]));
                    $buy->setDate($row["buy_date"]);
                    $buy->setTotal($row["total"]);

                    return $buy;
                }
              }
            catch(Exception $ex)
            {
                throw $ex;
            }
        
        }
       /* public function TicketsBuys($BuyList, $id_show_cinema)
        {       

             $buy = new BuyModel();
            $totalTickets= null;
            if($BuyList){
              
            }
            return $totalTickets;




        }*/
     
    }
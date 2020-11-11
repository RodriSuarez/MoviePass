<?php
     namespace DAODB;

    use \Exception as Exception;  
    use DAODB\Connection as Connection;
    use DAODB\room as roomDB;
    
    use Models\Room as RoomModel;
    use Models\Cinema as CinemaModel;
    use Models\showCinema as sCinemaModel;
    use Models\buy as BuyModel;
    use Models\user as UserModel;
    USE Models\ticket as TicketModel;
    use Controllers\userController as uControl;
    use Controllers\ticketController as tControl;

    class Buy
    {
    	private $connection;
    	private $tableBuy= "buy";


    public function getAllBuys()
    {

        $BuyList= array();
         $query = "SELECT * FROM " . $this->tableBuy . ";";
                $this->connection = Connection::GetInstance();

            try
                {  
                $result = $this->connection->Execute($query);
                
                foreach ($result as $row) {
               

                    $buy= new BuyModel();
                    $buy->setIdBuy($row["id_buy"]);
                    $buy->setUser($this->uControl->UserById($row["id_user"]));
                    $buy->setCant_tickets($this->tControl->TicketsById($row["id_ticket"]));
                    $buy->setDate($row["buy_date"]);
                    $buy->setTotal($row["total"]);
                    array_push($BuyList, $buy);
                    
                }

            return $BuyList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

  public function getBuy($id_buy, $id_ticket, $id_user){
            
                $query = "SELECT * FROM " . $this->tableBuy . " WHERE id_buy = " . $id_buy ." AND id_ticket = '" .$id_ticket ."' AND id_user = " .$id_user .";";

                $this->connection = Connection::GetInstance();

            try
                {  
                $obj = $this->connection->Execute($query);
                
                $buy= null;
                     if($obj)

       /* private $id_buy;
        private $user;
        private $cant_tickets;
        private $date;
        private $total;
        #private $discount;*/

                {
                    $row=$obj[0];

                    $buy= new BuyModel();
                    $buy->setIdBuy($row["id_buy"]);
                    $buy->setUser($this->uControl->UserById($row["id_user"]));
                    $buy->setCant_tickets($this->tControl->TicketsById($row["id_ticket"]));
                    $buy->setDate($row["buy_date"]);
                    $buy->setTotal($row["total"]);

                    return $buy;
                }
                else
                {
                return $resultSet;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        
        }
        public function TicketsBuys($BuyList, $id_show_cinema)
        {       

             $buy = new BuyModel();
            $totalTickets= null;
            if($BuyList){
              
            }
            return $totalTickets;




        }
     
    }
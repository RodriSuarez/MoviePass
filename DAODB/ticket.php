<?php
     namespace DAODB;

    use \Exception as Exception;  
    use DAODB\Connection as Connection;
    use DAODB\room as roomDB;
    use DAODB\cinema as cinemaDB;
    use DAOBD\showCinema as showCinemaDB;
    use Models\Room as RoomModel;
    use Models\Cinema as CinemaModel;
    use Models\showCinema as sCinemaModel;
    use Models\ticket as TicketModel;
    use DAOBD\User as UserDB;
    use DAOBD\Buy as BuyDB;


    class ticket
    {
    	private $connection;
    	private $tableTicket= "ticket";
        private $tableRooms = "room";   

        public function Add(TicketModel $ticket)
        {
             
                    $query = "INSERT INTO ".$this->tableName." (id_buy, id_show_cinema, id_user, ticket_number, qr)
                    VALUES (:id_buy, :id_show_cinema, :id_user, :ticket_number, :qr);";
         
            
                    $parameters["id_buy"] = $ticket->getBuy->getIdBuy();
                    $parameters["id_show_cinema"] = $ticket->getShow()->getId();
                    $parameters["id_user"] = $ticket->getUser()->getId();
                    $parameters["ticket_number"] = $ticket->getNumberTicket();
                    $parameters["qr"] = $ticket->getQr();

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


        public function GetTicketByMovie($id_show_cinema)
        {
            
            $query = 'SELECT * FROM '.$this->tableTicket .' WHERE id_show_cinema = "'.$id_show_cinema.'";';

            try{    
                $this->connection = Connection::GetInstance();
                $obj = $this->connection->Execute($query);
            }catch(\PDOException $error){
                throw $error;
            }                
                $ticketList = array();
                 if($obj){
                
                    $userDB = new User();
                    $ticketList =  array_map(function($ticket){
                    return new TicketModel($ticket['id_ticket'], $ticket['id_show_cinema'], $ticket['qr'], $ticket['number_ticket'], $userDB->GetOneById($ticket['id_user']), $buyDB->GetOneById($ticket['id_buy']));
                    }, $obj);
                } 
                     return $ticketList;
        }



     public function GetTicketsByUser($id_user)
        {
            
            $query = 'SELECT * FROM '.$this->tableTicket .' WHERE id_user = "'.$id_user.'";';

            try{    
                $this->connection = Connection::GetInstance();
                $obj = $this->connection->Execute($query);
            }catch(\PDOException $error){
                throw $error;
            }                
                $ticketList = array();
                 if($obj){
                
                    $userDB = new User();
                    $ticketList =  array_map(function($ticket){
                    return new TicketModel($ticket['id_ticket'], $ticket['id_show_cinema'], $ticket['qr'], $ticket['number_ticket'], $userDB->GetOneById($ticket['id_user']), $buyDB->GetOneById($ticket['id_buy']));
                    }, $obj);
                } 
                     return $ticketList;
        }
    

    public function GetTicketsById($id_ticket)
    {

        $query = 'SELECT * FROM '.$this->tableTicket.' WHERE id_cinema '.$id_ticket.';';
        try
        {
           $ticketList = array();

               /*$this->id_ticket = $id_ticket;
            $this->show_cinema = $show_cinema;
            $this->qr= $qr;*/


                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $ticket = new TicketModel($row['id_ticket'], $row['id_show_cinema'], $row['qr'], $row['number_ticket'], $row['id_buy']);
           
                
                    array_push($ticketList, $ticket);
                }

                return $ticketList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

}
        
public function GetTicketsByIdBuy($id_buy)
    {

        $query = 'SELECT * FROM '.$this->tableTicket.' WHERE id_buy '.$id_buy.';';
        try
        {
           $ticketList = array();



                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                $userdb = new UserDB();

                foreach ($resultSet as $row)
                {
                    $ticket = new TicketModel($row['id_ticket'], $row['id_show_cinema'], $row['qr'], $row['number_ticket'], $userDB->getOneById($row['id_user']),);


                    array_push($ticketList, $ticket);
                }

                return $ticketList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }


    }

       /* public function GetTicketByCinema($id_cinema)
        {

            $query = 'SELECT * FROM '.$this->tableRoom.'WHERE id_cinema="'.$id_cinema.'";';
            try
            {
            $roomList= $this->connection->Execute($query);
            $cinemaDb= new cinemaDB();
            $showCinemaDb = new showCinemaDB();
            $showCinema = new showCinemaModel();
            $cant = $cinemaDb->getCapacityCinema($roomList);
            foreach ($roomList as $row ) {
                $showList=$showCinemaDb->GetByRoom($row['id_room']);
                    foreach($showList as $showCinema ){
                        $cantS = $cantS + $showCinema->getRemaining_tickets();
                    }
            }
             $totalVendidas = $cant-$cantS
             return $totalVendidas;
            }
            catch (Exception $ex)
            {
                throw $ex;
            }


            }
*/
        

    
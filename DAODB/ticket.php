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



    class ticket
    {
    	private $connection;
    	private $tableTicket= "ticket";
        private $tableRooms = "room";   


   public function GetTicketByMovie($id_show_cinema)
        {
            
                     $query = 'SELECT * FROM '.$this->tableTicket .' WHERE id_show_cinema = "'.$id_show_cinema.'";';
            try{
                    $obj = $this->connection->Execute($query);
                    
                    $ticketList = array();
                     if($obj){
                        $ticket = $obj['0'];

                      $ticketList =  array_map(function($ticket){
                            return new TicketModel($ticket['id_ticket'], $ticket['id_show_cinema'], $ticket['number_ticket']);
                        }, $obj);
                     
                       return $ticketList;
                     }



        }
    }

    public function GetTicketById($id_ticket)
    {

        $query = 'SELECT*FROM'.$this->tableTicket.'WHERE id_cinema"'.$id_ticket.'";';
        try
        {
           $ticketList = array();

               /*$this->id_ticket = $id_ticket;
            $this->show_cinema = $show_cinema;
            $this->qr= $qr;*/


                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                $showCinemaDB = new showCinemaDB();

                foreach ($resultSet as $row)
                {                
                    $ticket = new ticketModel();
                    $ticket->setId_ticket($row["id_ticket"]);
                    $ticket->setShow_cinema($showCinemaDb->GetOneById($row["id_show_cinema"]));
                    $ticket->setRoomCapacity($row["room_capacity"]);
                
                    array_push($roomList, $room);
                }

                return $roomList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }


        }



    }

        public function GetTicketByCinema($id_cinema)
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

        

    }
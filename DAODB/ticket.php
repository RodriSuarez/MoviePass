<?php
     namespace DAODB;

    use \Exception as Exception;  
    use DAODB\Connection as Connection;
    use DAODB\room as roomDB;

    use Models\Room as RoomModel;
    use Models\Cinema as CinemaModel;
    use Models\showCinema as sCinemaModel;
    use Models\ticket as TicketModel;



    class ticket
    {
    	private $connection;
    	private $tableTicket= "ticket";



   public function GetTicketByMovie($id_show_cinema)
        {
            
                     $query = 'SELECT * FROM '.$this->tableTicket .' WHERE id_show_cinema = "'.$id_show_cinema.'";';
            
                    $obj = $this->connection->Execute($query);
                    try{
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
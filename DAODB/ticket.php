<?php

namespace DAODB;

use \Exception as Exception;  
use DAODB\Connection as Connection;
use Models\Ticket as TicketModel;

class Ticket
    {        
        private $connection;
        private $tableName = "ticket";
      // private $movieTableName = "movie";
 
/*id_ticket INT AUTO_INCREMENT NOT NULL,
id_show_cinema INT NOT NULL,
id_user INT NOT NULL,
ticket_number INT NOT NULL,
qr TEXT,*/
        public function Add(TicketModel $ticket)
        {
             
                    $query = "INSERT INTO ".$this->tableName." (id_show_cinema, id_user, ticket_number, qr)
                    VALUES (:id_show_cinema, :id_user, :ticket_number, :qr);";
                    
            
                    
                    $parameters["id_show_cinema"] = $ticket->getShow()->getId();
                    $parameters["id_user"] = $ticket->getUser()->getId();
                    $parameters["ticket_number"] = $ticket->getTicketNumber();
                    $parameters["qr"] = $ticket->getQr();
                 
                    try
                    {
                    $this->connection = Connection::GetInstance();

                    $this->connection->ExecuteNonQuery($query, $parameters);
               
                             }catch(Exception $ex)
                {
                    throw $ex;
                    
                }
                }
               
                
            }
           

            return $dest;
        }

        

        
        public function GetAll()
        {
            try
            {
                $showList = array();
                $today = date_format(new DateTime('now'), "Y-m-d");
      
                $query = "SELECT * FROM ".$this->tableName . " WHERE show_time >= '" . $today ."';";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                $movieDB = new MovieDB();
                $roomDB =  new RoomDB();

                foreach ($resultSet as $row)
                {                
                    $show = new ShowModel();
                    $room = new RoomModel();
                    $show->setShowTime($row["show_time"]);
                    $show->setShowHour($row["show_hour"]);
                    $show->setId($row["id_show_cinema"]);
                    $show->setRoom($roomDB->getOne($row['id_room']));
                    $show ->setMovie($movieDB->GetOneById($row['id_movie']));
                  //  var_dump($show);
                    array_push($showList, $show);
                }

             

                return $showList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetOneById($id)
        {
            try
            {
                $showList = array();

                $query = "SELECT * FROM ".$this->tableName . " WHERE id_show_cinema = " . $id.";";
               # var_dump($id);
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

             

                $show = null;
                if($resultSet)
                {   
                    $row = $resultSet['0'];
                    $show = new ShowModel();
               
                    $show->setShowTime($row["show_time"]);
                    $show->setShowHour($row["show_hour"]);
                    $show->setId($row["id_show_cinema"]);
                    $show->setRoom($roomDB->getOne($row['id_room']));
                    $show ->setMovie($movieDB->GetOneById($row['id_movie']));
                   #var_dump($show);
                }

             

                return $show;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    
        public function DeleteOne($id_room){   
    
            try{
                $query='DELETE FROM '.$this->tableName.' WHERE id_room = "'.$id_room.'";';
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
    
        catch(Exception $ex){
            throw $ex;
            }
        }  

        public function GetByRoom($roomId)
        {
            try
            {
                $showList = array();

                $query = "SELECT * FROM ".$this->tableName . " WHERE id_room = " . $roomId . ";";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                $movieDB = new MovieDB();
                $roomDB =  new RoomDB();

            #    var_dump($movieDB);
                foreach ($resultSet as $row)
                {                
                    $show = new ShowModel();
               
                    $show->setShowTime($row["show_time"]);
                    $show->setShowHour($row["show_hour"]);
                    $show->setId($row["id_show_cinema"]);
                    $show->setRoom($roomDB->getOne($row['id_room']));
                    $movie = $movieDB->getOneById($row['id_movie']);
                    $show->setMovie($movie);

                    array_push($showList, $show);
                }

                return $showList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

      
        
    }
?>
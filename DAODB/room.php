<?php
     namespace DAODB;

    use \Exception as Exception;  
    use DAODB\Connection as Connection;
    use DAODB\Cinema as CinemaDB;
    use Models\Room as RoomModel;
    use Models\Cinema as CinemaModel;

    class Room
    {        
        private $connection;
        private $tableName = "room";
        
        /**

create table if not exists room(
                        id_room int auto_increment not null,
                        room_name varchar(50),
                        price float,
                        id_cinema int not null,
                        capacity int,
                        constraint pk_room primary key (id_room),
                        constraint fk_cinema foreign key (id_cinema) references cinema(id_cinema)
                        #constraint unq_cinema_name unique (room_name, id_cinema)
                        );
         */
        public function Add(RoomModel $room)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." ( room_name, price,  room_capacity, id_cinema)
                 VALUES ( :room_name, :price,  :room_capacity, :id_cinema);";
                
           
                
                $parameters["room_name"] = $room->getRoomName();
                $parameters["price"] = $room->getPrice();
                $parameters["room_capacity"] = $room->getRoomCapacity();
                $parameters["id_cinema"]= $room->getCinema()->getIdCinema();
       
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

            }
            catch(Exception $ex)
            {
                throw $ex;
                
            }
        }

        
        public function exist($room_name, $id_cinema){
            try
            {
                 $query = 'SELECT * FROM '.$this->tableName . ' WHERE room_name = "' . $room_name .'" and id_cinema = "'.$id_cinema.'";';

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                

                return $resultSet;

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        
        }

        
        public function GetAll()
        {
            try
            {
                $roomList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                $cinemaDB = new CinemaDB();
                foreach ($resultSet as $row)
                {                
                    $room = new RoomModel();
                    $cinema = new CinemaModel();

                    $room->setRoomName($row["room_name"]);
                    $room->setPrice($row["price"]);
                    $room->setRoomCapacity($row["room_capacity"]);
                    $room->setIdRoom($row["id_room"]);
                    $room->setCinema($cinemaDB->GetOne($row["id_cinema"]));
                    array_push($roomList, $room);
                }

                return $roomList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getByCinemaId($cinemaID){

            try
            {
                $roomList = array();

                $query = "SELECT * FROM ".$this->tableName . " WHERE id_cinema = " . $cinemaID . ";";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                $cinemaDB = new CinemaDB();

                foreach ($resultSet as $row)
                {                
                    $room = new RoomModel();
                    $cinema = new CinemaModel();
                    $room->setRoomName($row["room_name"]);
                    $room->setPrice($row["price"]);
                    $room->setRoomCapacity($row["room_capacity"]);
                    $room->setIdRoom($row["id_room"]);
                    $room->setCinema($cinemaDB->GetOne($row["id_cinema"]));
                    array_push($roomList, $room);
                }

                return $roomList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }


        }

        /* 
        public function Delete($key){
            $this->RetrieveData();
           // echo $key;
            unset($this->roomList[$key]);

            $this->SaveData();
        }
        */
        
          public function getOne($id_room){

            try
            {
                $roomList = array();

                $query = "SELECT * FROM ".$this->tableName . " WHERE id_room = " . $id_room ." ;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                $cinemaDB = new CinemaDB();
                if(!empty($resultSet)){
                    $room = new RoomModel();
                    $room->setIdRoom($resultSet['0']["id_room"]);

                    $room->setRoomName($resultSet['0']["room_name"]);
                    $room->setPrice($resultSet['0']["price"]);
                    $room->setRoomCapacity($resultSet['0']["room_capacity"]);
                    $room->setCinema($cinemaDB->GetOne($resultSet['0']["id_cinema"]));

                    return $room;

                }
                else return null;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function EditOne(RoomModel $roomModify){

            try{
                
    
    
                    $query =  ' UPDATE '.$this->tableName.' SET room_name = "' .$roomModify->getRoomName() .
                                        '", price = "' . $roomModify->getPrice().
                                        '", room_capacity = "' . $roomModify->getRoomCapacity() .
                                        '" WHERE id_room = "' . $roomModify->getIdRoom().'";';
    
                    $this->connection = Connection::GetInstance();
                   $state =  $this->connection->ExecuteNonQuery($query);
                    #var_dump($state);
                                
                
            }    
            catch(Exception $ex){
                throw $ex;
            }  
        }
    }
?>
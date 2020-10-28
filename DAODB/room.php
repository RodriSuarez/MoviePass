<?php
     namespace DAODB;

    use \Exception as Exception;  
    use DAODB\Connection as Connection;
    use Models\Room as RoomModel;

    class room
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
                $query = "INSERT INTO ".$this->tableName." (room_name, price, id_cinema, room_capacity)
                 VALUES (:room_name, :price, :id_cinema, :room_capacity);";
                
           
                
                $parameters["room_name"] = $room->getRoomName();
                $parameters["price"] = $room->getPrice();
                $parameters["room_capacity"] = $room->getRoomCapacity();
                $parameters["id_cinema"] = $room->getIdCinema();
       
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
                
                var_dump($resultSet);

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
                
                foreach ($resultSet as $row)
                {                
                    $room = new RoomModel();

                    $room->setRoomName($row["room_name"]);
                    $room->setPrice($row["price"]);
                    $room->setIdCinema($row["id_cinema"]);
                    $room->setRoomCapacity($row["room_capacity"]);

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
            
                if(!empty($resultSet)){
                    $room = new RoomModel();
                    $room->setRoomName($resultSet['0']["room_name"]);
                    $room->setPrice($resultSet['0']["price"]);
                    $room->setIdCinema($resultSet['0']["id_cinema"]);
                    $room->setRoomCapacity($resultSet['0']["room_capacity"]);

                    return $room;

                }
                else return null;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

    }
?>
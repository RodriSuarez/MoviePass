<?php

namespace DAODB;

use \Exception as Exception;

use Models\cinema as CinemaModel;
use DAODB\Connection as Connection;
use Controllers\roomController as rControl;
use DAODB\room as roomDB;
use Models\room as RoomModel;

class cinema
{
    private $connection;
    private $tableName = "cinema";
    private $room_table = "room";


    public function Add(CinemaModel $cinema)
    {
        $query = "INSERT INTO " . $this->tableName . " (cinema_name, address, capacity)
        VALUES (:cinema_name, :address, :capacity);";
        
        
        
        $parameters["cinema_name"] = $cinema->getCinemaName();
        $parameters["address"] = $cinema->getAddress();
        $parameters["capacity"] = $cinema->getCapacity();
        #$parameters["rooms"]= serialize($cinema->getRooms());
        try {
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAll()
    {
        $cinemaList = array();
        
        $query = "SELECT * FROM " . $this->tableName;
        
        try {
            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $cinema = new CinemaModel();
                $cinema->setIdCinema($row["id_cinema"]);
                $cinema->setCinemaName($row["cinema_name"]);
                $cinema->setAddress($row["address"]);
                // $cinema->setCapacity($row["capacity"]);
                $cinema->setRooms($this->GetRoomCinema($row["id_cinema"]));
                $cinema->setCapacity($this->getCapacityCinema($cinema->getRooms()));
                array_push($cinemaList, $cinema);
            }

            return $cinemaList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function exist($cinema_name, $address)
    {
        
        
        $query = 'SELECT * FROM ' . $this->tableName . ' WHERE cinema_name = "' . $cinema_name . '" and address = "' . $address . '";';
        try {
        
            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);


            return $resultSet;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetOne($id_cinema)
    {
        
        $query = 'SELECT * FROM ' . $this->tableName . ' WHERE id_cinema = "' . $id_cinema . '";';
        try {
        
            $this->connection = Connection::GetInstance();

            $obj = $this->connection->Execute($query);

            $cinema = null;
            if ($obj) {
                $row = $obj[0];

                $cinema = new CinemaModel();
                $cinema->setIdCinema($row["id_cinema"]);
                $cinema->setCinemaName($row["cinema_name"]);
                $cinema->setAddress($row["address"]);
                $cinema->setCapacity($row["capacity"]);
                $cinema->setRooms($this->GetRoomCinema($row["id_cinema"]));

                return $cinema;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function EditOne($id_cinema, CinemaModel $cinemaModify)
    {

        try {

            $modify = $this->GetOne($id_cinema);
            if ($modify == null) {
            } else {

                $modifyIdCinema = $modify->getIdCinema();

                $query =  ' UPDATE ' . $this->tableName . ' SET cinema_name = "' . $cinemaModify->getCinemaName() . '", address = "' . $cinemaModify->getAddress() . '", capacity = "' . $cinemaModify->getCapacity() . '" WHERE id_cinema= "' . $modifyIdCinema . '";';

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function DeleteOne($id_cinema)
    {

        $query = 'DELETE FROM ' . $this->tableName . ' WHERE id_cinema = "' . $id_cinema . '";';
        try {
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetRoomCinema($id_Cinema)
    {

        $query = 'SELECT * FROM ' . $this->room_table . ' WHERE id_cinema = "' . $id_Cinema . '";';
        
        try {
            $obj = $this->connection->Execute($query);

            $roomList = array();
            if ($obj) {
                $room = $obj['0'];

                $roomList =  array_map(function ($room) {
                    return new RoomModel($room['id_room'], $room['room_name'], $room['price'], $room['room_capacity']);
                }, $obj);

                return $roomList;
            }
        } catch (Exception $error) {
            throw $error;
        }
    }
    public function getCapacityCinema($roomList)
    {
        $room = new room();
        $cinemaCapacity = null;
        if ($roomList) {
            foreach ($roomList as $room) {
                $roomCapacity = $room->getRoomCapacity();
                $cinemaCapacity = $cinemaCapacity + $roomCapacity;
            }
        }
        return $cinemaCapacity;
    }
}

<?php
     namespace DAODB;

    use \Exception as Exception;  
    use DAODB\Connection as Connection;
    use DAODB\Movie as MovieDB;
    use Models\ShowCinema as ShowModel;
    use Models\Movie as Movie;

    class ShowCinema
    {        
        private $connection;
        private $tableName = "show_cinema";
 

        public function Add(ShowModel $show, $idRoom)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (show_time, show_hour, id_room, id_movie)
                 VALUES (:show_time, :show_hour, :id_room, :id_movie);";
                
           
                
                $parameters["show_time"] = $show->getShowTime();
                $parameters["show_hour"] = $show->getShowHour();
                $parameters["id_room"] = $idRoom;
                $parameters["id_movie"] = $show->getMovie()->getId();
       
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

            }
            catch(Exception $ex)
            {
                throw $ex;
                
            }
        }

        
        

        //Modificar 
        public function exist($id){
            try
            {
                $query = "SELECT * FROM ".$this->tableName . " WHERE id_api_genre = " . $id .";";

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
                $showList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                $movieDB = new MovieDB();

                foreach ($resultSet as $row)
                {                
                    $show = new ShowModel();
               
                    $show->setShowTime($row["show_time"]);
                    $show->setShowHour($row["show_hour"]);
                    $show->setId($row["id_show_cinema"]);
                    $show->setIdRoom($row['id_room']);
                    $movie = $movieDB->GetOneById($row['id_movie']);
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

        public function GetByRoom($roomId)
        {
            try
            {
                $showList = array();

                $query = "SELECT * FROM ".$this->tableName . " WHERE id_room = " . $roomId . ";";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                $movieDB = new MovieDB();
                var_dump($movieDB);
                foreach ($resultSet as $row)
                {                
                    $show = new ShowModel();
               
                    $show->setShowTime($row["show_time"]);
                    $show->setShowHour($row["show_hour"]);
                    $show->setId($row["id_show_cinema"]);
                    $show->setIdRoom($row['id_room']);
                    $movie = $MovieDB->getOneById($row['id_movie']);
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

        public function getOne($id){

            try
            {
                $genreList = array();

                $query = "SELECT * FROM ".$this->tableName . " WHERE id_show_cinema = " . $id ." ;";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                if(!empty($resultSet)){
                    $show = new ShowModel();
               
                    $show->setShowTime($row["show_time"]);
                    $show->setShowHour($row["show_hour"]);
                    $show->setId($row["id_show_cinema"]);
                    $show->setIdRoom($row['id_room']);
                    $movie = $MovieDB->getOneById($row['id_movie']);
                    $show->setMovie($movie);
                    
                    return $show;
                }
                else return 'Funcion no encontrado';
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
    }
?>
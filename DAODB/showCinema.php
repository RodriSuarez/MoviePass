<?php
     namespace DAODB;
    use \DateTime as DateTime;
    use \Exception as Exception;  
    use DAODB\Connection as Connection;
    use DAODB\Movie as MovieDB;
    use Models\ShowCinema as ShowModel;
    use Models\Movie as MovieModel;

    class ShowCinema
    {        
        private $connection;
        private $tableName = "show_cinema";
        private $movieTableName = "movie";
 

        public function Add(ShowModel $show, $idRoom)
        {
            try
            {   
                if(!$this->existMovieXdate($show->getMovie()->getId(), $show->getShowTime())){
                    $query = "INSERT INTO ".$this->tableName." (show_time, show_hour, id_room, id_movie)
                    VALUES (:show_time, :show_hour, :id_room, :id_movie);";
                    
            
                    
                    $parameters["show_time"] = $show->getShowTime();
                    $parameters["show_hour"] = $show->getShowHour();
                    $parameters["id_room"] = $idRoom;
                    $parameters["id_movie"] = $show->getMovie()->getId();
        
                    $this->connection = Connection::GetInstance();

                    $this->connection->ExecuteNonQuery($query, $parameters);
                   $dest= array( 'message' =>"La función se ha agregado correctamente",
                                'state' => true
                              );
                }else{
                    $message = 

                    $dest= array( 'message' =>"¡Error! Ya existe una función en el día <strong>" . date_format(new DateTime($show->getShowTime()), "d-m-Y") . "</strong> con la pelicula <strong>" . $show->getMovie()->getTitle() . "</strong>!",
                                'state' => false
                             );
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
                
            }

            return $dest;
        }

        
        

        //Modificar 
        public function existMovieXdate($movie,$date){
            try
            {
                $query = "SELECT * FROM " . $this->tableName . " WHERE id_movie = " . $movie ." AND show_time = '" .$date ."';";

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
                $today = date_format(new DateTime('now'), "Y-m-d");
      
                $query = "SELECT * FROM ".$this->tableName . " WHERE show_time >= '" . $today ."';";

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

        public function filterByGenre($genre){
            $showList = array();
            try{
                $query = 'SELECT g.name, gxm.id_movie, s.* FROM  genre_x_movie gxm
                INNER JOIN genre g ON g.id_genre = gxm.id_genre
                INNER JOIN show_cinema s ON s.id_movie =  gxm.id_movie
                HAVING g.name =  "' . $genre . '"
                            ORDER BY s.id_room;';
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                

                foreach($resultSet as $row){
                    array_push($showList, $this->GetOneById($row['id_show_cinema']));
                }
            }catch(Exception $error){
                throw $error;
            }

            return $showList;
        
        }

        public function filterByDate($date){
            $showList = array();
            try{
                $query = 'SELECT * FROM show_cinema WHERE show_time =  "' . $date . '"
                            ORDER BY id_room;';
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                #var_dump($resultSet);
                

                foreach($resultSet as $row){
                    array_push($showList, $this->GetOneById($row['id_show_cinema']));
                }
            }catch(Exception $error){
                throw $error;
            }

            return $showList;
        
        }

        public function filterByGengreXdate($genre, $date){

            $showList = array();
            try{
                $query = "SELECT g.name, gxm.id_movie, s.* FROM  genre_x_movie gxm
                            INNER JOIN genre g ON g.id_genre = gxm.id_genre
                            INNER JOIN show_cinema s ON s.id_movie =  gxm.id_movie
                            HAVING g.name = '" . $genre . "' AND s.show_time = '". $date ."'
                            ORDER BY s.id_room;";
                    $this->connection = Connection::GetInstance();

                    $resultSet = $this->connection->Execute($query);
                    
    
                    foreach($resultSet as $row){
                        array_push($showList, $this->GetOneById($row['id_show_cinema']));
                    }

            }catch(Exception $error){
                throw $error;
            }

            return $showList;

        }

        public function GetOneById($id)
        {
            try
            {
                $showList = array();

                $query = "SELECT * FROM ".$this->tableName . " WHERE id_show_cinema = " . $id.";";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                $movieDB = new MovieDB();
                $show = null;
                if($resultSet)
                {   
                    $row = $resultSet['0'];
                    $show = new ShowModel();
               
                    $show->setShowTime($row["show_time"]);
                    $show->setShowHour($row["show_hour"]);
                    $show->setId($row["id_show_cinema"]);
                    $show->setIdRoom($row['id_room']);
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
                    $movie = $movieDB->getOneById($row['id_movie']);
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
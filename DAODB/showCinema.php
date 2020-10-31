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
    
      /*  public function GetMovieById($id){

            try{
                
                $query = "SELECT * FROM " . $this->movieTableName ." WHERE id_movie = " . $id . ";";
                $this->connection = Connection::GetInstance();

                $obj = $this->connection->Execute($query);

                $movie = null;

                if($obj){
                    $row = $obj['0'];
                    $movie = new MovieModel();
                    $movie->setTitle($row["title"]);
                    $movie->setApi_id($row["id_api_movie"]);
                    $movie->setPoster_path($row["poster_path"]);
                    $movie->setBackdrop_path($row["backdrop_path"]);
                    $movie->setOverview($row["overview"]);
                    $movie->setVote_average($row["vote_average"]);
                    $movie->setGenres(($this->GetGenreMovie($row["id_movie"])));       
                    $movie->setRealease_date($row["release_date"]);
                    $movie->setTrailer_link($row["trailer_link"]);
                    $movie->setId($row["id_movie"]);
                    $movie->setRating($row['rating']);
                    $movie->setDirector($row['director']);
                    $movie->setDuration($row['duration']);
                }
                return $movie;                

            }
            catch(Exception $error){
             
                throw $error;
            }

        }*/

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
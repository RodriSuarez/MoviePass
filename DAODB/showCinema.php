<?php
     namespace DAODB;
    use \DateTime as DateTime;
    use \Exception as Exception;  
    use DAODB\Connection as Connection;
    use DAODB\Movie as MovieDB;
    use DAODB\Room as RoomDB;
    use Models\ShowCinema as ShowModel;
    use Models\Movie as MovieModel;
    use Models\Room as RoomModel;

    class ShowCinema
    {        
        private $connection;
        private $tableName = "show_cinema";
        private $movieTableName = "movie";
 

        public function Add(ShowModel $show, $idRoom)
        {
            if(!$this->existMovieXdate($show->getMovie()->getId(), $show->getShowTime(), $idRoom)){
                $query = "INSERT INTO ".$this->tableName." (show_time, show_hour, id_room, id_movie)
                VALUES (:show_time, :show_hour, :id_room, :id_movie);";
                
                
                
                $parameters["show_time"] = $show->getShowTime();
                $parameters["show_hour"] = $show->getShowHour();
                $parameters["id_room"] = $idRoom;
                $parameters["id_movie"] = $show->getMovie()->getId();
                
                try
                {   
                    $this->connection = Connection::GetInstance();

                    $this->connection->ExecuteNonQuery($query, $parameters);
               /*    $dest= array( 'message' =>"La función se ha agregado correctamente",
               'state' => true
            );*/
                }catch(Exception $ex)
                {
                    throw $ex;
                    
                }
                              $state = true;
                }else{
                    
                 /*   $dest= array( 'message' =>"<strong>¡Error!</strong> Ya existe una función en el día <strong>" . date_format(new DateTime($show->getShowTime()), "d-m-Y") . "</strong> con la pelicula <strong>" . $show->getMovie()->getTitle() 
                    . "</strong> en la sala <strong>". $show->getRoom()->getRoomName()."</strong>!",
                                'state' => false
                             );*/
                             $state = false;
                }
            

            return $state;
        }

        
        

        //Modificar 
        public function existMovieXdate($movie,$date, $idRoom){
            $query = "SELECT * FROM " . $this->tableName . " WHERE id_movie = " . $movie ." AND show_time = '" .$date ."' AND id_room != " .$idRoom .";";
            
            try
            {
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
               

                return $resultSet;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        
        }

        public function checkTime(ShowModel $show, $roomID){
            
            $query = "SELECT * FROM ". $this->tableName . " WHERE show_time = '" . $show->getShowTime() ."' ;";
                try{
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                $movieDB = new MovieDB();
                $roomDB =  new RoomDB();

                $RealShowStart = new DateTime($show->getShowHour()); //Horario en el que empieza la pelicula
                $RealShowEnd = new DateTime($show->getShowHour()); //Horario en el que termina la pelicula
                $RealShowEnd->modify('+ ' . $show->getMovie()->getDuration() . ' minute'); //Se le suman la duracion de la pelicula
               # $RealShowEnd->modify('+ 15 minute');  // se le suman los 15 minutos entre funciones

                $dif = new DateTime('00:16');
               
                foreach ($resultSet as $row)
                {                
                    $showInit = $row["show_hour"];
                    $showDuration = $movieDB->getOneById($row['id_movie'])->getDuration();
                    $showStart = new DateTime($showInit);
                    
                    $showEnd = new DateTime($showInit);
                 
                    $showEnd->modify('+ ' . $showDuration .' minute'); //Se le suma la cantidad de minutos de la pelicula
                    $showEnd->modify('+ 15 minute'); //Se le suman 15 minutos
              
                                        
                    if(strcmp($RealShowStart->format('H:i'), $showStart->format('H:i')) == 0)
                        return false;
                  
                    else  if(strcmp($RealShowStart->format('H:i'), $showStart->format('H:i')) < 0){
                    
                            if( (strcmp($RealShowEnd->format('H:i'), $showStart->format('H:i')) == 1
                            && ( (DateTime::createFromFormat( date_diff($RealShowEnd, $showStart)->format('H:i'), 'H:i')) >= $dif))
                            || strcmp($RealShowEnd->format('H:i'), $showStart->format('H:i')) != -1) 
                                return false;  
                
                  }else{         
                                  
                    if( (strcmp($showEnd->format('H:i'), $RealShowStart->format('H:i')) == 1))
                 
                        return false;
            
                    
                    }            
                }
                             return true;
            }catch(Exception $error){
                throw $error;
            }

        }

        
        public function GetAll()
        {
            $showList = array();
            $today = date_format(new DateTime('now'), "Y-m-d");
            
            $query = "SELECT * FROM ".$this->tableName . " WHERE show_time >= '" . $today ."';";
            
            try
            {
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

        public function filterByGenre($genre){
            $showList = array();
            $query = 'SELECT g.name, gxm.id_movie, s.* FROM  genre_x_movie gxm
                INNER JOIN genre g ON g.id_genre = gxm.id_genre
                INNER JOIN show_cinema s ON s.id_movie =  gxm.id_movie
                HAVING g.name =  "' . $genre . '"
                            ORDER BY s.id_room;';
                            
                            try{
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
            $query = 'SELECT * FROM show_cinema WHERE show_time =  "' . $date . '"
            ORDER BY id_room;';
                    try{
                
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
            $query = "SELECT g.name, gxm.id_movie, s.* FROM  genre_x_movie gxm
                            INNER JOIN genre g ON g.id_genre = gxm.id_genre
                            INNER JOIN show_cinema s ON s.id_movie =  gxm.id_movie
                            HAVING g.name = '" . $genre . "' AND s.show_time = '". $date ."'
                            ORDER BY s.id_room;";
                try{
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
            $showList = array();
            
            $query = "SELECT * FROM ".$this->tableName . " WHERE id_show_cinema = " . $id.";";
            # var_dump($id);
            try
            {
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                $movieDB = new MovieDB();
                $roomDB =  new RoomDB();

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
    
            $query='DELETE FROM '.$this->tableName.' WHERE id_room = "'.$id_room.'";';
            try{
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
    
        catch(Exception $ex){
            throw $ex;
            }
        }  

        public function GetByRoom($roomId)
        {
            $showList = array();
            
            $query = "SELECT * FROM ".$this->tableName . " WHERE id_room = " . $roomId . ";";
            
            try
            {
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
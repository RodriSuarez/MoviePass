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
                $query = "INSERT INTO ".$this->tableName." (show_time, show_hour, id_room, id_movie, remaining_tickets)
                VALUES (:show_time, :show_hour, :id_room, :id_movie, :remaining_tickets);";
                
                
                
                $parameters["show_time"] = $show->getShowTime();
                $parameters["show_hour"] = $show->getShowHour();
                $parameters["id_room"] = $idRoom;
                $parameters["id_movie"] = $show->getMovie()->getId();
                $parameters["remaining_tickets"]=$show->getRoom()->getRoomCapacity();
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
                    $show->setRemaining_tickets($row["remaining_tickets"]);
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
            
            
            $query = 'SELECT * FROM '.$this->tableName . ' WHERE id_show_cinema = ' .$id.';';
            
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
                    $show->setRemaining_tickets($row["remaining_tickets"]);

            
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
                    $show->setRemaining_tickets($row["remaining_tickets"]);

                    array_push($showList, $show);
                }

                return $showList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
           public function updateRemainingTicktes($QuantTickets, $showCinema)
        {
            
                       
                $query =  ' UPDATE '.$this->tableName.' SET remaining_tickets = "'. ($showCinema->getRemaining_tickets()
                -$QuantTickets).'"  WHERE id_show_cinema = "' . $showCinema->getId() . '" ;';

            try
            {
                $this->connection = Connection::GetInstance();
            
                $this->connection->ExecuteNonQuery($query);       

            }catch(Exception $ex){
                throw $ex;
            }  
        }

        public function updateWithoutBuy($id_show_cinema, $room)
        {   
            $query = 'UPDATE'.$this->tableName.'SET remaining_tickets ="'.$room->getRoom_Capacity().'" WHERE id_show_cinema=
            "'.$id_show_cinema.'";';
            try
            {
            $this->connection = Connection::GetInstance();
            
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex){

                throw $ex;
                
            }


        }


        public function getTotalCinemaSell($show)
        {               
                        $roomId = $show->getRoom->getIdRoom();
                        $query = 'SELECT'.$this->tableName.'  WHERE id_room = ' . $roomId . ';';
            try {
                    $this->connection = Connection::GetInstance();
                    $resultSet = $this->connection->Execute($query);

                    if($resultSet)
                    {
                        foreach ($resultSet as $row)
                        {
                            $showQuery = new ShowModel();



                        }
                    }




                }
                catch(Exception $ex)
                {

                    throw $ex;
                }
                            }
            

                public function getTotatMovieSell($show)
                    {



                                }
            



        public function getTotalSoldByDateXCinema($show_cinema)
        {

            $showsList = filterByDate($show_cinema->getShowTime());

            $sales = 0;

            foreach($showList as $show)
            {
                $sales = $sales + $show->getRemaining_tickets();

            }
            
            $cinemaCapacity = $show_cinema->getRoom()->getCinema()->getCapacity();
            
            $result = $cinemaCapacity - $sales;

            $sold = $result * $show_cinema->getRoom()->getPrice();

            return $sold;
        }


        public function getTotalSoldByDateXRoom($cinema, $firstDate, $lastDate)
        {
            
            $query  = "SELECT * FROM show_cinema c
            INNER JOIN movie m ON c.id_movie = m.id_movie
            INNER JOIN room r ON  c.id_room = r.id_room
            WHERE r.id_cinema = " .$cinema->getIdCinema()." AND show_time BETWEEN '" . $firstDate . "' AND '" . $lastDate . "';";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            $roomDB = new RoomDB();
            $movieDB = new MovieDB();

            $sales = 0;
            $sold = 0;
          #  var_dump($resultSet);
          if($resultSet)
                    {
                        $room = $roomDB->GetOne($resultSet['0']['id_room']);

                        foreach ($resultSet as $row)
                        {
                           
                            if($cinema->getIdCinema() == $row['id_cinema']){
                                 $show = new ShowModel();
                            $show->setShowTime($row["show_time"]);
                            $show->setShowHour($row["show_hour"]);
                            $show->setId($row["id_show_cinema"]);
                            $show->setRoom($roomDB->getOne($row['id_room']));
                            $movie = $movieDB->getOneById($row['id_movie']);
                            $show->setMovie($movie);
                            $show->setRemaining_tickets($row["remaining_tickets"]);
                           
                                $sales = ($show->getRoom()->getRoomCapacity() - $row['remaining_tickets']);
                                $sold+= $sales * $show->getRoom()->getPrice();
                            }


                        }
                    }
            
    
            return $sold;
        }

        public function getTotalSoldByDateXMovie($movie, $firstDate, $lastDate)
        {
            
            $query  = "SELECT * FROM show_cinema c
            INNER JOIN movie m ON c.id_movie = m.id_movie
            INNER JOIN room r ON  c.id_room = r.id_room
            WHERE c.id_movie = " .$movie->getId()." AND show_time BETWEEN '" . $firstDate . "' AND '" . $lastDate . "';";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            $roomDB = new RoomDB();
            $movieDB = new MovieDB();

            $sales = 0;
            $sold = 0;
          #  var_dump($resultSet);
          if($resultSet)
                    {
                        $room = $roomDB->GetOne($resultSet['0']['id_room']);

                        foreach ($resultSet as $row)
                        {
                           
                            if($movie->getId() == $row['id_movie']){
                                 $show = new ShowModel();
                            $show->setShowTime($row["show_time"]);
                            $show->setShowHour($row["show_hour"]);
                            $show->setId($row["id_show_cinema"]);
                            $show->setRoom($roomDB->getOne($row['id_room']));
                            $movie = $movieDB->getOneById($row['id_movie']);
                            $show->setMovie($movie);
                            $show->setRemaining_tickets($row["remaining_tickets"]);
                           
                                $sales = ($show->getRoom()->getRoomCapacity() - $row['remaining_tickets']);
                                $sold+= $sales * $show->getRoom()->getPrice();
                            }


                        }
                    }
            
    
            return $sold;
        }

        public function getTotalCantSoldByDateXMovie($movie)
        {
            
            $query  = "SELECT * FROM show_cinema c
            INNER JOIN movie m ON c.id_movie = m.id_movie
            INNER JOIN room r ON  c.id_room = r.id_room
            WHERE c.id_movie = " .$movie->getId().";";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            $roomDB = new RoomDB();
            $movieDB = new MovieDB();

            $sales = 0;
            $sold = 0;
            $rm=0;
          #  var_dump($resultSet);
          if($resultSet)
                    {
                        $room = $roomDB->GetOne($resultSet['0']['id_room']);

                        foreach ($resultSet as $row)
                        {
                           
                            if($movie->getId() == $row['id_movie']){
                                 $show = new ShowModel();
                            $show->setShowTime($row["show_time"]);
                            $show->setShowHour($row["show_hour"]);
                            $show->setId($row["id_show_cinema"]);
                            $show->setRoom($roomDB->getOne($row['id_room']));
                            $movie = $movieDB->getOneById($row['id_movie']);
                            $show->setMovie($movie);
                            $show->setRemaining_tickets($row["remaining_tickets"]);
                           
                                $sales+= ($show->getRoom()->getRoomCapacity() - $row['remaining_tickets']);
                                $rm+= $row['remaining_tickets'];
                            }


                        }
                    }
            
                    $result = array(
                        'sales' => $sales,
                        'remaing' => $rm
                    );
            return $result;
        }
        
        public function getTotalCantSoldByDateXCinema($cinema)
        {
            
            $query  = "SELECT * FROM show_cinema c
            INNER JOIN movie m ON c.id_movie = m.id_movie
            INNER JOIN room r ON  c.id_room = r.id_room
            WHERE r.id_cinema = " .$cinema->getIdCinema().";";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            $roomDB = new RoomDB();
            $movieDB = new MovieDB();

            $sales = 0;
            $sold = 0;
            $rm=0;
          #  var_dump($resultSet);
          if($resultSet)
                    {
                        $room = $roomDB->GetOne($resultSet['0']['id_room']);

                        foreach ($resultSet as $row)
                        {
                           
                            if($cinema->getIdCinema() == $row['id_cinema']){
                                 $show = new ShowModel();
                            $show->setShowTime($row["show_time"]);
                            $show->setShowHour($row["show_hour"]);
                            $show->setId($row["id_show_cinema"]);
                            $show->setRoom($roomDB->getOne($row['id_room']));
                            $movie = $movieDB->getOneById($row['id_movie']);
                            $show->setMovie($movie);
                            $show->setRemaining_tickets($row["remaining_tickets"]);
                           
                                $sales+= ($show->getRoom()->getRoomCapacity() - $row['remaining_tickets']);
                                $rm+= $row['remaining_tickets'];
                            }


                        }
                    }
            
                    $result = array(
                        'sales' => $sales,
                        'remaing' => $rm
                    );
            return $result;
        }
        
    }
?>
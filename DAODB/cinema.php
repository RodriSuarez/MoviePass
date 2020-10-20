<?php
namespace DAODB;

    use \Exception as Exception;
   
    use Models\cinema as CinemaModel;    
    use DAODB\Connection as Connection;

    class Movie 
    {
        private $connection;
        private $tableName = "cinema";
/* private $name;
        private $address;
        private $capacity;
        private $id;
        private $room;*/
        public function Add(CinemaModel $cinema)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (cinema_name, address, capacity,  id_room)
                 VALUES (:cinema_name, :address, :capacity, :id_room);";
                
           
                
                $parameters["cinema_name"] = $cinema->getCinemaName();
                $parameters["address"] = $cinema->getAddress();
                $parameters["capacity"] = $cinema->getCapacity();
                $parameters["id_room"] = serialize($cinema->getRoom());


                $this->connection = Connection::GetInstance();
               // print_r($parameters);
                $this->connection->ExecuteNonQuery($query, $parameters);

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
                $cinemaList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $cinema = new CinemaModel();
               
                    $cinema->setCinemaName($row["cinema_name"]);
                    $cinema->setAddress($row["address"]);
                    $cinema->setCapacity($row["capacity"]);
                    $cinema->setRoom(unserialize($row["id_room"]));


                    
                    array_push($cinmeaList, $cinema);
                }

                return $cinemaList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

      /*  public function exist($id){
            try
            {
                

                $query = "SELECT * FROM ".$this->tableName . " WHERE id_api_movie = " . $id .";";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                

                return $resultSet;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        
        }
        public function GetApiMovies(){
           
            try{
            $newArrivals = json_decode( file_get_contents(API_URL . NOW_PLAYING . API_KEY . LANGUAGE), true );
           
            $query = "INSERT INTO ".$this->tableName." (title, id_api_movie, poster_path, backdrop_path, overview, vote_average, genres_id, release_date, trailer_link)
                 VALUES (:title, :id_api_movie, :poster_path, :backdrop_path, :overview, :vote_average, :genres_id, :release_date, :trailer_link);";

            foreach($newArrivals['results'] as $movie){
                
                if(!$this->exist($movie['id']))
                {
                    $parameters["title"] = $movie['title'];
                    $parameters["id_api_movie"] = $movie['id'];
                    $parameters["poster_path"] = $movie['poster_path'];
                    $parameters["backdrop_path"] = $movie['backdrop_path'];
                    $parameters["overview"] = $movie['overview'];
                    $parameters["vote_average"] = $movie['vote_average'];
                    $parameters["genres_id"] = serialize($movie['genre_ids']);
                    $parameters["release_date"] = $movie['release_date'];
                    $parameters["trailer_link"] = json_decode(file_get_contents(API_URL .'/movie/'. $movie['id'] .'/videos?'. API_KEY), true)['results']['0']['key'];

                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query, $parameters);

                }
                   
                }

            }
            catch(Exception $ex){
                throw $ex;
            }


        }*/
    }
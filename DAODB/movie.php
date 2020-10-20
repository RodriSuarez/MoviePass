<?php
    namespace DAODB;

    use \Exception as Exception;
   
    use Models\movie as MovieModel;    
    use DAODB\Connection as Connection;

    class Movie 
    {
        private $connection;
        private $tableName = "movie";
 
        public function Add(MovieModel $movie)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (title, id_api_movie, poster_path, backdrop_path, overview, vote_average, genres_id, release_date, trailer_link)
                 VALUES (:title, :id_api_movie, :poster_path, :backdrop_path, :overview, :vote_average, :genres_id, :release_date, :trailer_link);";
                
           
                
                $parameters["title"] = $movie->getTitle();
                $parameters["id_api_movie"] = $movie->getApi_id();
                $parameters["poster_path"] = $movie->getPoster_path();
                $parameters["backdrop_path"] = $movie->getBackdrop_path();
                $parameters["overview"] = $movie->getOverview();
                $parameters["vote_average"] = $movie->getVote_average();
                $parameters["genres_id"] = serialize($movie->getGenres());
                $parameters["release_date"] = $movie->getRealease_date();
                $parameters["trailer_link"] = $movie->getTrailer_link();


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
                $movieList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $movie = new MovieModel();
               
                    $movie->setTitle($row["title"]);
                    $movie->setApi_id($row["id_api_movie"]);
                    $movie->setPoster_path($row["poster_path"]);
                    $movie->setBackdrop_path($row["backdrop_path"]);
                    $movie->setOverview($row["overview"]);
                    $movie->setVote_average($row["vote_average"]);
                    $movie->setGenres(unserialize($row["genres_id"]));
                    $movie->setRealease_date($row["release_date"]);
                    $movie->setTrailer_link($row["trailer_link"]);
                    $movie->setId($row["id_movie"]);
                    $movie->setRating($row['rating']);
                    $movie->setDirector($row['director']);
                    $movie->setDuration($row['duration']);
                    array_push($movieList, $movie);
                }

                return $movieList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function exist($id){
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
           
            $query = "INSERT INTO ".$this->tableName." (title, id_api_movie, poster_path, backdrop_path, overview, vote_average, genres_id, release_date, trailer_link, director, duration, rating)
                 VALUES (:title, :id_api_movie, :poster_path, :backdrop_path, :overview, :vote_average, :genres_id, :release_date, :trailer_link, :director, :duration, :rating);";

            foreach($newArrivals['results'] as $movie){
                
               if(!$this->exist($movie['id']))
                {
                    //https://api.themoviedb.org/3/movie/718444?api_key=5c5be0bb9aae8be870e50088603452ef&language=es-ES
                    $movieCall = json_decode(file_get_contents(API_URL. '/movie/' . $movie['id']  . "?" . API_KEY),true);
                    $directorCall = json_decode(file_get_contents(API_URL. '/movie/' . $movie['id'] . "/credits?" . API_KEY),true);
                
                  //  var_dump($directorCall);
                     foreach($directorCall['crew'] as $crew){
                        if($crew['job'] == "Director")
                            $director = $crew['name'];
                    }

                    
                    $parameters["title"] = $movie['title'];
                    $parameters["id_api_movie"] = $movie['id'];
                    $parameters["poster_path"] = $movie['poster_path'];
                    $parameters["backdrop_path"] = $movie['backdrop_path'];
                    $parameters["overview"] = $movie['overview'];
                    $parameters["vote_average"] = $movie['vote_average'];
                    $parameters["genres_id"] = serialize($movie['genre_ids']);
                    $parameters["release_date"] = $movie['release_date'];
                    $parameters["rating"] = $movie['vote_average'];
                    $parameters["trailer_link"] = json_decode(file_get_contents(API_URL .'/movie/'. $movie['id'] .'/videos?'. API_KEY), true)['results']['0']['key'];
                    
                    $parameters["director"] = $director;
                    $parameters["duration"] = $movieCall['runtime'];

                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query, $parameters);

                }
                   
                }

            }
            catch(Exception $ex){
                throw $ex;
            }


        }
    }
?>
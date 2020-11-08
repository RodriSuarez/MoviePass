<?php
    namespace DAODB;

    use \Exception as Exception;
   
    use Models\movie as MovieModel;    
    use DAODB\Connection as Connection;
    use Models\Genre as Genre;
    use DAODB\Genre as GenreDB;

    class Movie 
    {
        private $connection;
        private $tableName = "movie";
        private $genre_x_movie = "genre_x_movie";
        


        public function Add(MovieModel $movie)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (title, id_api_movie, poster_path, backdrop_path, overview, vote_average, genres_id, release_date, trailer_link, duration)
                 VALUES (:title, :id_api_movie, :poster_path, :backdrop_path, :overview, :vote_average, :genres_id, :release_date, :trailer_link, :duration);";
                
           
                
                $parameters["title"] = $movie->getTitle();
                $parameters["id_api_movie"] = $movie->getApi_id();
                $parameters["poster_path"] = $movie->getPoster_path();
                $parameters["backdrop_path"] = $movie->getBackdrop_path();
                $parameters["overview"] = $movie->getOverview();
                $parameters["vote_average"] = $movie->getVote_average();
                $parameters["genres_id"] = serialize($movie->getGenres());
                $parameters["release_date"] = $movie->getRealease_date();
                $parameters["trailer_link"] = $movie->getTrailer_link();
                $parameters["duration"] = $movie->getDuration();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

            }
            catch(Exception $ex)
            {
                throw $ex;
                
            }
        }

        public function GetOneByApiID($apiId){

            try{

                $query = "SELECT * FROM " . $this->tableName ." WHERE id_api_movie = " . $apiId . ";";
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
                #   $movie->setGenres(unserialize($row["genres_id"]));
                    $movie->setGenres(($this->GetGenreMovie($row["id_movie"])));       
                    $movie->setRealease_date($row["release_date"]);
                    $movie->setTrailer_link($row["trailer_link"]);
                    $movie->setId($row["id_movie"]);
                    $movie->setRating($row['rating']);
                    $movie->setDirector($row['director']);
                    $movie->setDuration($row['duration']);
                }
                return $movie;
            }catch(Exception $error)
            {
                throw $error;
            }

        } 

        public function GetOneById($id){

            try{
               $query = "SELECT * FROM " . $this->tableName ." WHERE id_movie = " . $id . ";";
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
            }catch(Exception $error)
            {
                throw $error;
            }

        } 

        public function addGenreXmovie($idMovie, $genreList){

            try{
                $genres = new GenreDB();
                
          


                if(!$genres->GetAll()){
                    $genres->GetApiGenres();
                    $genres = new GenreDB();
                }

                $movie = $this->GetOneByApiID($idMovie);
         

                $realIdMovie = $movie->getId();

         
                
                $query = "INSERT INTO " . $this->genre_x_movie . " (id_genre, id_movie) VALUES (:id_genre, :id_movie);";

                foreach($genreList as $genre){
            
                    $parameters['id_genre'] = $genres->getOne($genre)->getID();
                    $parameters['id_movie'] = $realIdMovie;

                    $this->connection = Connection::GetInstance();

                    $this->connection->ExecuteNonQuery($query, $parameters);
                }


            }catch(Exception $e){

                throw $e;
            }

        }

        public function GetGenreMovie($idMovie){

            try{
                    $query = "SELECT g.name, g.id_genre, m.id_movie FROM  genre_x_movie gxm
                        INNER JOIN movie m ON m.id_movie = gxm.id_movie
                        INNER JOIN genre g ON g.id_genre = gxm.id_genre
                        WHERE m.id_movie = ". $idMovie ." ORDER BY m.id_movie;";
            
                    $obj = $this->connection->Execute($query);
                    $genreList = array();
                     if($obj){
                        $genres = $obj['0'];

                      $genreList =  array_map(function($gen){
                            return new Genre($gen['name'], $gen['id_genre'], $gen['id_movie']);
                        }, $obj);

                       return $genreList;
                     }

                    
                
                
            }catch(Exception $error){
                throw $error;
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
                    $movie->setGenres(($this->GetGenreMovie($row["id_movie"])));       
    
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





        public function SearchMovies($title)
        {
            try
            {
                $movieList = array();

                $query = "SELECT * FROM ".$this->tableName . "  WHERE title LIKE '%" . $title ."%';";

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
                    $movie->setGenres(($this->GetGenreMovie($row["id_movie"])));       
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
        public function existApiId($id){
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

        
        public function filterByGenre($genre){
            $movieList = array();
            try{
                $query = 'SELECT g.name, gxm.id_movie, m.id_movie FROM  genre_x_movie gxm
                            INNER JOIN movie m ON m.id_movie = gxm.id_movie
                            INNER JOIN genre g ON g.id_genre = gxm.id_genre
                            HAVING g.name = "' . $genre . '"
                            ORDER BY g.name;';
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                #var_dump($resultSet);

                //$movieList = array();

                foreach($resultSet as $row){
                    array_push($movieList, $this->GetOneById($row['id_movie']));
                }

            }catch(Exception $error){
                throw $error;
            }

            return $movieList;
        
    }



        public function GetApiMovies($page){
           
            try{
            $newArrivals = json_decode( file_get_contents(API_URL . NOW_PLAYING . API_KEY . LANGUAGE . "&page=" . $page), true );
           
            $query = "INSERT INTO ".$this->tableName." (title, id_api_movie, poster_path, backdrop_path, overview, vote_average,  release_date, trailer_link, director, duration, rating)
                 VALUES (:title, :id_api_movie, :poster_path, :backdrop_path, :overview, :vote_average,  :release_date, :trailer_link, :director, :duration, :rating);";

            foreach($newArrivals['results'] as $movie){
                
               if(!$this->existApiId($movie['id']))
                {
                    //https://api.themoviedb.org/3/movie/718444?api_key=5c5be0bb9aae8be870e50088603452ef&language=es-ES
                    $movieCall = json_decode(file_get_contents(API_URL. '/movie/' . $movie['id']  . "?" . API_KEY),true);
                    $directorCall = json_decode(file_get_contents(API_URL. '/movie/' . $movie['id'] . "/credits?" . API_KEY),true);
                
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
               
                    $parameters["release_date"] = $movie['release_date'];
                    $parameters["rating"] = $movie['vote_average'];
                    $video = json_decode(file_get_contents(API_URL .'/movie/'. $movie['id'] .'/videos?'. API_KEY), true)['results'];
                    $parameters["trailer_link"] = !empty($video)  ? $video['0']['key'] : 'Video no disponible';
                    
                    $parameters["director"] = !empty($director) ? $director : 'Director no disponible';
                    $parameters["duration"] = $movieCall['runtime'];

                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query, $parameters);
                    
                    $this->addGenreXmovie($movie['id'], $movie['genre_ids']);
                }
                   
                }

            }
            catch(Exception $ex){
                throw $ex;
            }


        }

        public function getApiMoviesByName($title){
            $title = str_replace(' ','%20', $title);
           /* $next = "https://api.themoviedb.org/3/search/movie?api_key=5c5be0bb9aae8be870e50088603452ef&language=es-ES&query=".$title."&page=1&include_adult=false";
            var_dump($next);*/
            try{
                $newArrivals =  json_decode(file_get_contents("https://api.themoviedb.org/3/search/movie?api_key=5c5be0bb9aae8be870e50088603452ef&language=es-ES&query=".$title."&page=1&include_adult=false"), true);
              #  var_dump($newArrivals);
                $query = "INSERT INTO ".$this->tableName." (title, id_api_movie, poster_path, backdrop_path, overview, vote_average,  release_date, trailer_link, director, duration, rating)
                     VALUES (:title, :id_api_movie, :poster_path, :backdrop_path, :overview, :vote_average, :release_date, :trailer_link, :director, :duration, :rating);";
    
                foreach($newArrivals['results'] as $movie){
                    
                   if(!$this->existApiId($movie['id']))
                    {    #  var_dump($movie['overview']);
                        if(!empty($movie['overview'])){
                        //https://api.themoviedb.org/3/movie/718444?api_key=5c5be0bb9aae8be870e50088603452ef&language=es-ES
                        
                            try{
                                $movieCall = json_decode(file_get_contents(API_URL. '/movie/' . $movie['id']  . "?" . API_KEY),true);
                            }catch(Exeption $error){
                                echo "Errorsuli";
                            }
                         
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
                       # $parameters["genres_id"] = serialize($movie['genre_ids']);
                        $parameters["release_date"] = $movie['release_date'];
                        $parameters["rating"] = $movie['vote_average'];
                        #$parameters["trailer_link"] = json_decode(file_get_contents(API_URL .'/movie/'. $movie['id'] .'/videos?'. API_KEY), true)['results']['0']['key'];
                        $video = json_decode(file_get_contents(API_URL .'/movie/'. $movie['id'] .'/videos?'. API_KEY), true)['results'];
                        $parameters["trailer_link"] = !empty($video)  ? $video['0']['key'] : 'Video no disponible';
                        $parameters["director"] = $director;
                        $parameters["duration"] = $movieCall['runtime'];
    
                        $this->connection = Connection::GetInstance();
                        $this->connection->ExecuteNonQuery($query, $parameters);

                        $this->addGenreXmovie($movie['id'], $movie['genre_ids']);

    
                    }
                }
                    }
    
                }
                catch(Exception $ex){
                    throw $ex;
                }
        }
    }
?>
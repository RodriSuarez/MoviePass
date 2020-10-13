<?php
    namespace DAO;


    use Models\Movie as Movie;

    class MovieDao
    {        
        private $movieList = array();
        private $fileName;

        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/movies.json";
        }

        public function Add(Movie $movie)
        {
            $this->RetrieveData();
            
            array_push($this->movieList, $movie);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->movieList;
        } 
        public function GetOne($id)
        {
            $this->RetrieveData();
            foreach($this->movieList as $movie){
                if($cinema->getName() == $id){
                    return $cinema;
                }
            }
            return null;
        }

        public function EditOne($id, Movie $modify)
        {
            $this->RetrieveData();
            var_dump($id);
            foreach($this->movieList as $movie){
                if($movie->getName() == $id){
                    $movie = $modify;
                }
            }
            $this->SaveData();
        }

        public function exist(Movie $movie){

            return in_array($movie, $this->movieList);
        }



        public function GetApiMovies(){
           
            $this->RetrieveData();

            $newArrivals = json_decode( file_get_contents(API_URL . NOW_PLAYING . API_KEY . LANGUAGE), true );
            
            foreach($newArrivals['results'] as $movie){
                

                $joinMovie = new Movie();

                $joinMovie ->setTitle($movie['title']);
                $joinMovie ->setApi_id($movie['id']);
                $joinMovie ->setPoster_path($movie['poster_path']);
                $joinMovie ->setBackdrop_path($movie['backdrop_path']);
                $joinMovie ->setOverview($movie['overview']);
                $joinMovie ->setVote_average($movie['vote_average']);
                $joinMovie ->setGenres($movie['genre_ids']);
                $joinMovie ->setRealease_date($movie['release_date']);
                                
                $youtubeLink = json_decode(file_get_contents(API_URL .'/movie/'. $movie['id'] .'/videos?'. API_KEY), true)['results']['0']['key'];

                $joinMovie ->setTrailer_link($youtubeLink);

                if(!$this->exist($joinMovie)){
                   
                    $this->Add($joinMovie);
                  // echo '<p class="text-white">Se agrego ' . $joinMovie->getTitle() . "<p>";
                   
                }

            }


        }

        public function DeleteOne($key){
            $this->RetrieveData();
          
            unset($this->movieList[$key]);

            $this->SaveData();
           
        }

        private function SaveData()
        {
            $arrayToEncode = array();
                      

            foreach($this->movieList as $movie)
            {
                $valuesArray["title"] = $movie->getTitle();
                $valuesArray["id"] = $movie->getApi_id();
                $valuesArray["poster_path"] = $movie->getPoster_path();
                $valuesArray["backdrop_path"] = $movie->getBackdrop_path();
                $valuesArray["overview"] = $movie->getOverview();
                $valuesArray["vote_average"] = $movie->getVote_average();
                $valuesArray["genres"] = $movie->getGenres();
                $valuesArray["release_date"] = $movie->getRealease_date();
                $valuesArray["trailer_link"] = $movie->getTrailer_link();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }
     
        private function RetrieveData()
        {
            $this->movieList = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                { 
                    $movie = new Movie();

                    $movie->setTitle($valuesArray["title"]);
                    $movie->setApi_id($valuesArray["id"]);
                    $movie->setPoster_path($valuesArray["poster_path"]);
                    $movie->setBackdrop_path($valuesArray["backdrop_path"]);
                    $movie->setOverview($valuesArray["overview"]);
                    $movie->setVote_average($valuesArray["vote_average"]);
                    $movie->setGenres($valuesArray["genres"]);
                    $movie->setRealease_date($valuesArray["release_date"]);
                    $movie->setTrailer_link($valuesArray["trailer_link"]);

                    array_push($this->movieList, $movie);
                }
            }
        }
    }
?>
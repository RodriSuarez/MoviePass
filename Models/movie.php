<?php

    namespace Models;
    use Models\Genre as Genre;

    class Movie{
       
        private $title;
        private $api_id;
        private $poster_path;
        private $backdrop_path;
        private $overview;
        private $vote_average;
        private /*Genre*/ $genres;
        private $realease_date;
        private $trailer_link;
        private $id;
        private $director;
        private $rating;
        private $duration;
        
        public function __construct($title='', $api_id='', $poster_path='', $backdrop_path='',
        $overview='', $vote_average='', /*Genre*/ $genres= null, $realease_date='', $trailer_link='', $id='',
        $director ='', $rating='', $duration=''){
          
            $this->title = $title;
            $this->api_id = $api_id;
            $this->poster_path = $poster_path;
            $this->backdrop_path = $backdrop_path;
            $this->overview = $overview;
            $this->vote_average = $vote_average;
            $this->genres = $genres;
            $this->realease_date = $realease_date;
            $this->trailer_link = $trailer_link;
            $this->id = $id;
            $this->director = $director;
            $this->duration = $duration;
           $this->rating = $rating;
            
        
        }
    
        public function getTitle()
        {
                return $this->title;
        }

        public function setTitle($title)
        {
                $this->title = $title;

        }

        public function getApi_id()
        {
                return $this->api_id;
        }

        public function setApi_id($api_id)
        {
                $this->api_id = $api_id;

        }

        public function getPoster_path()
        {
                return $this->poster_path;
        }

        public function setPoster_path($poster_path)
        {
                $this->poster_path = $poster_path;
        }


        public function getBackdrop_path()
        {
                return $this->backdrop_path;
        }

        public function setBackdrop_path($backdrop_path)
        {
                $this->backdrop_path = $backdrop_path;
        }

        public function getOverview()
        {
                return $this->overview;
        }

        public function setOverview($overview)
        {
                $this->overview = $overview;
        }

        public function getVote_average()
        {
                return $this->vote_average;
        }

        public function setVote_average($vote_average)
        {
                $this->vote_average = $vote_average;
        }

 
        public function getGenres()
        {
                return $this->genres;
        }

        public function setGenres($genres)
        {       
                foreach($genres as $genre){
                        array_push($this->genres,$genre);
                }
              
        }

        public function addGenre(Genre $genre){
                
                array_push($this->genres,$genre);
        }

        public function getRealease_date()
        {
                return $this->realease_date;
        }

        public function setRealease_date($realease_date)
        {
                $this->realease_date = $realease_date;
        }


        public function getTrailer_link()
        {
                return $this->trailer_link;
        }

        public function setTrailer_link($trailer_link)
        {
                $this->trailer_link = $trailer_link;
        }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of duration
         */ 
        public function getDuration()
        {
                return $this->duration;
        }

        /**
         * Set the value of duration
         *
         * @return  self
         */ 
        public function setDuration($duration)
        {
                $this->duration = $duration;

                return $this;
        }

        /**
         * Get the value of rating
         */ 
        public function getRating()
        {
                return $this->rating;
        }

        /**
         * Set the value of rating
         *
         * @return  self
         */ 
        public function setRating($rating)
        {
                $this->rating = $rating;

                return $this;
        }

        /**
         * Get the value of director
         */ 
        public function getDirector()
        {
                return $this->director;
        }

        /**
         * Set the value of director
         *
         * @return  self
         */ 
        public function setDirector($director)
        {
                $this->director = $director;

                return $this;
        }
    }

?>
<?php

    namespace Models;


    class Movie{
        private $title;
        private $api_id;
        private $poster_path;
        private $backdrop_path;
        private $overview;
        private $vote_average;
        private /* Genre*/ $genres;
        private $realease_date;
        private $trailer_link;
        private $id;
        
        public function __construct($title='', $api_id='', $poster_path='', $backdrop_path='',$overview='', $vote_average='', $genres='', $realease_date='', $trailer_link='', $id=''){
          
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
                $this->genres = $genres;
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
    }

?>
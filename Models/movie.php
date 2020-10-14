<?php

    namespace Models;


    class Movie{
        private $title;
        private $api_id;
        private $poster_path;
        private $backdrop_path;
        private $overview;
        private $vote_average;
        private $genres;
        private $realease_date;
        private $trailer_link;
        
        public function __construct($title='', $api_id='', $poster_path='', $backdrop_path='',$overview='', $vote_average='', $genres='', $realease_date='', $trailer_link=''){
            $this->title = $title;
            $this->api_id = $api_id;
            $this->poster_path = $poster_path;
            $this->backdrop_path = $backdrop_path;
            $this->overview = $overview;
            $this->vote_average = $vote_average;
            $this->genres = $genres;
            $this->realease_date = $realease_date;
            $this->trailer_link = $trailer_link;
        }
    
    

        /**
         * Get the value of title
         */ 
        public function getTitle()
        {
                return $this->title;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */ 
        public function setTitle($title)
        {
                $this->title = $title;

                return $this;
        }

        /**
         * Get the value of api_id
         */ 
        public function getApi_id()
        {
                return $this->api_id;
        }

        /**
         * Set the value of api_id
         *
         * @return  self
         */ 
        public function setApi_id($api_id)
        {
                $this->api_id = $api_id;

                return $this;
        }

        /**
         * Get the value of poster_path
         */ 
        public function getPoster_path()
        {
                return $this->poster_path;
        }

        /**
         * Set the value of poster_path
         *
         * @return  self
         */ 
        public function setPoster_path($poster_path)
        {
                $this->poster_path = $poster_path;

                return $this;
        }

        /**
         * Get the value of backdrop_path
         */ 
        public function getBackdrop_path()
        {
                return $this->backdrop_path;
        }

        /**
         * Set the value of backdrop_path
         *
         * @return  self
         */ 
        public function setBackdrop_path($backdrop_path)
        {
                $this->backdrop_path = $backdrop_path;

                return $this;
        }

        /**
         * Get the value of overview
         */ 
        public function getOverview()
        {
                return $this->overview;
        }

        /**
         * Set the value of overview
         *
         * @return  self
         */ 
        public function setOverview($overview)
        {
                $this->overview = $overview;

                return $this;
        }

        /**
         * Get the value of vote_average
         */ 
        public function getVote_average()
        {
                return $this->vote_average;
        }

        /**
         * Set the value of vote_average
         *
         * @return  self
         */ 
        public function setVote_average($vote_average)
        {
                $this->vote_average = $vote_average;

                return $this;
        }

        /**
         * Get the value of genres
         */ 
        public function getGenres()
        {
                return $this->genres;
        }

        /**
         * Set the value of genres
         *
         * @return  self
         */ 
        public function setGenres($genres)
        {
                $this->genres = $genres;

                return $this;
        }

        /**
         * Get the value of realease_date
         */ 
        public function getRealease_date()
        {
                return $this->realease_date;
        }

        /**
         * Set the value of realease_date
         *
         * @return  self
         */ 
        public function setRealease_date($realease_date)
        {
                $this->realease_date = $realease_date;

                return $this;
        }

        /**
         * Get the value of trailer_link
         */ 
        public function getTrailer_link()
        {
                return $this->trailer_link;
        }

        /**
         * Set the value of trailer_link
         *
         * @return  self
         */ 
        public function setTrailer_link($trailer_link)
        {
                $this->trailer_link = $trailer_link;

                return $this;
        }
    }

?>
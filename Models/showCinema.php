<?php

    namespace Models;

    use Models\Movie as Movie;

class showCinema{

    private $id;
    private $show_time;
    private $show_hour;
    private $movie;
    private $room;
    private $remaining_tickets;

    public function __construct($id='', $show_time='', $show_hour='', $movie = null, $room='', $remaining_tickets ='')
	{
		$this->id = $id;
		$this->show_time = $show_time;
		$this->show_hour = $show_hour;
        $this->room = $room;
        $this->movie = $movie;
        $this->remaining_tickets = $remaining_tickets;

	}


    public function getShowTime()
    {
        return $this->show_time;
    }
 
    public function setShowTime($show_time)
    {
        $this->show_time = $show_time;
    }

   
    public function getShowHour()
    {
        return $this->show_hour;
    }

    public function setShowHour($show_hour)
    {
        $this->show_hour = $show_hour;
    }

    public function getRoom()
    {
        return $this->room;
    }

    public function setRoom($room)
    {
        $this->room = $room;
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
     * Get the value of movie
     */ 
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * Set the value of movie
     *
     * @return  self
     */ 
    public function setMovie($movie)
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * Get the value of remaining_tickets
     */ 
    public function getRemaining_tickets()
    {
        return $this->remaining_tickets;
    }

    /**
     * Set the value of remaining_tickets
     *
     * @return  self
     */ 
    public function setRemaining_tickets($remaining_tickets)
    {
        $this->remaining_tickets = $remaining_tickets;

        return $this;
    }
}



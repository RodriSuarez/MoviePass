<?php

namespace Models;



class cinemaFunction{
private $id_function;
private $date;
private $time; 


	public function __construct($id_function, $date, $time)
	{
		$this->id_function = $id_function;
		$this->date = $date;
		$this->time = $time;
	}



  
    public function getIdFunction()
    {
        return $this->id_function;
    }

       public function setIdFunction($id_function)
    {
        $this->id_function = $id_function;

        return $this;
    }

 
    public function getDate()
    {
        return $this->date;
    }

 
    public function setDate($date)
    {
        $this->date = $date;

     
    }

   
    public function getTime()
    {
        return $this->time;
    }

 
    public function setTime($time)
    {
        $this->time = $time;

    }
}



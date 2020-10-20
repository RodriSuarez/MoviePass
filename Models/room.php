<?php


namespace Models;


class Room {
private $id_room;
private $room_name;
private $price;
private $capacity;


	
	public function __construct($id_room, $room_name, $price, $capacity)
	{
		$this->id_room = $id_room;
		$this->room_name = $room_name;
		$this->price = $price;
		$this->capacity = $capacity;
	}

    public function getName()
    {
        return $this->name;
    }

   
    public function setName($name)
    {
        $this->name = $name;

       }

    
  
    public function getPrice()
    {
        return $this->price;
    }

 
    public function setPrice($price)
    {
        $this->price = $price;

        
    }

  
    public function getCapacity()
    {
        return $this->capacity;
    }

  
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        
    }

  
    public function getIdRoom()
    {
        return $this->id_room;
    }

   
    public function setIdRoom($id_room)
    {
        $this->id_room = $id_room;

        
    }
}


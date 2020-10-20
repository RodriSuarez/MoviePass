<?php


namespace Models;


class Room {
private $name;
private $price;
private $capacity;





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
}


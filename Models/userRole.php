<?php
    namespace Models;

class userRole{
    private $description;

    public function __construct($description = 'user'){
        $this->first_name = $first_name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

}
?>
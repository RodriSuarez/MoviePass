<?php
namespace Models;



class user
{
	private $id_user;
	private $firstName;
	private $lastName;
	private $email;
	private $phoneNumber;
	private $pass;
    private $isAdmin;
	

	
	public function __construct($id_user='',$firstName=' ', $lastName=' ', $email='', $phoneNumber='', $pass='', $isAdmin='')
	{
		
		$this->id_user = $id_user;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		$this->phoneNumber = $phoneNumber;
		$this->pass = $pass;
        $this->isAdmin = $isAdmin;
	}


    public function getIdUser()
    {
        return $this->id_user;
    }

  
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;

     }  

  
    public function getFirstName()
    {
        return $this->firstName;
    }

  
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        
    }

    
    public function getLastName()
    {
        return $this->lastName;
    }

  
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

      
    }

   
    public function getEmail()
    {
        return $this->email;
    }

  
    public function setEmail($email)
    {
        $this->email = $email;

        
    }

    
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

   
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

      
    }

   
    public function setPass($pass)
    {
        $this->pass = $pass;

        
    }

    public function getPass()
    {
        return $this->pass;
    }

 
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

   
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;

        
    }
}

?>
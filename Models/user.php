<?php
    namespace Models;
    use Models\UserProfile as UserProfile;
    use Models\UserRole as UserRole;


class user{
	private $id_user;
	private $email;
    private $pass;
    private $profile;
    private $role;



   
    public function __construct($id_user='', $email='', $pass='', $profile=null, $role=null)
    {
        $this->id_user = $id_user;
        $this->email = $email;
        $this->pass = $pass;
        $this->profile = $profile;
        $this->role = $role;
        
            if(!$profile)
            $this->profile = new UserProfile();
        else
            $this->profile = $profile;

         if(!$role)
            $this->role = new UserRole();
        else
            $this->role = $role;
    }
    

    public function getIdUser()
    {
        return $this->id_user;
    }
  
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }  
   
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    public function getPass()
    {
        return $this->pass;
    }


    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of profile
     */ 
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Set the value of profile
     *
     * @return  self
     */ 
    public function setProfile($profile)
    {
        $this->profile = $profile;

        return $this;
    }

   
}
?>
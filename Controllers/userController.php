<?php
    
    namespace Controllers;
    
    //use DAO\UserDAO as userDao;
    use Models\user as User;
    use DAODB\User as userDB;

    class UserController{
      //  private $userDao;
        private $userDB;


    public function __construct()
    {
        /*$this->userDao = new userDao();*/
        $this->userDB = new userDB();
    }

       


        public function ShowAddView()
        {
            $userList=$this->userDB->GetAll();
            require_once(VIEWS_PATH."register.php");
            echo 'Registro con exito';

        }

        public function ShowLogin()
        {
            $userList=$this->userDB->GetAll();
            require_once(VIEWS_PATH."movie-lastest.php");
            //implementar session
        }

        public function ShowProfileView($name)
        {
            $userList = $this->userDB->GetOne($name);
            var_dump($user);
            require_once(VIEWS_PATH."user-profile.php");
        }

        public function ShowEditView($name){

            $userList = $this->userDB->GetOne($name);
          //  var_dump($cinema);
            require_once(VIEWS_PATH."user-edit.php");
        }

/*        public function DeleteOne($key){

            $this->cinemaDao->DeleteOne($key);
            
            
            $this->ShowListView();
        }*/

        public function EditOneUser($oldname, $firstName, $lastName, $email, $phoneNumber,$pass){
                     
            
            $modify = new User();
            $modify->setFirstName($firstName);
            $modify->setLastName($lastName);
            $modify->setEmail($email);
            $modify->setPhoneNumber($phoneNumber);
            $modify->setPass($pass);
            
            
            $this->userDao->EditOne($name, $modify);

            $this->ShowProfileView();
            
        }

        public function Add($firstName, $lastName, $email, $phoneNumber, $pass)
        {   
  
           
                
            $user = new User();
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setEmail($email);
            $user->setPhoneNumber($phoneNumber);
            $user->setPass($pass);
            
            
            $this->userDB->Add($user);

            $this->ShowAddView();
        }
    }

?>
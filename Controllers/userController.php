<?php
    
    namespace Controllers;
    
    //use DAO\UserDAO as userDao;
    use Models\user as User;
    use DAODB\User as userDB;
    use Controllers\MovieController as MovieC;
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
            require_once(VIEWS_PATH."login-form.php");
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
    
        public function login($email1, $pass1){
            
            $user = $this->userDB->GetOne($email1);

            if((!$user)&&($user->getPass()!=$pass1))
            {
                $message= "Usuario y/o contraseña incorrecta";   
                //REQUIRED (login.php) se tiene que preguntar si el message no esta vacio y si no se imprime

            }
            else
            {
                $movie= new MovieC();
                if($user->getIsAdmin()==true){
                $_SESSION['loggedUser']['firstName'] = $user->getFirstName();
                $movie->ShowListMoviesViewAdm();
            }else
            {
                $_SESSION['loggedUser']['firstName'] = $user->getFirstName();
                $movie->ShowListMoviesViewClient();
            }
            }

        }
        public function logout()
        {
            session_destroy();
            require_once(ROOT.VIEWS_PATH."register.php");

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
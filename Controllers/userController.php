 <?php
    namespace Controllers;

    use DAO\user as UserDao;
    use Models\User as User;
   
    class UserController{
        private $userDao;

        public function __construct()
        {
            $this->userDao = new UserDao();
        }

        public function ShowAddView()
        {
            $userList=$this->userDao->GetAll();
            require_once(VIEWS_PATH."register.php");
            echo 'Registro con exito';

        }

        public function ShowLogin()
        {
            $userList=$this->userDao->GetAll();
            require_once(VIEWS_PATH."login.php");

        }

        public function ShowProfileView($name)
        {
            $userList = $this->userDao->GetOne($name);
            var_dump($user);
            require_once(VIEWS_PATH."user-profile.php");
        }

        public function ShowEditView($name){

            $userList = $this->userDao->GetOne($name);
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
            
            
            $this->userDao->Add($user);
            

            $this->ShowAddView();
        }
    }

?>
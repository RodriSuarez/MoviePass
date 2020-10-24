<?php
    namespace DAO;


    use Models\User as user;

    class UserDAO
    {        
        private $userList = array();
        private $fileName;

        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/user.json";
        }

        public function Add(User $user)
        {
            $this->RetrieveData();
            
            array_push($this->userList, $user);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->userList;
        } 

       public function GetOne($name)
        {
            
            $this->RetrieveData();

            foreach($this->userList as $user)
            {
                if($user->getFirstName() == $name)
                {
                    return $user;
                }
            }

             return null;
        }

        public function EditOne($name, User $userModify){

            $this->RetrieveData();
            
            $modify = $this->getOne($name);

            
            $keyList = null;
            
            foreach($this->userList as $key => $user)
            {
                if($user->getIdUser() == $modify->getIdUser())
                {
                    $keyList = $key;
                }
            }

            if($keyList != null || $keyList == 0)
            {
                $this->userList[$keyList] = $userModify;
            }else
            {
                echo '<h1> NOOO </h1>';
            }
           
            $this->SaveData();
        }

        public function DeleteOne($key){
            $this->RetrieveData();
          
            unset($this->userList[$key]);

            $this->SaveData();
           
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->userList as $user)
            {
            
                $valuesArray["id_user"] = $user->getIdUser();
                $valuesArray["first_name"] = $user->getFirstName();
                $valuesArray["last_name"] = $user->getLastName();
                $valuesArray["email"] = $user->getEmail();
                $valuesArray["phone_number"] = $user->getPhoneNumber();
                $valuesArray["pass"] = $user->getPass();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }
     
        private function RetrieveData()
        {
            $this->userList = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
        
                    $user = new User();
                    $user->setIdUser($valuesArray["id_user"]);
                    $user->setFirstName($valuesArray["first_name"]);
                    $user->setLastName($valuesArray["last_name"]);
                    $user->setEmail($valuesArray["email"]);
                    $user->setPhoneNumber($valuesArray["phone_number"]);
                    $user->setPass($valuesArray["pass"]);
                 
                    array_push($this->userList, $user);
                }
            }
        }
    }
    ?>
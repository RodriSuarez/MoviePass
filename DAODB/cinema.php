<?php
namespace DAODB;

    use \Exception as Exception;
   
    use Models\cinema as CinemaModel;    
    use DAODB\Connection as Connection;
    use Controllers\roomController as rControl;

    class cinema
    {
        private $connection;
        private $tableName = "cinema";



        public function Add(CinemaModel $cinema)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (cinema_name, address, capacity)
                 VALUES (:cinema_name, :address, :capacity);";
                
           
                
                $parameters["cinema_name"] = $cinema->getCinemaName();
                $parameters["address"] = $cinema->getAddress();
                $parameters["capacity"] = $cinema->getCapacity();
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            }
            catch(Exception $ex)
            {
                throw $ex;
                
            }
        }

        public function GetAll()
        {
            try
            {
                $cinemaList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $cinema = new CinemaModel();
                    $cinema->setIdCinema($row["id_cinema"]);
                    $cinema->setCinemaName($row["cinema_name"]);
                    $cinema->setAddress($row["address"]);
                    $cinema->setCapacity($row["capacity"]);
                    array_push($cinemaList, $cinema);
                }

                return $cinemaList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function exist($cinema_name, $address){
            try
            {
                

                $query = 'SELECT * FROM '.$this->tableName . ' WHERE cinema_name = "' . $cinema_name .'" and address = "'.$address.'";';

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                

                return $resultSet;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        
        }

       public function GetOne($id_cinema)
        {
            try
            {
                
                $query = 'SELECT * FROM '.$this->tableName .' WHERE id_cinema = "'.$id_cinema.'";';
               
                $this->connection = Connection::GetInstance();
              
                $obj=$this->connection->Execute($query); 
               
                $cinema = null;
                if($obj)
                {
                    $row=$obj[0];

                    $cinema= new CinemaModel();
                    $cinema->setIdCinema($row["id_cinema"]);
                    $cinema->setCinemaName($row["cinema_name"]);
                    $cinema->setAddress($row["address"]);
                    $cinema->setCapacity($row["capacity"]);

                    return $cinema;
                }
                else
                {
                    return null;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function EditOne($id_cinema, CinemaModel $cinemaModify){

        try{
            
            $modify = $this->GetOne($id_cinema);
            if($modify==null){
            return "hola";
            }
            else{

                $modifyIdCinema=$modify->getIdCinema();

                $query =  ' UPDATE '.$this->tableName.' SET cinema_name = "'.$cinemaModify->getCinemaName().'", address = "'.$cinemaModify->getAddress().'", capacity = "'.$cinemaModify->getCapacity().'" WHERE id_cinema= "'.$modifyIdCinema.'";';

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
                
                            
            }
        }

        catch(Exception $ex){
            throw $ex;
        }  
    }

    public function DeleteOne($id_cinema){   
    
    try{
        $query='DELETE FROM '.$this->tableName.' WHERE id_cinema = "'.$id_cinema.'";';
        $this->connection = Connection::GetInstance();
        $this->connection->ExecuteNonQuery($query);
    }

    catch(Exception $ex){
        throw $ex;
    }  
}       

}
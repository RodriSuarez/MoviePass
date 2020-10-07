<?php
    namespace DAO;


    use Models\Movie as Movie;

    class MovieaDao
    {        
        private $movieList = array();
        private $fileName;

        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/movies.json";
        }

        public function Add(Cinema $cinema)
        {
            $this->RetrieveData();
            
            array_push($this->movieList, $cinema);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->movieList;
        } 
        public function GetOne($id)
        {
            $this->RetrieveData();
          //  var_dump($id);
            foreach($this->movieList as $cinema){
                if($cinema->getName() == $id){
                    return $cinema;
                }
            }
            return null;
        }

        public function EditOne($id, Cinema $modify)
        {
            $this->RetrieveData();
          //  var_dump($id);
            foreach($this->movieList as $cinema){
                if($cinema->getName() == $id){
                    $cinema = $modify;
                }
            }
            $this->SaveData();
        }

        public function getApiMovies(){

        }

        public function DeleteOne($key){
            $this->RetrieveData();
          
            unset($this->movieList[$key]);

            $this->SaveData();
           
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->movieList as $cinema)
            {
                $valuesArray["name"] = $cinema->getName();
                $valuesArray["address"] = $cinema->getAddress();
                $valuesArray["capacity"] = $cinema->getCapacity();
                $valuesArray["priceTicket"] = $cinema->getPriceTicket();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }
     
        private function RetrieveData()
        {
            $this->movieList = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                { //($name='', $address='', $capacity='', $priceTicket='')
                    $cinema = new Cinema();
                    $cinema->setName($valuesArray["name"]);
                    $cinema->setAddress($valuesArray["address"]);
                    $cinema->setCapacity($valuesArray["capacity"]);
                    $cinema->setPriceTicket($valuesArray["priceTicket"]);
                 

                    array_push($this->movieList, $cinema);
                }
            }
        }
    }
?>
<?php
    namespace DAO;


    use Models\Cinema as _Cinema;

    class Cinema
    {        
        private $cinemaList = array();
        private $fileName;

        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/cinema.json";
        }

        public function Add(Cinema $cinema)
        {
            $this->RetrieveData();
            
            array_push($this->cinemaList, $cinema);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->cinemaList;
        } 
        public function GetOne($id)
        {
            
                $this->RetrieveData();

            //  var_dump($id);
                foreach($this->cinemaList as $cinema){
                    if($cinema->getName() == $id){
                        return $cinema;
                    }
                }

                return null;
            
        

        }

        public function EditOne($name, _Cinema $cinemaModify){

            $this->RetrieveData();
            
            $modify = $this->getOne($name);

            
            $keyList = null;
            
            foreach($this->cinemaList as $key => $cinema){
                if($cinema->getName() == $name){
                    $keyList = $key;
                }
            }


            if($keyList != null || $keyList == 0){
                $this->cinemaList[$keyList] = $cinemaModify;
            }else{
                echo '<h1> NOOO </h1>';
            }
           
            $this->SaveData();

            
        }
        public function DeleteOne($key){
            $this->RetrieveData();
          
            unset($this->cinemaList[$key]);

            $this->SaveData();
           
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->cinemaList as $cinema)
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
            $this->cinemaList = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                { 
                    $cinema = new _Cinema();
                    $cinema->setName($valuesArray["name"]);
                    $cinema->setAddress($valuesArray["address"]);
                    $cinema->setCapacity($valuesArray["capacity"]);
                    $cinema->setPriceTicket($valuesArray["priceTicket"]);
                 

                    array_push($this->cinemaList, $cinema);
                }
            }
        }
    }
?>
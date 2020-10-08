<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            require_once(ROOT. VIEWS_PATH."register.php");
        }        
    }
?>
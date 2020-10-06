<?php 
    namespace Config;

    use Config\Request as Request;

    class Router
    {
        public static function Route(Request $request)
        {
            $controllerName = $request->getcontroller() . 'Controller';

            $methodName = $request->getmethod();

            /*print_r($methodName);
            print_r($methodParameters);*/

            $methodParameters = $request->getparameters();          

            $controllerClassName = "Controllers\\". $controllerName;            

            $controller = new $controllerClassName;
            
            if(!isset($methodParameters))          
                call_user_func(array($controller, $methodName));
            else
                call_user_func_array(array($controller, $methodName), $methodParameters);
        }
    }
?>
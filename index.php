<?php
 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	require "Config/Autoload.php";
	require "Config/Config.php";

	use Config\Autoload as Autoload;
	use Config\Router 	as Router;
	use Config\Request 	as Request;
		
	Autoload::start();

	session_start();

	require_once(VIEWS_PATH."header.php");
<<<<<<< HEAD
	
	//Incluimos el nav para navegar en el sitio hasta que haya un logIn
	require_once(VIEWS_PATH."nav.php");
=======
>>>>>>> parent of 18b4230... Se agrego la funcionalidad de listar cines

	Router::Route(new Request());

	require_once(VIEWS_PATH."footer.php");
?>
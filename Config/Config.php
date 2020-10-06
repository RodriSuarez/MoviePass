<?php namespace Config;

define("ROOT", dirname(__DIR__) . "\\");
//Path to your project's root folder
define("FRONT_ROOT", "\\MoviePass\\");
/*
define("ROOT_MANUAL","lab/MoviePass/");
*/
define("CINEMA_ROOT", "cinema\\");
define("MOVIE_ROOT", "movie\\");
define("VIEWS_PATH", "Views\\");
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css\\");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js\\");
//Config of API 
define("API_KEY", "5c5be0bb9aae8be870e50088603452ef");
define("LANGUAGE", "ES-es");
define("IMG_API", "https://image.tmdb.org/t/p/w500");
define("API_URL" ,"https://api.themoviedb.org/3");
?>







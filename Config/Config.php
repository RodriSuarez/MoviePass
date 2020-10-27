<?php namespace Config;

define("ROOT", dirname(__DIR__) . "\\");
//Path to your project's root folder
define("FRONT_ROOT", "\\MoviePass\\");
/*
define("ROOT_MANUAL","lab/MoviePass/");
*/
define("ROOM_ROOT", "room\\");
define("CINEMA_ROOT", "cinema\\");
define("MOVIE_ROOT", "movie\\");
define("VIEWS_PATH", "Views\\");
define("USER_ROOT", "user\\");
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css\\");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js\\");
//Config of API 
define("API_KEY", "api_key=5c5be0bb9aae8be870e50088603452ef");
define("LANGUAGE", "&language=es-ES");
define("API_IMG", "https://image.tmdb.org/t/p/w500");
define("API_URL" ,"https://api.themoviedb.org/3");
define("NOW_PLAYING", "/movie/now_playing?");
//youtube
define("YOUTUBE_URL", "https://www.youtube.com/watch?v=");

//DataBase constantes

define("DB_HOST", "localhost:3306");
define("DB_NAME", "movie_pass");
define("DB_USER", "root");
define("DB_PASS", "");



?>







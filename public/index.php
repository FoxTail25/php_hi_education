<?php
	namespace Core;
	
	use Project\Model\Mtest;
	
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');
	
	spl_autoload_register(function($class){
		// echo $class;
		$root = $_SERVER['DOCUMENT_ROOT'];
		$ds = DIRECTORY_SEPARATOR;
		$filename = $root . $ds . str_replace('\\',$ds, strtolower($class)) . '.php';
		// echo '<br/>';
		// echo $filename;
		require($filename);
	});
	

	$routes = require($_SERVER['DOCUMENT_ROOT'] . '/project/config/routes.php');

	$router = new Router();
	$track = $router->getTrack($routes, $_SERVER['REQUEST_URI'])

	
	// echo '<link rel="stylesheet" href="project/webroot/style.css">';
	?>
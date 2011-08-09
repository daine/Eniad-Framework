<?php
/*
 * Copyright 2011 Daine Trinidad
 * 
 * This file is part of Eniad Application Framework.
 * 
 * Eniad Application Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Eniad Application Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Eniad Application Framework.  If not, see <http://www.gnu.org/licenses/>.
 */
/*
 * ------------------------------
 * Load the required files
 * ------------------------------
 */
require(SYSTEM_PATH.'/config.php');
require(SYSTEM_PATH.'/database.php');
require(SYSTEM_PATH.'/logger.php');
require(SYSTEM_PATH.'/e_controller.php');
require(SYSTEM_PATH.'/e_model.php');

/*
 * ------------------------------
 * Start the session
 * ------------------------------
 */
session_start();

/*
 * -------------------------------
 * Load a specified controller
 * -------------------------------
 */
$query = $_SERVER['QUERY_STRING'];
$routes = array();
$parameters = array();

if(isset($_SERVER['PATH_INFO'])){
    $routes = explode("/", $_SERVER['PATH_INFO']);
}
$route_count = count($routes);
if($route_count >= 2){
	// Controller is the first string: index.php/mycontroller
	$controller = $routes[1];
	
	// Method is located at the second string: index.php/mycontroller/myfunction
	$method = $routes[2];	

	// Anything after the second string contains the parameters: index.php/mycontroller/myfunction/id/shoes
	if($route_count > 3){
	   $parameters = array_slice($routes, 3, $route_count-3);
	}
}
// If no contoller is found
if(!isset($controller) || strlen($controller) < 1){
	$controller = DEFAULT_CONTROLLER;
}
// Load the controller
$controller_name = $controller.'Controller';

// Make sure the file exists
if(!file_exists($controller) && file_exists(APP_PATH.'/'.CONTROLLERS.'/'.$controller_name.'.php')){
	
   require(APP_PATH.'/'.CONTROLLERS.'/'.$controller_name.'.php');
   
   // Instantiate controller files
   $$controller = new $controller_name();
   
   // If method is invalid
   if(!isset($method) || strlen($method)<1){
   	   $method = "index";
   }
   
   // Make sure the method can be called
   if(is_callable(array($$controller, $method))){
   	   // Call method and pass the parameters
       call_user_func_array(array($$controller, $method), $parameters);
   }else{
   	   exit("Unable to call method `$method` on $controller");
   }   
}else{
	exit("Unable to load controller `$controller`");
}

/**
 * 
 * Core class
 * @author Daine Trinidad <daine@compilesource.com>
 * @copyright Daine Trinidad 2011
 * @access public
 * @since July 4, 2011 
 */
class Core{
	public $config;
	public $web_path;
	public $database;
	public $logger;
	
	/**
	 * 
	 * Core constructor class. This takes care of loading the entire system
	 */
	public function __construct(){
		$this->config = new Config(APP_INI);
		
		define('WEB_PATH', $this->config->settings['web_path']);
		define('SECURE_WEB_PATH', $this->config->settings['secure_path']);
		$this->database = Database::getDatabase();
	}
}
<?php
/*
 * ------------------------------
 * Load the required files
 * ------------------------------
 */
require(SYSTEM_PATH.'/config.php');
require(SYSTEM_PATH.'/database.php');
require(SYSTEM_PATH.'/logger.php');
require(SYSTEM_PATH.'/e_controller.php');

/*
 * ------------------------------
 * Start the Core framework class
 * ------------------------------
 */
$core = new Core();

/*
 * -------------------------------
 * Load a specified controller
 * -------------------------------
 */
$query = $_SERVER['QUERY_STRING'];
$routes = explode("/", $_SERVER['PATH_INFO']);
$route_count = count($routes);
if($route_count >= 2){
	// Controller is the first string: index.php/mycontroller
	$controller = $routes[1];
	
	// Method is located at the second string: index.php/mycontroller/myfunction
	$method = $routes[2];
	$parameters = array();

	// Anything after the second string contains the parameters: index.php/mycontroller/myfunction/id/shoes
	if($route_count > 3){
	   $parameters = array_slice($routes, 3, $route_count-3);
	}
}else{
	$controller = $core->default_controller;
}
// Load the controller
$controller_name = $controller.'Controller';

// Make sure the file exists
if(!file_exists($controller) && file_exists(APP_PATH.'/'.CONTROLLERS.'/'.$controller_name.'.php')){
	
   require(APP_PATH.'/'.CONTROLLERS.'/'.$controller_name.'.php');
   
   // Instantiate controller files
   $$controller = new $controller_name();
   
   // Make sure the method can be called
   if(!$method){
   	   $method = "index";
   }
   
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
	private $config;
	public $default_controller;
	public $web_path;
	
	/**
	 * 
	 * Core constructor class. This takes care of loading the entire system
	 */
	public function __construct(){
		$this->config = new Config(APP_INI);
		$this->default_controller = $this->config->settings['default_controller'];
		
		define('WEB_PATH', $this->config->settings['web_path']);
		define('SECURE_WEB_PATH', $this->config->settings['secure_path']);
	}
}
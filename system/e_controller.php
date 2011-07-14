<?php
/**
 * Eniad Application Framework
 * A small, lightweight framework usable for very very small web apps
 * 
 * E_Controller class
 * Master Controller. All controllers should extend this class.
 * 
 * @author Daine Trinidad <daine@compilesource.com>
 * @copyright Daine Trinidad 2011
 * @access public
 * @since July 4, 2011
 * 
 */
abstract class E_Controller extends Core{
	public $view;
	public $db;
	
	/**
	 * 
	 * E_Controller constructor. Does nothing at the moment.
	 */
	public function __construct(){
		
	}
	
	/**
	 * 
	 * This method includes the view file specified by $view
	 * @param $view The name of the view
	 * @param $data Data that will be made accessible to the view page
	 */
	public function load_view($view, $data = array()){
		$this->view = $view;
		// Create the variables
		if(count($data) > 0){
			foreach($data as $key=>$value){
				$$key = $value;
			}
		}
		
		// Load the view
		if(file_exists(APP_PATH.'/'.VIEWS.'/'.$view.'View.php')){
			include(APP_PATH.'/'.VIEWS.'/'.$view.'View.php');
		}
	}
	
	/**
	 * 
	 * Load the database for a controller
	 */
	public function load_db(){
		$this->db = Database::getDatabase();
	}
	
	/**
	 * 
	 * Load the logger for a controller
	 * @param String $filename The filename to store your logs
	 */
	public function load_logger($filename = "default.log"){
		$this->logger = new Logger($filename);
	}
	
	/**
	 * 
	 * This is a method that allows you to do simple cURL methods
	 * @param URL $path The URL to call
	 * @param array $params An array containing parameters to send
	 * @return mixed The raw response of the cURL call
	 */
	public function call_url($path, $params){
		$string = array();
        foreach($params as $key=>$value){
        	$string[] .= $key."=".$value;
        }
        $this->params = implode('&', $string);
        $this->path = $path;
        $this->url = $this->path."?".$this->params;
        
		$handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $this->path);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $this->params);

        $response = curl_exec($handle);
        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);


    	return $response;
	}
}
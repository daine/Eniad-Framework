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
class E_Controller extends Core{
	public $view;
	public $db;
	
	/**
	 * 
	 * E_Controller constructor. Does nothing at the moment.
	 */
	public function __construct(){
		parent::__construct();
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
	
	/**
	 * 
	 * Check if a session exists for a user. Redirect them to $path if none is set 
	 * @param $path The path to redirect the user to login
	 * @param $sessionvars The session variables. Default are username and password
	 */
	public function require_login($path, $sessionvars = array('username', 'password')){
		$logged_in = true;
		foreach($sessionvars as $svar){
			if(!isset($_SESSION[$svar])){
				$logged_in = false;
			}
		}
		if($logged_in){
			return true;
		}
		header('Location: '.$path);
	}
	
	public function load_model($model){
	    // Load the model
        if(file_exists(APP_PATH.'/'.MODELS.'/'.$model.'Model.php')){
            include(APP_PATH.'/'.MODELS.'/'.$model.'Model.php');
        }
        
        $this->$model =  new $model();
	}
}
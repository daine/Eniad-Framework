<?php
/**
 * Eniad Application Framework
 * A small, lightweight framework usable for very very small web apps
 * 
 * Config class
 * Handles all configuration options, as defined by the ini file
 * 
 * @author Daine Trinidad <daine@compilesource.com>
 * @copyright Daine Trinidad 2011
 * @access public
 * @since July 4, 2011
 * 
 */
class Config{
	
	private $ini;
	public $settings;
	
	/**
	 * 
	 * Config constructor
	 * @param String $app_ini Ini file that contains the configuration options 
	 */
	public function __construct($app_ini){
		$this->ini = $app_ini;
		$this->settings = parse_ini_file(APP_PATH.'/'.$app_ini, true);
	}
}
?>
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
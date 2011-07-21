<?php
/**
 * 
 * This is the logger
 * @author Daine Trinidad
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
class Logger{
	public $filename;
	public $folder;
	public $config;
	public function __construct($name){
		$this->config = new Config(APP_INI);
		$this->folder = $this->config->settings['logger']['folder'];
		$this->filename = $this->folder.$name;
		
	}
	
	public function error($message)
	{
		$this->write($message, 'ERROR');
	}

	public function debug($message)
	{
		if($this->config->settings['logger']['level'] == 2)
		{
			$this->write($message, 'DEBUG');
		}
	}

	private function write($message, $type)
	{
		if(file_exists($this->filename)){
			chmod($this->filename, 0660);
			chgrp($this->filename, 'linkshiftr');
		}
		$log_message = date('Y-m-d H:i:s')." [$type] $message \n";
		$fh = fopen($this->filename, 'a');
		fwrite($fh, $log_message);
		fclose($fh);
	}
}
<?php
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
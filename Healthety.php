<?php

require 'Healthety/WorkerSettings.php';

register_shutdown_function(array('Healthety', 'shutdownWorkers'));

class Healthety
{
	protected $_host;
	protected $_port;
	
	protected $_processes = array();
	protected $_php = '/usr/bin/env php';
	
	public function __construct($host = null, $port = null)
	{
		if (isset($host) && !empty($host)) {
			$this->_host = $host;
		} else {
			throw new Exception("No server given!");
		}
		
		if (isset($port) && !empty($port)) {
			$this->_port = $port;
		} else {
			throw new Exception("No port given!");
		}
	}
	
	public function spawnWorker(WorkerSettings $settings)
	{

		$workerFile = realpath('lib/' . $settings->template() . '.php');
		
		if (!file_exists($workerFile)) {
			throw new Exception("Template $settings->template() not found!");
		}
		
		$options = array(
			"--host $this->_host",
			"--port $this->_port",
			"--name ".$settings->name(),
			"--interval ".$settings->interval(),
			"--value '".$settings->value()."'"
		);
		
		$command = $this->_php .' '.$workerFile.' '.implode($options, ' ');
		$process = popen($command, "r");
		if (is_resource($process)) {
			$this->_processes[] = $process;
		}
		
		return $this;
	}
	
	public function run()
	{
		do {
		    sleep(1);
		} while (true);
	}
	
	public function shutdownWorkers()
	{
		echo "Shutdown " . count($this->_processes) . " Workers";
		foreach($this->_processes as $process) {
			proc_close($process);
		}
		echo "Finished.";
		exit(0);
	}
}
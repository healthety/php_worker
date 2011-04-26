<?php

date_default_timezone_set('UTC');

abstract class HealthetyWorkerTemplate
{
	protected $_name = 'unknown';
	protected $_interval = 1;
	protected $_value = 5;			
	
	protected $transmission = null;
	
	public function __construct(HealthetyWorkerTransmission $transmission, HealthetyWorkerOptions $options)
	{
		if ($options->getOption('name') !== false) {
			$this->_name = $options->getOption('name');
		}
		
		if ($options->getOption('interval') !== false) {
			$this->_interval = $options->getOption('interval');
		}
		
		if ($options->getOption('value') !== false) {
			$this->_value = $options->getOption('value');
		}
		
		if (isset($transmission) && !empty($transmission)) {
			$this->transmission = $transmission;
		} else {
			throw new Exception("No transmission given!");
		}
	}
	
	public function run()
	{
		do {
			$this->perform();
			sleep($this->_interval);
		} while (true);
	}
	
	public function send($result)
	{
		$created_at = date('D M j G:i:s e Y');
		$this->transmission->send($this->_name, $result, $created_at);
	}
	
	abstract public function perform();
	


}
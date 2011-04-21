<?php

class HealthetyWorkerTransmission
{

	public $server = '127.0.0.1';
    public $port = '41234';
    protected $_host = null;
	
	public function __construct(HealthetyWorkerOptions $options)
	{
		if ($options->getOption('host') !== false) {
			$this->server = $options->getOption('host');
		}
		
		if ($options->getOption('port') !== false) {
			$this->port = $options->getOption('port');
		}
		
		$this->_host = gethostname();
	}
	
	public function send($name, $value, $created_at)
	{
		$data = array (
			'name' => $name,
			'value' => $value,
			'created_at' => $created_at,
			'host' => $this->_host
		);
	
		$uri = 'udp://' . $this->server . ':' . $this->port;
		$socket = fsockopen($uri);
		fputs($socket, json_encode($data));
		fclose($socket);
	}
}
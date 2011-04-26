<?php

require dirname(__FILE__) . '/Worker.php';

class HealthetyWorkerSystem extends HealthetyWorkerTemplate
{
	public function perform()
	{
		$result = system($this->_value);
		$this->send(str_replace(',','.',$result));
	}
}

$options = new HealthetyWorkerOptions();
$transmission = new HealthetyWorkerTransmission($options);
$worker = new HealthetyWorkerSystem($transmission, $options);
$worker->run();
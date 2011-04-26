<?php

class WorkerSettings
{
	protected $_template;
	protected $_name;
	protected $_interval;
	protected $_value;
	
	public function template($template = null)
	{
		if(!empty($template)) {
			$this->_template = $template;
			return $this;
		} else {
			return $this->_template;
		}
	}
	
	public function name($name = null)
	{
		if(!empty($name)) {
			$this->_name = $name;
			return $this;
		} else {
			return $this->_name;
		}	
	}
	
	public function interval($interval = null)
	{
		if(!empty($interval)) {
			$this->_interval = $interval;
			return $this;
		} else {
			return $this->_interval;
		}
	}
	
	public function value($value = null)
	{
		if(!empty($value)) {
			$this->_value = $value;
			return $this;
		} else {
			return $this->_value;
		}
	}
}
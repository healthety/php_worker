<?php

require dirname(__FILE__) . '/OptionParser.php';

class HealthetyWorkerOptions
{
	protected $_parser = null;
	
	public function __construct()
	{
		$parser = new OptionParser();
		$this->_addUsage($parser);
		$args = $argv;
		
		try
		{
		    $parser->parse($args);
			$this->_checkFlags($parser);
			$this->_parser = $parser;
		} catch (Exception $e) {
			die($parser->getUsage());
		}
	}
	
	public function getOption($option)
	{
		return $this->_parser->getOption($option);
	}
	
	protected function _addUsage($parser)
	{
		$parser->addHead("Healthety PHP Worker\n");
		$parser->addHead("Usage: /usr/bin/env php " . basename($argv[0]) . " [ options ]\n");
		$parser->addRule('h|host:', "Healthety Server hostname / ip (default: localhost)");
		$parser->addRule('p|port:', "Healthety Server port (default: 41234)");
		$parser->addRule('n|name::', "Healthety Worker name");
		$parser->addRule('i|interval::', "Healthety Worker interval");
		$parser->addRule('v|value::', "Healthety Worker value");
	}
	
	protected function _checkFlags($parser)
	{
		if (!isset($parser->name)) {
		    die($parser->getUsage());
		}
		if (!isset($parser->interval)) {
		    die($parser->getUsage());
		}
		if (!isset($parser->value)) {
		    die($parser->getUsage());
		}
	}
}
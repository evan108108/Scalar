<?php
namespace Starship\Scalar;

use Starship\Scalar\Pipe as Pipe;

class ScalarObject
{
	private $_val;

	function __conStruct($arg)
	{
		$this->_val = $arg;
	}

	public function __call($name, $arguments)
	{
		$var = $this->_val;
		$haystack_found = false;
		
		array_walk($arguments,  function(&$arg) use($var, &$haystack_found) {
			if($arg == '___') { 	
				$arg = $var;
				$haystack_found = true;
				return;
			}
		});	

		if(!$haystack_found) {
			array_unshift($arguments, $var);
		}	

		return call_user_func_array($name, $arguments);
	}

	public function __invoke()
	{
		return new Pipe($this);
	}

	public function __toString()
	{
		return (String) $this->_val;
	}

	public function getVal()
	{
		return (String) $this->_val;
	}

	public function setVal($val)
	{
		$this->_val = $val;
		return true;
	}
}


<?php
namespace Starship\Scalar;

use Starship\Scalar\Pipe as Pipe;
use Starship\Scalar\MethodMapper as MethodMapper;

class ScalarObject
{
	private $_val;

	function __construct($arg)
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
			if(!isset(MethodMapper::$method_map[$name]))
				array_unshift($arguments, $var);
			else
				array_splice( $arguments, (MethodMapper::$method_map[$name]['haystack'] -1), 0, array($var) );
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

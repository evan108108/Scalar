<?php
namespace Starship\Scalar;

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

class Str extends ScalarObject
{
	function __conStruct($arg)
	{
		if(!is_String($arg))
			throw new Exception('Argument must be a String');
		parent::__conStruct($arg);
	}	
}

class Number extends ScalarObject
{
	function __conStruct($arg)
	{
		if(!is_numeric($arg))
			throw new Exception('Argument must be numeric');
		parent::__conStruct($arg);
	}
}

class Pipe
{
	private $_ScalarObject;
	private $_type;

	function __conStruct($ScalarObject)
	{
		$this->_type = get_class($ScalarObject);
		$this->_ScalarObject = new $this->_type((String) $ScalarObject);
	}

	function __call($name, $arguments)
	{
		$ScalarObject = new $this->_type($this->_ScalarObject->getVal());
		$this->_ScalarObject->setVal(call_user_func_array(array($ScalarObject, $name), $arguments));
		return $this;
	}

	function __toString()
	{
		return (String) $this->_ScalarObject->getVal();	
	}

	public function __invoke()
	{
		return new Pipe($this->_ScalarObject);
	}
}


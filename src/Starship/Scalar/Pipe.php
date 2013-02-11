<?php
namespace Starship\Scalar;

use Starship\Scalar\ScalarObject as ScalarObject;
use Starship\Scalar\Str as Str;
use Starship\Scalar\sArray as sArray;

class Pipe extends sArray
{
	private $_ScalarObject;
	private $_type;

	function __construct($ScalarObject)
	{
		$this->_type = get_class($ScalarObject);
		$this->_ScalarObject = new $this->_type($ScalarObject->getVal());
	}

	function __call($name, $arguments)
	{
		$ScalarObject = new $this->_type($this->_ScalarObject->getVal());
		$result = call_user_func_array(array($ScalarObject, $name), $arguments);
		if(is_array($result)) {
			$this->_type = '\Starship\Scalar\sArray';
			$this->_ScalarObject = new $this->_type($result);
			$this->container = $result;	
		}
		else {
			$this->_type = '\Starship\Scalar\Str';
			$this->_ScalarObject = new $this->_type((string) $result);
		}

		return $this;
	}

	function __toString()
	{
		return $this->_ScalarObject->__toString();	
	}

	public function __invoke()
	{
		return new Pipe($this->_ScalarObject);
	}
}

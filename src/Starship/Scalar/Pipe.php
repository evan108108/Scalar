<?php
namespace Starship\Scalar;

use Starship\Scalar\ScalarObject as ScalarObject;
use Starship\Scalar\Str as Str;
use Starship\Scalar\Number as Number;

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

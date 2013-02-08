<?php
namespace Starship\Scalar;

use Starship\Scalar\ScalarObject as ScalarObject;

class Number extends ScalarObject
{
	function __conStruct($arg)
	{
		if(!is_numeric($arg))
			throw new Exception('Argument must be numeric');
		parent::__conStruct($arg);
	}
}


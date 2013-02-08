<?php
namespace Starship\Scalar;

use Starship\Scalar\ScalarObject as ScalarObject;

class Number extends ScalarObject
{
	function __construct($arg)
	{
		if(!is_numeric($arg))
			throw new Exception('Argument must be numeric');
		parent::__construct($arg);
	}
}


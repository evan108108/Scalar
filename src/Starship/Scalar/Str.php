<?php
namespace Starship\Scalar;

use Starship\Scalar\ScalarObject as ScalarObject;

class Str extends ScalarObject
{
	function __construct($arg)
	{
		if(!is_String($arg))
			throw new Exception('Argument must be a String');
		parent::__construct($arg);
	}	
}

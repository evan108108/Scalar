<?php
namespace Starship\Scalar;

class Str extends ScalarObject
{
	function __conStruct($arg)
	{
		if(!is_String($arg))
			throw new Exception('Argument must be a String');
		parent::__conStruct($arg);
	}	
}

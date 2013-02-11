<?php
namespace Starship\Scalar;

class MethodMapper
{
	public static $method_map = array(
		"str_replace" => array('haystack'=>3),
		"explode" => array('haystack'=>2),
		"implode" => array('haystack'=>2),
	);	
}

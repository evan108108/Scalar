<?php

namespace Starship\Tests\Str;

use Starship\Scalar;

/** @test */
class StrTest extends TestCase
{
	public function testStringInstance()
	{
		$myString = new Str('This is a simple string');
		$this->assertTrue('This is a simple string' == $myString);
	}
}

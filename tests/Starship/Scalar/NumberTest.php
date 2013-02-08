<?php

namespace Starship\Scalar\Tests;

require __DIR__ . '/../../../../../autoload.php';

use \Starship\Scalar;

/** @test */
class NumberTest extends \PHPUnit_Framework_TestCase
{

	Const NUMBER_1 = '11';
	Const NUMBER_2 = '222';
	Const NUMBER_3 = '333';

	public function testStringInstance()
	{
		$myNumber = new \Starship\Scalar\Number(self::NUMBER_1);
		$this->assertTrue(self::NUMBER_1 == $myNumber
			, "Expecting '" . self::NUMBER_1 . "' but was '$myNumber'"
		);

		$myNumberTwo = new \Starship\Scalar\Number(self::NUMBER_2);
		$this->assertTrue(self::NUMBER_2 == $myNumberTwo
			, "Expecting '" . self::NUMBER_2 . "' but was '$myNumberTwo'"
		);

		$myNumberThree = new \Starship\Scalar\Number(self::NUMBER_3);
		$this->assertTrue(self::NUMBER_3 == $myNumberThree
			, "Expecting '" . self::NUMBER_3 . "' but was '$myNumberThree'"
		);
	}
}

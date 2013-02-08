<?php

namespace Starship\Scalar\Tests;

require __DIR__ . '/../../../../../autoload.php';

use \Starship\Scalar;

/** @test */
class StrTest extends \PHPUnit_Framework_TestCase
{

	Const STRING_1 = 'This is a simple string';
	Const STRING_2 = 'String 2 is a the second string';
	Const STRING_3 = 'Wow Starship Scalar Rules!';

	public function testStringInstance()
	{
		$myString = new \Starship\Scalar\Str(self::STRING_1);
		$this->assertEquals(self::STRING_1, $myString
			, "Expecting '" . self::STRING_1 . "' but was '$myString"
		);

		$myStringTwo = new \Starship\Scalar\Str(self::STRING_2);
		$this->assertEquals(self::STRING_2, $myStringTwo
			, "Expecting '" . self::STRING_2 . "' but was '$myStringTwo"
		);

		$myStringThree = new \Starship\Scalar\Str(self::STRING_3);
		$this->assertEquals(self::STRING_3, $myStringThree
			, "Expecting '" . self::STRING_3 . "' but was '$myStringThree"
		);
	}

	public function testMethodCalls()
	{	
		$myString = new \Starship\Scalar\Str(self::STRING_1);
		$this->assertEquals(strpos(self::STRING_1, '2'), $myString->strpos('2')
			, "Expecting ' . " . strpos(self::STRING_1, '2') . " . ' but was '{$myString->strpos('2')}'"
		);
		$this->assertEquals(self::STRING_1, $myString
				, "Expecting '" . self::STRING_1 . "' but was '$myString"
		);

		$myStringTwo = new \Starship\Scalar\Str(self::STRING_2);
		$this->assertEquals(strpos(self::STRING_2, '2'), $myStringTwo->strpos('2')
			, "Expecting '" . strpos(self::STRING_2, '2') . "' but was '{$myStringTwo->strpos('2')}'"
		);
		$this->assertEquals(self::STRING_2, $myStringTwo
			, "Expecting '" . self::STRING_2 . "' but was '$myStringTwo"
		);

		$myStringThree = new \Starship\Scalar\Str(self::STRING_3);
		$this->assertEquals(strpos(self::STRING_3, 'Starship'), $myStringThree->strpos('Starship')
			, "Expecting '" . strpos(self::STRING_3, 'Starship') . "' but was '{$myStringThree->strpos('Starship')}'"
		);
		$this->assertEquals(self::STRING_3, $myStringThree
			, "Expecting '" . self::STRING_3 . "' but was '$myStringThree"
		);

		$myString = new \Starship\Scalar\Str(self::STRING_1);
		$this->assertEquals(strlen(self::STRING_1), $myString->strlen()
			, "Expecting '" . strlen(self::STRING_1) . "' but was '{$myString->strlen()}'"
		);
		$this->assertEquals(self::STRING_1, $myString
			, "Expecting '" . self::STRING_1 . "' but was '$myString"
		);

	}

	public function testMethodPipedMethodCalls()
	{	
		$myString = new \Starship\Scalar\Str(self::STRING_1);
		$this->assertEquals(strlen(substr(self::STRING_1, 0, 6)), "{$myString()->substr(0, 6)->strlen()}"
			, "Expecting '" . strlen(substr(self::STRING_1, 0, 6)) . "' but was '{$myString()->substr(0, 6)->strlen()}'"
		);
		$this->assertEquals(self::STRING_1, $myString
			, "Expecting '" . self::STRING_1 . "' but was '$myString"
		);

		$myStringTwo = new \Starship\Scalar\Str(self::STRING_2);
		$this->assertEquals(strlen(substr(self::STRING_2, 0, 6)), "{$myStringTwo()->substr(0, 6)->strlen()}"
			, "Expecting '" . strlen(substr(self::STRING_2, 0, 6)) . "' but was '{$myStringTwo()->substr(0, 6)->strlen()}'"
		);
		$this->assertEquals(self::STRING_2, $myStringTwo
			, "Expecting '" . self::STRING_2 . "' but was '$myStringTwo"
		);

		$myStringThree = new \Starship\Scalar\Str(self::STRING_3);
		$this->assertEquals(strlen(substr(self::STRING_3, 0, 6)), "{$myStringThree()->substr(0, 6)->strlen()}"
			, "Expecting '" . strlen(substr(self::STRING_3, 0, 6)) . "' but was '{$myStringThree()->substr(0, 6)->strlen()}'"
		);
		$this->assertEquals(self::STRING_3, $myStringThree
			, "Expecting '" . self::STRING_3 . "' but was '$myStringThree"
		);
	}

	public function testMethodCallsWithTokenReplacement()
	{
		$myString = new \Starship\Scalar\Str(self::STRING_1);
		$this->assertEquals(str_replace('This', 'That', self::STRING_1), $myString->str_replace('This', 'That', '___')
				, "Expecting '" . str_replace('This', 'That', self::STRING_1) . "' but was '{$myString->str_replace('This', 'That', '___')}'"
			);
		$this->assertEquals(self::STRING_1, $myString
			, "Expecting '" . self::STRING_1 . "' but was '$myString"
		);

		$myStringTwo = new \Starship\Scalar\Str(self::STRING_2);
		$this->assertEquals(str_replace('String', 'Sting!', self::STRING_2), $myStringTwo->str_replace('String', 'Sting!', '___')
				, "Expecting '" . str_replace('String', 'Sting!', self::STRING_2) . "' but was '{$myStringTwo->str_replace('String', 'Sting!', '___')}'"
			);
		$this->assertEquals(self::STRING_2, $myStringTwo
			, "Expecting '" . self::STRING_2 . "' but was '$myStringTwo"
		);

		$myStringThree = new \Starship\Scalar\Str(self::STRING_3);
		$this->assertEquals(str_replace('Wow', 'Cow', self::STRING_3), $myStringThree->str_replace('Wow', 'Cow', '___')
				, "Expecting '" . str_replace('Wow', 'Cow', self::STRING_3) . "' but was '{$myStringThree->str_replace('Wow', 'Cow', '___')}'"
			);
		$this->assertEquals(self::STRING_3, $myStringThree
			, "Expecting '" . self::STRING_3 . "' but was '$myStringThree"
		);
	}

	public function testMethodCallsWithMethodMap()
	{
		$myString = new \Starship\Scalar\Str(self::STRING_1);
		$this->assertEquals(str_replace('This', 'That', self::STRING_1), $myString->str_replace('This', 'That')
				, "Expecting '" . str_replace('This', 'That', self::STRING_1) . "' but was '{$myString->str_replace('This', 'That')}'"
			);
		$this->assertEquals(self::STRING_1, $myString
			, "Expecting '" . self::STRING_1 . "' but was '$myString"
		);

		$myStringTwo = new \Starship\Scalar\Str(self::STRING_2);
		$this->assertEquals(str_replace('String', 'Sting!', self::STRING_2), $myStringTwo->str_replace('String', 'Sting!')
				, "Expecting '" . str_replace('String', 'Sting!', self::STRING_2) . "' but was '{$myStringTwo->str_replace('String', 'Sting!')}'"
			);
		$this->assertEquals(self::STRING_2, $myStringTwo
			, "Expecting '" . self::STRING_2 . "' but was '$myStringTwo"
		);

		$myStringThree = new \Starship\Scalar\Str(self::STRING_3);
		$this->assertEquals(str_replace('Wow', 'Cow', self::STRING_3), $myStringThree->str_replace('Wow', 'Cow', '___')
				, "Expecting '" . str_replace('Wow', 'Cow', self::STRING_3) . "' but was '{$myStringThree->str_replace('Wow', 'Cow')}'"
			);
		$this->assertEquals(self::STRING_3, $myStringThree
			, "Expecting '" . self::STRING_3 . "' but was '$myStringThree"
		);

	}
}

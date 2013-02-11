<?php

namespace Starship\Scalar\Tests;

require __DIR__ . '/../../../../../autoload.php';

use \Starship\Scalar;

/** @test */
class sArrayTest extends \PHPUnit_Framework_TestCase
{
	protected $Array_1 = array(1,2,3,4);
	protected $Array_2 = array(5,6,7,8);
	protected $Array_3 = array('one'=>'1st', 'second'=>'2nd', 'third'=>'3rd');

	public function testArrayInstance()
	{
		$myArray = new \Starship\Scalar\sArray($this->Array_1);
		$this->checkArrayVals($this->Array_1, $myArray);

		$myArray2 = new \Starship\Scalar\sArray($this->Array_2);
		$this->checkArrayVals($this->Array_2, $myArray2);

		$myArray3 = new \Starship\Scalar\sArray($this->Array_3);
		$this->checkArrayVals($this->Array_3, $myArray3);
	}

	public function testMethodCalls()
	{
		$myArray = new \Starship\Scalar\sArray($this->Array_1);
		$this->assertEquals(count($this->Array_1), $myArray->count()
			, "Expecting '" . count($this->Array_1) . "' but got '{$myArray->count()}'"
		);
		$this->checkArrayVals($this->Array_1, $myArray);

		$myArray2 = new \Starship\Scalar\sArray($this->Array_2);
		$this->assertEquals(array_merge($this->Array_2, $this->Array_1), $myArray2->array_merge($this->Array_1)
			, "Expecting '" . array_merge($this->Array_2, $this->Array_1) . "' but got '{$myArray2->array_merge($this->Array_1)}'"
		);
		$this->checkArrayVals($this->Array_2, $myArray2);

		$myArray3 = new \Starship\Scalar\sArray($this->Array_2);
		$masterValues = array_filter($this->Array_2, function($var){
			return($var & 1);
		});
		$testValues = $myArray3->array_filter(function($var){
			return($var & 1);
		});
		$this->checkArrayVals($masterValues, $testValues);
		$this->checkArrayVals($this->Array_2, $myArray3);
	}

	public function testMethodPipedCalls()
	{
		$myArray = new \Starship\Scalar\sArray($this->Array_2);
		$count = $myArray()->array_filter(function($var){
			return($var & 1);
		})->count();
		$this->assertEquals(2, "$count"
			, "Expecting 2 but got $count"
		);
		$this->checkArrayVals($this->Array_2, $myArray);

		$myArray2 = new \Starship\Scalar\sArray($this->Array_1);
		$count2 = $myArray2()->array_unshift(10)->count();
		$array_1 = $this->Array_1;
		array_unshift($array_1, 10);
		$masterCount = count($array_1);
			$this->assertEquals($masterCount, "$count2"
			, "Expecting $masterCount but got $count2"
		);
		$this->checkArrayVals($array_1, $myArray2()->array_unshift(10));
	}

	public function testMethodCallsWithTokenReplacement()
	{
		$myArray = new \Starship\Scalar\sArray($this->Array_1);
		$this->assertEquals(implode(',', $this->Array_1), "{$myArray->implode(',', '___')}"
			, "Expecting '" . implode(',', $this->Array_1) . "' but got {$myArray->implode(',', '___')}" 
		);
		$this->checkArrayVals($this->Array_1, $myArray);

		$myArray2 = new \Starship\Scalar\sArray($this->Array_2);
		$this->assertEquals(implode(',', $this->Array_2), "{$myArray2->implode(',', '___')}"
			, "Expecting '" . implode(',', $this->Array_2) . "' but got {$myArray2->implode(',', '___')}" 
		);
		$this->checkArrayVals($this->Array_2, $myArray2);

		$myArray3 = new \Starship\Scalar\sArray($this->Array_3);
		$this->assertEquals(implode(',', $this->Array_3), "{$myArray3->implode(',', '___')}"
			, "Expecting '" . implode(',', $this->Array_3) . "' but got {$myArray3->implode(',', '___')}" 
		);
		$this->checkArrayVals($this->Array_3, $myArray3);
	}

	public function testMethodCallsWithMethodMap()
	{
		$myArray = new \Starship\Scalar\sArray($this->Array_1);
		$this->assertEquals(implode(',', $this->Array_1), "{$myArray->implode(',')}"
			, "Expecting '" . implode(',', $this->Array_1) . "' but got {$myArray->implode(',')}" 
		);
		$this->checkArrayVals($this->Array_1, $myArray);

		$myArray2 = new \Starship\Scalar\sArray($this->Array_2);
		$this->assertEquals(implode(',', $this->Array_2), "{$myArray2->implode(',')}"
			, "Expecting '" . implode(',', $this->Array_2) . "' but got {$myArray2->implode(',')}" 
		);
		$this->checkArrayVals($this->Array_2, $myArray2);

		$myArray3 = new \Starship\Scalar\sArray($this->Array_3);
		$this->assertEquals(implode(',', $this->Array_3), "{$myArray3->implode(',', '___')}"
			, "Expecting '" . implode(',', $this->Array_3) . "' but got {$myArray3->implode(',')}" 
		);
		$this->checkArrayVals($this->Array_3, $myArray3);
	}

	private function checkArrayVals($masterValues, $testValues)
	{
		foreach($masterValues as $key=>$value) {
			$this->assertEquals($masterValues[$key], $testValues[$key]
				, "Expecting '{$masterValues[$key]}' but got '{$testValues[$key]}'"
			);
			$this->assertEquals($value, $testValues[$key]
				, "Expecting '{$value}' but got '{$testValues[$key]}'"
			);
		}

	}
}

<?php

namespace vierbergenlars\Form\Tests;

use vierbergenlars\Form\Util\NamedSet as Set;

require __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../vendor/vierbergenlars/simpletest/autorun.php';

class namedset extends \UnitTestCase {
	function testIterator()  {
		$set = new Set(array('a'=>array(1,2,3), 'b'=>array(4,5)));
		$expect = array(
			array('a',1),
			array('a',2),
			array('a',3),
			array('b',4),
			array('b',5),
		);
		$expect_row = 0;
		foreach($set as $key=>$value) {
			$this->assertEqual(array($key, $value), $expect[$expect_row++]);
		}
	}
	
	function testArrayAccess() {
		$set = new Set(array('a'=>array(1,2,3), 'b'=>array(4,5)));
		$this->assertEqual($set['a']->getArrayCopy(), array(1,2,3));
		$this->assertEqual($set['a'][0], 1);
		
		$set['a'][] = 4;
		$this->assertEqual($set['a'][3], 4);
		
		unset($set['b'][0]);
		$this->assertFalse(isset($set['b'][0]));
	}
}

<?php

namespace vierbergenlars\Form\Tests;

use vierbergenlars\Form\Error\ErrorSet as Set;
use vierbergenlars\Form\ErrorRule;
use vierbergenlars\Form\Field\Field;

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/vierbergenlars/simpletest/autorun.php';

class errorset extends \UnitTestCase {
	function testErrorSet() {
		$field = new Field('field', null);
		$field1 = new Field('field1', '8');
		$error = new Set(
			array(
				new ErrorRule\Email($field),
				new ErrorRule\Number($field),
				new ErrorRule\Required($field),
				new ErrorRule\String($field),
				new ErrorRule\String($field1),
			)				
		);
		$expect = array(
			array('field', 'vierbergenlars\Form\ErrorRule\Email'),
			array('field', 'vierbergenlars\Form\ErrorRule\Number'),
			array('field', 'vierbergenlars\Form\ErrorRule\Required'),
			array('field', 'vierbergenlars\Form\ErrorRule\String'),
			array('field1', 'vierbergenlars\Form\ErrorRule\String')
		);
		
		$expect_row = 0;
		
		foreach($error as $field=>$check) {
			$this->assertEqual($field, $expect[$expect_row][0]);
			$this->assertIsA($check, $expect[$expect_row][1]);
			$expect_row++;
		}
	}
	
	function testAddToErrorSet() {
		$error = new Set;
		$field = new Field('field0', 'do');
		$error->addError(new ErrorRule\Number($field));
		$error->addErrors(array(new ErrorRule\String($field)));
		
		$expect = array(
			array('field0', 'vierbergenlars\Form\ErrorRule\Number'),
			array('field0', 'vierbergenlars\Form\ErrorRule\String'),
		);
		
		$expect_row = 0;
		
		foreach($error as $field=>$check) {
			$this->assertEqual($field, $expect[$expect_row][0]);
			$this->assertIsA($check, $expect[$expect_row][1]);
			$expect_row++;
		}
	}

}

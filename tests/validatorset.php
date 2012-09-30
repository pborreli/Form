<?php

namespace vierbergenlars\Form\Tests;

use vierbergenlars\Form\Validator\ValidatorSet as Set;
use vierbergenlars\Form\Rule;

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/vierbergenlars/simpletest/autorun.php';

class validatorset extends \UnitTestCase {
	function testValidatorSet() {
		$validator = new Set(
			array(
				'username' => array(
					new Rule\Required,
					new Rule\String
				),
				'password' => array(
					new Rule\Required,
					new Rule\String
				),
				'email' => array(
					new Rule\Required,
					new Rule\Email
				)
			)
		);
		$expect = array(
			array('username', 'vierbergenlars\Form\Rule\Required'),
			array('username', 'vierbergenlars\Form\Rule\String'),
			array('password', 'vierbergenlars\Form\Rule\Required'),
			array('password', 'vierbergenlars\Form\Rule\String'),
			array('email', 'vierbergenlars\Form\Rule\Required'),
			array('email', 'vierbergenlars\Form\Rule\Email'),
		);
		
		$expect_row = 0;
		
		foreach($validator as $field=>$check) {
			$this->assertEqual($field, $expect[$expect_row][0]);
			$this->assertIsA($check, $expect[$expect_row][1]);
			$expect_row++;
		}
	}

}

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
		
		foreach($validator as $field=>$check) {
			var_dump($field, $check);
		}
	}

}

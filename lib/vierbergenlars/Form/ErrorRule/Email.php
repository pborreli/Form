<?php

namespace vierbergenlars\Form\ErrorRule;

use vierbergenlars\Form\Error\Error;
use vierbergenlars\Form\Field\Field;

class Email implements Error {
	private $field;
	function __construct(Field $field) {
		$this -> field = $field;
	}

	function getField() {
		return $this -> field;
	}

	function getMessage() {
		return 'This is an invalid email address.';
	}

}

<?php

namespace vierbergenlars\Form\ErrorRule;

use vierbergenlars\Form\Error\Error;
class Required extends Error {
	private $field;
	function __construct(Field $field) {
		$this -> field = $field;
	}

	function getField() {
		return $this -> field;
	}

	function getMessage() {
		return 'This field must be filled in.';
	}

}

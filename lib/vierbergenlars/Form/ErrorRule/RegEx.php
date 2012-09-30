<?php

namespace vierbergenlars\Form\ErrorRule;

use vierbergenlars\Form\Error\Error;
class RegEx extends Error {
	private $field;
	private $message;
	function __construct(Field $field, $message = 'This does not match the regex.') {
		$this->field = $field;
		$this->message = $message;
	}
	
	function getField() {
		return $this->field;
	}
	
	function getMessage() {
		return $this->message;
	}
}

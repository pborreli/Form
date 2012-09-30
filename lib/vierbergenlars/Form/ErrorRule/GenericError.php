<?php

namespace vierbergenlars\Form\ErrorRule;

use vierbergenlars\Form\Error\Error;
use vierbergenlars\Form\Field\Field;
class GenericError implements Error {
	private $field;
	private $message;
	function __construct(Field $field, $message) {
		$this->field = $field;
		$this->message = $message;
	}
	
	function getMessage() {
		return $this->message;
	}
	
	function getField() {
		return $this->field;
	}
}

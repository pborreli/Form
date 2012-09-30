<?php

namespace vierbergenlars\Form\ValidatorRule;

use vierbergenlars\Form\Validator\Validator;
use vierbergenlars\Form\Field\Field;
use vierbergenlars\Form\ErrorRule\RegEx as REError;

class RegEx implements Validator {
	private $regex;
	private $message;
	function __construct($regex, $message = 'This does not match the regex.') {
		$this -> regex = $regex;
		$this -> message = $message;
	}

	function isValid(Field $field) {
		if (!$field -> getValue())
			return true;
		$result = preg_match($this -> regex, $field -> getValue());

		if (preg_last_error() !== PREG_NO_ERROR) {
			return new REError($field, 'An error occured while checking the field');
		}

		return ($result == 1 ? true : new REError($field, $message));
	}

}

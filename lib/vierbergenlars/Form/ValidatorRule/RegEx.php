<?php

namespace vierbergenlars\Form\ValidatorRule;

use vierbergenlars\Form\Validator\Validator;

class RegEx implements Validator {
	private $regex;
	function __construct($regex) {
		$this -> regex = $regex;
	}

	function isValid($data) {
		if (!$data)
			return true;
		$result = preg_match($this -> regex, $data);

		if (preg_last_error() !== PREG_NO_ERROR) {
			throw new \LogicException('An error occured with the regex');
		}

		return ($result == 1);
	}

}

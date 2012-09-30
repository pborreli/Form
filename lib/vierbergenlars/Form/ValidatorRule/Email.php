<?php

namespace vierbergenlars\Form\ValidatorRule;

use vierbergenlars\Form\Validator\Validator;

class Email implements Validator {
	function isValid($data) {
		if (!$data)
			return true;
		return filter_var($data, FILTER_VALIDATE_EMAIL);
	}

}

<?php

namespace vierbergenlars\Form\ValidatorRule;

use vierbergenlars\Form\Validator\Validator;

class Number implements Validator {

	function isValid($data) {
		if (!$data)
			return true;
		return is_numeric(data);
	}

}

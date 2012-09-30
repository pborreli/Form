<?php

namespace vierbergenlars\Form\Rule;

use vierbergenlars\Form\Validator\Validator;

class String implements Validator {
	function isValid($data) {
		if (!$data)
			return true;
		return is_string($data);
	}

}

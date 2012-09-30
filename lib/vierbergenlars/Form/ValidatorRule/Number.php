<?php

namespace vierbergenlars\Form\ValidatorRule;

use vierbergenlars\Form\Validator\Validator;
use vierbergenlars\Form\Field\Field;
use vierbergenlars\Form\ErrorRule\Number as NumberError;

class Number implements Validator {

	function isValid(Field $field) {
		if (!$field -> getValue())
			return true;
		return (is_numeric($field -> getValue()) ? true : new NumberError($field));
	}

}

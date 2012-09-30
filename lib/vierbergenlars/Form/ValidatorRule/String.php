<?php

namespace vierbergenlars\Form\ValidatorRule;

use vierbergenlars\Form\Validator\Validator;
use vierbergenlars\Form\Field\Field;
use vierbergenlars\Form\ErrorRule\String as StringError;

class String implements Validator {
	function isValid(Field $field) {
		if (!$field -> getValue())
			return true;
		return (is_string($field -> getValue()) ? true : new StringError($field));
	}

}

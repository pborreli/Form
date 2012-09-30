<?php

namespace vierbergenlars\Form\ValidatorRule;

use vierbergenlars\Form\Validator\Validator;
use vierbergenlars\Form\Field\Field;
use vierbergenlars\Form\ErrorRule\Email as EmailError;

class Email implements Validator {
	function isValid(Field $field) {
		if (!$field -> getValue())
			return true;

		return (filter_var($field -> getValue(), FILTER_VALIDATE_EMAIL) ? true : new EmailError($field));
	}

}

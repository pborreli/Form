<?php
namespace vierbergenlars\Form;

use vierbergenlars\Form\Field\FieldSet;
use vierbergenlars\Form\Validator\ValidatorSet;
use vierbergenlars\Form\Error\ErrorSet;
use vierbergenlars\Form\ErrorRule\GenericError;
use vierbergenlars\Form\Field\Field;

class Form {
	protected $fields = null;
	protected $validators = null;
	protected $errors = null;
	function __construct(FieldSet $fields, ValidatorSet $validators, ErrorSet $errors) {
		$this -> fields = $fields;
		$this -> validators = $validators;
		$this -> errors = $errors;
	}

	function isValid() {
		foreach ($this->validators as $fieldname => $validator) {
			if (!isset($this -> fields[$fieldname])) {
				$field = null;
			} else {
				$field = $this -> fields[$fieldname];
			}
			$validation = $validator -> isValid($field);
			if ($validation instanceof Error) {
				$this -> errors -> addError($fieldname, $validation);
			} else if (!$validation) {
				$this -> errors -> addError($fieldname, new GenericError($field, 'Validation did not pass: ' . $validator));
			}
		}
		if ($this -> errors -> count() > 0) {
			return false;
		}
		return true;
	}

	function getFieldErrors(Field $field) {
		$fieldname = $field -> getName();
		if (!$this -> fields[$fieldname]) {
			throw new \LogicException('This field is not defined');
		}
		return $this -> errors[$fieldname];
	}

	function getFieldValidators(Field $field) {
		$fieldname = $field -> getName();
		if (!$this -> fields[$fieldname]) {
			throw new \LogicException('This field is not defined');
		}
		return $this -> validators[$fieldname];
	}

}

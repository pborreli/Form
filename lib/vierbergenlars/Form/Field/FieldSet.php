<?php

namespace vierbergenlars\Form\Field;

use vierbergenlars\Form\Util\NamedSet;

use vierbergenlars\Form\Validator\ValidatorSet;
use vierbergenlars\Form\Error\ErrorSet;
use vierbergenlars\Form\Error\Error;
use vierbergenlars\Form\ErrorRule\GenericError;

/**
 * A group of fields, typically a submitted form
 */
class FieldSet extends NamedSet {

	private $fields = array();
	/**
	 * Creates a new fieldset from an array
	 */
	function __construct(array $data) {
		parent::__construct();
		foreach ($data as $name => $value) {
			$this -> addField(new Field($name, $value));
		}
	}
	
	/**
	 * Adds a new field to the set
	 * 
	 * @param Field $field The field to add.
	 */

	function addField(Field $field) {
		$this -> fields[$field -> getName()] = $field;
		$this->addToSet($field->getName(), $field);
	}
	
	function validate(ValidatorSet $validators, ErrorSet $errors) {
		foreach($validators as $fieldname => $validator) {
			if(!isset($this->fields[$fieldname])) {
				$field = null;
			}
			else {
				$field = $this->fields[$fieldname];
			}
			$validation = $validator->isValid($field);
			if($validation instanceof Error) {				
				$errors->addError($field, $validation);
			}
			else if(!$validation) {
				$errors->addError($field, new GenericError($field, 'Validation did not pass: '.$validator));
			}
		}
		if($errors->count() > 0){
			return false;
		}
		return true;
	}
	
	/**
	 * Creates a new fieldset from the $_POST global
	 * 
	 * @return vierbergenlars\Form\Field\FieldSet
	 */
	static function createFromGlobals() {
		return new self($_POST);
	}

}

<?php

namespace vierbergenlars\Form\Field;

use vierbergenlars\Form\Validator;

/**
 * A single field.
 */
class Field {
	private $name;
	private $value;
	/**
	 * Creates a new Field
	 * 
	 * @param string $name The identifier of the field
	 * @param mixed $value The value of the field
	 */
	function __construct($name, $value) {
		if(!is_string($name)) {
			throw new \LogicException('A field name must be a string');
		}
		$this->name = $name;
		$this->value = $value;
	}
	
	/**
	 * Gets the name of the field
	 * @return string
	 */
	function getName() {
		return $this->name;
	}
	
	/**
	 * Gets the value of the field
	 * @return mixed
	 */
	function getValue() {
		return $this->value;
	}
	
	/**
	 * Checks if the field is valid
	 * @param Validator $validator The validator to use
	 * @return vierbergenlars\Form\Error\Error|bool
	 */
	function isValid(Validator $validator) {
		return $validator->isValid($this);
	}
}

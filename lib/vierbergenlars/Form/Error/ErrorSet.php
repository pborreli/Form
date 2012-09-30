<?php

namespace vierbergenlars\Form\Error;

use vierbergenlars\Form\Util\NamedSet;

/**
 * A group of errors
 */
class ErrorSet extends NamedSet {

	private $errors = array();

	/**
	 * Creates a new errorset from an array
	 * @param array $data An array of field names to an array of errors
	 */
	function __construct(array $data = array()) {
		parent::__construct();
		foreach ($data as $name => $errors) {
			if (is_array($errors)) {
				$this -> addErrors($name, $errors);
			} else {
				$this -> addError($name, $errors);
			}
		}
	}

	/**
	 * Adds a set of errors for a field
	 *
	 * @param string $name The field name
	 * @param array $errors The errors to add
	 */
	function addErrors($name, array $errors) {
		foreach ($errors as $error) {
			$this -> addError($name, $error);
		}
	}

	/**
	 * Adds a error for a field
	 *
	 * @param string $name The field name
	 * @param Error $error The error to add
	 */
	function addError($name, Error $error) {
		$this -> errors[$name][] = $error;
		$this -> addToSet($name, $error);
	}

}

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
	 * @param array $data An array of errors
	 */
	function __construct(array $data = array()) {
		parent::__construct();
		$this->addErrors($data);
	}

	/**
	 * Adds a set of errors for a field
	 *
	 * @param array $errors The errors to add
	 */
	function addErrors(array $errors) {
		foreach ($errors as $error) {
			$this -> addError( $error);
		}
	}

	/**
	 * Adds a error for a field
	 *
	 * @param string $name The field name
	 * @param Error $error The error to add
	 */
	function addError(Error $error) {
		$name = $error->getField()->getName();
		$this -> errors[$name][] = $error;
		$this -> addToSet($name, $error);
	}

}

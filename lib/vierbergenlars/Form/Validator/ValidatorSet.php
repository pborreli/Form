<?php

namespace vierbergenlars\Form\Validator;

use vierbergenlars\Form\Util\NamedSet;

/**e
 * A group of validators
 */
class ValidatorSet extends NamedSet {

	private $validators = array();

	/**
	 * Creates a new validatorset from an array
	 */
	function __construct(array $data) {
		parent::__construct();
		foreach ($data as $name => $validators) {
			if (is_array($validators)) {
				$this -> addValidators($name, $validators);
			} else {
				$this -> addValidator($name, $validators);
			}
		}
	}

	/**
	 * Adds a set of validators for a field
	 *
	 * @param string $name The field name
	 * @param array $validators The validators to add
	 */
	function addValidators($name, array $validators) {
		foreach ($validators as $validator) {
			$this -> addValidator($name, $validator);
		}
	}

	/**
	 * Adds a validator for a field
	 *
	 * @param string $name The field name
	 * @param Validator $validator The validator to add
	 */
	function addValidator($name, Validator $validator) {
		$this -> validators[$name][] = $validator;
		$this -> addToSet($name, $validator);
	}

}

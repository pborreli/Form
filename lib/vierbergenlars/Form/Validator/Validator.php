<?php

namespace vierbergenlars\Form\Validator;

/**
 * Common interface for all form validators
 */
interface Validator {

	/**
	 * Checks wether the form is valid.
	 *
	 * @param mixed $data The data to verify
	 * @return bool
	 */
	function isValid($data);
}

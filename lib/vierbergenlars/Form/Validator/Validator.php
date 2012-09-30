<?php

namespace vierbergenlars\Form\Validator;

use vierbergenlars\Form\Field\Field;

/**
 * Common interface for all form validators
 */
interface Validator {

	/**
	 * Checks wether the form is valid.
	 *
	 * @param Field $data The field to verify
	 * @return vierbergenlars\Form\Error\Error|bool
	 */
	function isValid(Field $data);
}

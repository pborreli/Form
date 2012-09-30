<?php
namespace vierbergenlars\Form\Error;

/**
 * Common interface for all form validation errors
 */
interface Error {
	/**
	 * Gets the error message
	 * @return string
	 */
	function getMessage();
	/**
	 * Gets the field that errored
	 * @return vierbergenlars\Form\Field\Field
	 */
	function getField();
}

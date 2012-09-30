<?php

namespace vierbergenlars\Form\Util;

class ArrayObject extends \ArrayObject {
	function __construct(array $array) {
		parent::__construct(self::makeArrayObject($array));
	}

	private static function makeArrayObject($array) {
		if (is_array($array)) {
			$return = array();

			foreach ($array as $key => $value) {
				$return[$key] = self::makeArrayObject($value);
			}
			return new \ArrayObject($return);
		} else {
			return $array;
		}
	}

	function __call($func, $argv) {
		if (!is_callable($func) || substr($func, 0, 6) !== 'array_') {
			throw new BadMethodCallException(__CLASS__ . '->' . $func);
		}
		return call_user_func_array($func, array_merge(array($this -> getArrayCopy()), $argv));
	}

}

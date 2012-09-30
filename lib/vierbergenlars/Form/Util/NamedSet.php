<?php

namespace vierbergenlars\Form\Util;

use vierbergenlars\Form\Util\ArrayObject;

class NamedSet implements \ArrayAccess, \Iterator {
	/**
	 * The name of the current set
	 * @var string
	 */
	private $current_set = null;
	/**
	 * The id of the current set in set_keys
	 * @var int
	 */
	private $current_set_id = 0;
	/**
	 * The id of the current subset
	 * @var int
	 */
	private $current_id = 0;
	/**
	 * The length of all subsets
	 * @var array
	 */
	private $set_lengths = array();
	/**
	 * The keys of the set
	 * @var array
	 */
	private $set_keys = array();
	/**
	 * The set
	 * @var array
	 */
	private $set = array();
	/**
	 * The length of the set
	 * @var int
	 */
	private $length = 0;

	function __construct(array $set = array()) {
		$this -> set = new ArrayObject($set);
		$this -> setUpSet();
	}

	function addToSet($name, $value) {
		if (!isset($this -> set[$name]))
			$this -> set[$name] = new ArrayObject( array());
		$this -> set[$name][] = $value;
		$this -> setUpSet();
	}

	private function setUpSet() {
		$this -> set_keys = $this -> set -> array_keys();
		foreach ($this->set as $key => $value) {
			$this -> set_lengths[$key] = $value -> count();
		}
		$this -> length = count($this -> set_keys);
		if ($this -> length > 0)
			$this -> current_set = $this -> set_keys[0];
	}

	function current() {
		return $this -> set[$this -> current_set][$this -> current_id];
	}

	function key() {
		return $this -> current_set;
	}

	function next() {
		$this -> current_id++;
		if ($this -> current_id + 1 > $this -> set_lengths[$this -> current_set]) {
			$this -> current_id = 0;
			$this -> current_set_id++;
			if (!($this -> current_set_id + 1 > $this -> length)) {
				$this -> current_set = $this -> set_keys[$this -> current_set_id];
			}
		}
	}

	function rewind() {
		$this -> current_id = 0;
		if ($this -> length > 0)
			$this -> current_set = $this -> set_keys[0];
		$this -> current_set_id = 0;
	}

	function valid() {
		if ($this -> current_set_id + 1 > $this -> length)
			return false;
		if ($this -> current_id + 1 > $this -> set_lengths[$this -> current_set])
			return false;
		return true;
	}

	function offsetExists($offset) {
		return isset($this -> set[$offset]);
	}

	function offsetGet($offset) {
		return $this -> set[$offset];
	}

	function offsetSet($offset, $value) {
		$this -> set[$offset] = $value;
		$this -> setUpSet();
	}

	function offsetUnset($offset) {
		unset($this -> set[$offset]);
		$this -> setUpSet();
	}

}

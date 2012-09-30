<?php

namespace vierbergenlars\Form\Util;

use vierbergenlars\Form\Util\ArrayObject;

class NamedSet implements \ArrayAccess, \Iterator {
	/**
	 * The name of the current set
	 * @var string
	 */
	public $current_set = null;
	/**
	 * The id of the current set in set_keys
	 * @var int
	 */
	public $current_set_id = 0;
	/**
	 * The id of the current subset
	 * @var int
	 */
	public $current_id = 0;
	/**
	 * The length of all subsets
	 * @var array
	 */
	public $set_lengths = array();
	/**
	 * The keys of the set
	 * @var array
	 */
	public $set_keys = array();
	/**
	 * The set
	 * @var array
	 */
	public $set = array();
	/**
	 * The length of the set
	 * @var int
	 */
	public $length = 0;

	function __construct($set) {
		$this -> set = new ArrayObject($set);
		$this -> setUpSet();
	}

	private function setUpSet() {
		$this -> set_keys = $this -> set->array_keys();
		foreach ($this->set as $key => $value) {
			$this -> set_lengths[$key] = $value->count();
		}
		$this -> current_set = $this -> set_keys[0];
		$this -> length = count($this -> set_keys);
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

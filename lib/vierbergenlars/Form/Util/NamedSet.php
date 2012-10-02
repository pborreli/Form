<?php

namespace vierbergenlars\Form\Util;

use vierbergenlars\Form\Util\ArrayObject;

class NamedSet implements \ArrayAccess, \Iterator
{
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

    public function __construct(array $set = array())
    {
        $this -> set = new ArrayObject($set);
        $this -> setUpSet();
    }

    public function addToSet($name, $value)
    {
        if (!isset($this -> set[$name]))
            $this -> set[$name] = new ArrayObject( array());
        $this -> set[$name][] = $value;
        $this -> setUpSet();
    }

    private function setUpSet()
    {
        $this -> set_keys = $this -> set -> array_keys();
        foreach ($this->set as $key => $value) {
            $this -> set_lengths[$key] = $value -> count();
        }
        $this -> length = count($this -> set_keys);
        if ($this -> length > 0)
            $this -> current_set = $this -> set_keys[0];
    }

    public function current()
    {
        return $this -> set[$this -> current_set][$this -> current_id];
    }

    public function key()
    {
        return $this -> current_set;
    }

    public function next()
    {
        $this -> current_id++;
        if ($this -> current_id + 1 > $this -> set_lengths[$this -> current_set]) {
            $this -> current_id = 0;
            $this -> current_set_id++;
            if (!($this -> current_set_id + 1 > $this -> length)) {
                $this -> current_set = $this -> set_keys[$this -> current_set_id];
            }
        }
    }

    public function rewind()
    {
        $this -> current_id = 0;
        if ($this -> length > 0)
            $this -> current_set = $this -> set_keys[0];
        $this -> current_set_id = 0;
    }

    public function valid()
    {
        if ($this -> current_set_id + 1 > $this -> length)
            return false;
        if ($this -> current_id + 1 > $this -> set_lengths[$this -> current_set])
            return false;
        return true;
    }

    public function offsetExists($offset)
    {
        if ($offset instanceof Named) {
            $offset = $offset -> getName();
        }

        return isset($this -> set[$offset]);
    }

    public function offsetGet($offset)
    {
        if ($offset instanceof Named) {
            $offset = $offset -> getName();
        }

        return $this -> set[$offset];
    }

    public function offsetSet($offset, $value)
    {
        if ($offset instanceof Named) {
            $offset = $offset -> getName();
        }
        $this -> set[$offset] = $value;
        $this -> setUpSet();
    }

    public function offsetUnset($offset)
    {
        if ($offset instanceof Named) {
            $offset = $offset -> getName();
        }
        unset($this -> set[$offset]);
        $this -> setUpSet();
    }

    public function count()
    {
        return $this -> length;
    }

}

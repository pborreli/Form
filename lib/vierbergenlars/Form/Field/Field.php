<?php

namespace vierbergenlars\Form\Field;

use vierbergenlars\Form\Validator;
use vierbergenlars\Form\Util\Named;

/**
 * A single field.
 */
class Field implements Named
{
    private $name;
    private $value;
    /**
     * Creates a new Field
     *
     * @param string $name  The identifier of the field
     * @param mixed  $value The value of the field
     */
    public function __construct($name, $value = null)
    {
        if (!is_string($name)) {
            throw new \LogicException('A field name must be a string');
        }
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Gets the name of the field
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the value of the field
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the value of the field
     * @param mixed $value The value of the field
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Checks if the field is valid
     * @param  Validator                            $validator The validator to use
     * @return vierbergenlars\Form\Error\Error|bool
     */
    public function isValid(Validator $validator)
    {
        return $validator->isValid($this);
    }

}

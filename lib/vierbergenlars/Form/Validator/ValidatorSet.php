<?php

namespace vierbergenlars\Form\Validator;

use vierbergenlars\Form\Util\NamedSet;
use vierbergenlars\Form\Field\Field;

/**
 * A group of validators
 */
class ValidatorSet extends NamedSet
{
    private $validators = array();

    /**
     * Creates a new validatorset from an array
     * @param array $data An array of field names to an array of validators
     */
    public function __construct(array $data = array())
    {
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
     * @param string|Field $name       The field name
     * @param array        $validators The validators to add
     */
    public function addValidators($name, array $validators)
    {
        if ($name instanceof Field) {
            $name = $name->getName();
        }
        foreach ($validators as $validator) {
            $this -> addValidator($name, $validator);
        }
    }

    /**
     * Adds a validator for a field
     *
     * @param string|Field $name      The field name
     * @param Validator    $validator The validator to add
     */
    public function addValidator($name, Validator $validator)
    {
        if ($name instanceof Field) {
            $name = $name->getName();
        }
        $this -> validators[$name][] = $validator;
        $this -> addToSet($name, $validator);
    }

}

<?php

namespace vierbergenlars\Form\Field;

use vierbergenlars\Form\Util\NamedSet;

/**
 * A group of fields, typically a submitted form
 */
class FieldSet extends NamedSet
{

    private $fields = array();
    /**
     * Creates a new fieldset from an array
     */
    public function __construct(array $data = array())
    {
        parent::__construct();
        foreach ($data as $name => $value) {
            if ($value instanceof Field) {
                $this -> addField($value);
            } else {
                $this -> addField(new Field($name, $value));
            }
        }
    }

    /**
     * Adds a new field to the set
     *
     * @param Field $field The field to add.
     */

    public function addField(Field $field)
    {
        $this -> fields[$field -> getName()] = $field;
        $this -> addToSet($field -> getName(), $field);
    }

    /**
     * Creates a new fieldset from the $_POST global
     *
     * @return vierbergenlars\Form\Field\FieldSet
     */
    public static function createFromGlobals()
    {
        return new self($_POST);
    }

}

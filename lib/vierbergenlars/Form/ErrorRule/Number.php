<?php

namespace vierbergenlars\Form\ErrorRule;

use vierbergenlars\Form\Error\Error;
use vierbergenlars\Form\Field\Field;

class Number implements Error
{
    private $field;
    public function __construct(Field $field)
    {
        $this -> field = $field;
    }

    public function getField()
    {
        return $this -> field;
    }

    public function getMessage()
    {
        return 'This is not a valid number.';
    }

}

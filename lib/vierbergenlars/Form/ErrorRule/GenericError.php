<?php

namespace vierbergenlars\Form\ErrorRule;

use vierbergenlars\Form\Error\Error;
use vierbergenlars\Form\Field\Field;

class GenericError implements Error
{
    private $field;
    private $message;
    public function __construct(Field $field, $message)
    {
        $this->field = $field;
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getField()
    {
        return $this->field;
    }
}

<?php

namespace vierbergenlars\Form\ErrorRule;

use vierbergenlars\Form\Error\Error;
use vierbergenlars\Form\Field\Field;

class RegEx implements Error
{
    private $field;
    private $message;
    public function __construct(Field $field, $message = 'This does not match the regex.')
    {
        $this->field = $field;
        $this->message = $message;
    }

    public function getField()
    {
        return $this->field;
    }

    public function getMessage()
    {
        return $this->message;
    }
}

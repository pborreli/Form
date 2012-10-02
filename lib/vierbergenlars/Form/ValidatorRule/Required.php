<?php

namespace vierbergenlars\Form\ValidatorRule;

use vierbergenlars\Form\Validator\Validator;
use vierbergenlars\Form\Field\Field;
use vierbergenlars\Form\ErrorRule\Required as ReqError;

class Required implements Validator
{
    public function isValid(Field $field)
    {
        return (!!$field->getValue()? true: new ReqError($field));
    }

}

<?php
namespace vierbergenlars\Form;

use vierbergenlars\Form\Field\FieldSet;
use vierbergenlars\Form\Validator\ValidatorSet;
use vierbergenlars\Form\Error\ErrorSet;
use vierbergenlars\Form\ErrorRule\GenericError;
use vierbergenlars\Form\Field\Field;

class Form
{
    protected $fields = null;
    protected $validators = null;
    protected $errors = null;
    /**
     * Creates a new form class
     *
     * @param FieldSet     $fields     The fieldset that contains all submitted fields
     * @param ValidatorSet $validators The validators to run on the field
     * @param ErrorSet     $errors     The errorset to fill with errors
     */
    public function __construct(FieldSet $fields, ValidatorSet $validators, ErrorSet $errors = null)
    {
        $this -> fields = $fields;
        $this -> validators = $validators;
        $this -> errors = $errors;
        if ($errors === null) {
            $this -> errors = new ErrorSet;
        }
        $this -> checkValid();
    }

    protected function checkValid()
    {
        foreach ($this->validators as $fieldname => $validator) {
            if (!isset($this -> fields[$fieldname])) {
                $field = null;
            } else {
                $field = $this -> fields[$fieldname];
            }
            $validation = $validator -> isValid($field);
            if ($validation instanceof Error) {
                $this -> errors -> addError($fieldname, $validation);
            } elseif (!$validation) {
                $this -> errors -> addError($fieldname, new GenericError($field, 'Validation did not pass: ' . $validator));
            }
        }
    }

    /**
     * Checks whether the form is valid
     * @return bool
     */
    public function isValid()
    {
        if ($this -> errors -> count() > 0) {
            return false;
        }

        return true;
    }

    /**
     * Retrieves errors for a specific field
     */
    public function getFieldErrors(Field $field)
    {
        $fieldname = $field -> getName();
        if (!$this -> fields[$fieldname]) {
            throw new \LogicException('This field is not defined');
        }

        return $this -> errors[$fieldname];
    }

    public function getFieldValidators(Field $field)
    {
        $fieldname = $field -> getName();
        if (!$this -> fields[$fieldname]) {
            throw new \LogicException('This field is not defined');
        }

        return $this -> validators[$fieldname];
    }

}

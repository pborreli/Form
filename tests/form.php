<?php

namespace vierbergenlars\Form\Tests;

use vierbergenlars\Form\Field;
use vierbergenlars\Form\Validator;
use vierbergenlars\Form\ValidatorRule;
use vierbergenlars\Form\Form as Frm;

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/vierbergenlars/simpletest/autorun.php';

class form extends \UnitTestCase
{
    public function testForm()
    {
        $username = new Field\Field('username');
        $password = new Field\Field('password');
        $email = new Field\Field('email');
        $fields = new Field\FieldSet;
        $fields->addField($username);
        $fields->addField($password);
        $fields->addField($email);

        $validators = new Validator\ValidatorSet;
        $validators->addValidator($username, new ValidatorRule\Required);
        $validators->addValidator($username, new ValidatorRule\String);
        $validators->addValidators($password, array(
            new ValidatorRule\Required,
            new ValidatorRule\String
        ));
        $validators->addValidator($email, new ValidatorRule\Email);

        $form = new Frm($fields, $validators);
    }

}

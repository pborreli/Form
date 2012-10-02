<?php

namespace vierbergenlars\Form\Tests;

use vierbergenlars\Form\Validator\ValidatorSet as Set;
use vierbergenlars\Form\ValidatorRule;

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/vierbergenlars/simpletest/autorun.php';

class validatorset extends \UnitTestCase
{
    public function testValidatorSet()
    {
        $validator = new Set(
            array(
                'username' => array(
                    new ValidatorRule\Required,
                    new ValidatorRule\String
                ),
                'password' => array(
                    new ValidatorRule\Required,
                    new ValidatorRule\String
                ),
                'email' => array(
                    new ValidatorRule\Required,
                    new ValidatorRule\Email
                )
            )
        );
        $expect = array(
            array('username', 'vierbergenlars\Form\ValidatorRule\Required'),
            array('username', 'vierbergenlars\Form\ValidatorRule\String'),
            array('password', 'vierbergenlars\Form\ValidatorRule\Required'),
            array('password', 'vierbergenlars\Form\ValidatorRule\String'),
            array('email', 'vierbergenlars\Form\ValidatorRule\Required'),
            array('email', 'vierbergenlars\Form\ValidatorRule\Email'),
        );

        $expect_row = 0;

        foreach ($validator as $field=>$check) {
            $this->assertEqual($field, $expect[$expect_row][0]);
            $this->assertIsA($check, $expect[$expect_row][1]);
            $expect_row++;
        }
    }

    public function testAddToValidatorSet()
    {
        $validator = new Set;

        $validator->addValidator('field0', new ValidatorRule\Number);
        $validator->addValidators('field0', array(new ValidatorRule\Required, new ValidatorRule\String));

        $expect = array(
            array('field0', 'vierbergenlars\Form\ValidatorRule\Number'),
            array('field0', 'vierbergenlars\Form\ValidatorRule\Required'),
            array('field0', 'vierbergenlars\Form\ValidatorRule\String'),
        );

        $expect_row = 0;

        foreach ($validator as $field=>$check) {
            $this->assertEqual($field, $expect[$expect_row][0]);
            $this->assertIsA($check, $expect[$expect_row][1]);
            $expect_row++;
        }
    }

}

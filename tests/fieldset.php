<?php

namespace vierbergenlars\Form\Tests;

use vierbergenlars\Form\Field\FieldSet as Set;
use vierbergenlars\Form\Field\Field;

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/vierbergenlars/simpletest/autorun.php';

class fieldset extends \UnitTestCase
{
    public function testFieldSet()
    {
        $field = new Set(array(
            new Field('field0', '0'),
            new Field('field2', '1')
        ));
        $expect = array(
            array('field0', '0'),
            array('field2', '1'),
        );
        $expect_row = 0;
        foreach ($field as $name=>$value) {
            $this->assertEqual($name, $expect[$expect_row][0]);
            $this->assertTrue($value instanceof Field);
            $this->assertEqual($value->getValue(), $expect[$expect_row][1]);
            $expect_row++;
        }
    }

    public function testAddToFieldSet()
    {
        $field = new Set;
        $field->addField(new Field('field1', '8'));
        $field->addField(new Field('field8', '5'));
        $expect = array(
            array('field1', '8'),
            array('field8', '5'),
        );
        $expect_row = 0;
        foreach ($field as $name=>$value) {
            $this->assertEqual($name, $expect[$expect_row][0]);
            $this->assertTrue($value instanceof Field);
            $this->assertEqual($value->getValue(), $expect[$expect_row][1]);
            $expect_row++;
        }
    }

}

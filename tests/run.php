<?php

namespace vierbergenlars\Form\Tests;

require __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../vendor/vierbergenlars/simpletest/autorun.php';

class TestSuite extends \TestSuite
{
    public function __construct()
    {
        parent::__construct('Form validator test suite');
        $this->addFile(__DIR__.'/namedset.php');
        $this->addFile(__DIR__.'/validatorset.php');
        $this->addFile(__DIR__.'/fieldset.php');
        $this->addFile(__DIR__.'/errorset.php');
        $this->addFile(__DIR__.'/form.php');
    }
}

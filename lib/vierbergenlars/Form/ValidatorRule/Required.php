<?php

namespace vierbergenlars\Form\ValidatorRule;

use vierbergenlars\Form\Validator\Validator;

class Required implements Validator {

	function isValid($data) {
		return (!!$data);
	}

}

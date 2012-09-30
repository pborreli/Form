<?php

namespace vierbergenlars\Form\Rule;

use vierbergenlars\Form\Validator\Validator;

class Required implements Validator {

	function isValid($data) {
		return (!!$data);
	}

}

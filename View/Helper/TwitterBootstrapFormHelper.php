<?php

App::uses('FormHelper', 'View/Helper');

/**
 * Bootstrap form helper for forms
 */
class TwitterBootstrapFormHelper extends FormHelper {

/**
 * Adds form button style for bootstrap, processes everthing else according to normal form end
 * 
 * @param string|array $options as a string will use $options as the value of button,
 * @return string a closing FORM tag optional submit button.
 */
	public function end($options = null) {
		if (!is_array($options)) {
			$options = array();
		}
		if (!isset($options['class'])) {
			$options['class'] = 'btn btn-success';
		}
		else {
			$options['class'] .= 'btn btn-success';
		}
		return parent::end($options);
	}
}
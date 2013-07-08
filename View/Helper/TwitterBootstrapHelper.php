<?php

App::uses('AppHelper', 'View/Helper');

/**
 * Bootstrap helper
 */
class TwitterBootstrapHelper extends AppHelper {

/**
 * Helper dependencies
 *
 * @var array
 */
	public $helpers = array('Html', 'Session');

/**
 * html tags used by this helper.
 *
 * @var array
 */
	protected $_tags = array(
		'icon' => '<i class="icon-%s"></i>',
		'icon-text' => '<i class="icon-%s"></i> %s',
	);

/**
 * Simple Icon
 * 
 * @param string $icon Icon to use eg: pencil, trash, etc
 * @param string $text Text to be placed right of icon. Optional
 * @param string|array $url Cake-relative URL or array of URL parameters, or external URL (starts with http://)
 * @return string Icon
 */
	public function icon($icon, $text = null) {
		
		// get icon
		if ($text) {
			return sprintf($this->_tags['icon-text'], $icon, $text);
		}
		else {
			return sprintf($this->_tags['icon'], $icon);
		}
	}

/**
 * Output flash messages
 * 
 * @param mixed $keys Flash messages to display
 *						- false: Display all (Default)
 *						- string: Name of key to display
 *						- array: Array of keys to display
 */
	public function flash($keys = false) {
		
		$messages = array();
		
		// keys given
		if ($keys) {
			if (!is_array($keys)) {
				$keys = array($keys);
			}
			
			// get keys info
			foreach ($keys as $key) {
				$messages[$key] = $this->Session->read('Message.' . $key);
			}
		}
		// get all available keys
		else {
			$messages = $this->Session->read('Message');
		}
		
		$html = '';
		
		// if there are messages
		if (!empty($messages)) {
			foreach ($messages as $key => $message) {
				
				// default flash messages are rendered as success messages
				if ($key == 'flash') {
					$type = 'success';
				}
				else {
					$type = $key;
				}
				
				// get flash message
				$html .= $this->Session->flash($key, array(
					'element' => 'TwitterBootstrap.flash',
					'params' => array(
						'type' => $type
					)
				));
			}
		}
		
		return $html;
	}

}
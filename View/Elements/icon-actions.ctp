<?php
/**
 * Actions elemement
 * 
 * All urls not passed icons are ignored 
 * All urls are Cake-relative URLs or array of URL parameters, or external URL (starts with http://)
 * 
 * @uses $view View url
 * @uses $edit Edit url
 * @uses $delete Delete url
 * @uses $delete_confirm Delete confirm message
 */

if (isset($view)) {
	echo $this->Html->link($this->Boot->icon('eye-open'), $view, array('escape' => false, 'title' => __('View')));
}

if (isset($edit)) {
	echo $this->Html->link($this->Boot->icon('pencil'), $edit, array('escape' => false, 'title' => __('Edit')));
}

if (isset($delete)) {
	if (isset($delete_confirm)) {
		$confirm = $delete_confirm;
	}
	else {
		$confirm = false;
	}
	echo $this->Form->postLink($this->Boot->icon('trash'), $delete, array('escape' => false, 'title' => __('Delete')), $confirm);
}

?>
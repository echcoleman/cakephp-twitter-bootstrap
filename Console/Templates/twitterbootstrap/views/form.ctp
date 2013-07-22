<?php
/**
 * Form
 */
if (strpos($action, 'add') !== false) {
	return;
}

echo "<?php\n";
echo "\$action = \$this->params['origAction'];\n";
echo "?>\n";

?>
<div class="<?php echo $pluralVar; ?> form">
	<div class="actions btn-group pull-right">
		<a href="#" data-toggle="dropdown" class="btn dropdown-toggle">
			<?php echo "<?php echo __('Actions'); ?>\n"; ?>
			<span class="caret"></span>
		</a>
		<ul class="dropdown-menu">
<?php
			if (strlen(trim($displayField)) > 0) {
				$deleteModelProperty = $displayField;
				$deleteMessage = "Are you sure you want to delete {$singularVar}: %s?";
			}
			else {
				$deleteModelProperty = $primaryKey;
				$deleteMessage = "Are you sure you want to delete {$singularVar} # %s?";
			}
			?>
			<?php echo "<?php if (strpos(\$action, 'add') === false) { ?>\n"; ?>
			<li><?php echo "<?php echo \$this->Form->postLink(__('Delete'), array('action' => 'delete', \$this->Form->value('{$modelClass}.{$primaryKey}')), null, __('{$deleteMessage}', \$this->Form->value('{$modelClass}.{$deleteModelProperty}'))); ?>"; ?></li>
			<?php echo "<?php } ?>\n"; ?>
			<li><?php echo "<?php echo \$this->Html->link(__('List " . $pluralHumanName . "'), array('action' => 'index')); ?>"; ?></li>
		</ul>
	</div>
<?php echo "<?php echo \$this->Form->create('{$modelClass}'); ?>\n"; ?>
	<fieldset>
		<legend><?php echo "<?php echo __('%s {$singularHumanName}', Inflector::humanize(\$action)); ?>"; ?></legend>
<?php
		echo "\t<?php\n";
		foreach ($fields as $field) {
			if (!in_array($field, array('created', 'modified', 'updated'))) {
				echo "\t\techo \$this->Form->input('{$field}');\n";
			}
		}
		if (!empty($associations['hasAndBelongsToMany'])) {
			foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
				echo "\t\techo \$this->Form->input('{$assocName}');\n";
			}
		}
		echo "\t?>\n";
?>
	</fieldset>
<?php
	echo "<?php echo \$this->Form->end(__('Submit')); ?>\n";
?>
</div>

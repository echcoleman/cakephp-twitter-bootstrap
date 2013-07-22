<?php
/**
 * View
 */
?>
<div class="<?php echo $pluralVar; ?> view">
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
			echo "\t\t\t<li><?php echo \$this->Html->link(__('List " . $pluralHumanName . "'), array('action' => 'index')); ?> </li>\n";
			echo "\t\t\t<li><?php echo \$this->Html->link(__('Edit " . $singularHumanName ."'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?> </li>\n";
			echo "\t\t\t<li><?php echo \$this->Form->postLink(__('Delete " . $singularHumanName . "'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), null, __('{$deleteMessage}', \${$singularVar}['{$modelClass}']['{$deleteModelProperty}'])); ?> </li>\n";
		?>
		</ul>
	</div>
	<h2><?php echo "<?php  echo __('{$singularHumanName}'); ?>"; ?></h2>
	<dl>
<?php
foreach ($fields as $field) {
	$isKey = false;
	if (!empty($associations['belongsTo'])) {
		foreach ($associations['belongsTo'] as $alias => $details) {
			if ($field === $details['foreignKey']) {
				$isKey = true;
				echo "\t\t<dt><?php echo __('" . Inflector::humanize(Inflector::underscore($alias)) . "'); ?></dt>\n";
				echo "\t\t<dd>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t\t&nbsp;\n\t\t</dd>\n";
				break;
			}
		}
	}
	if ($isKey !== true) {
		echo "\t\t<dt><?php echo __('" . Inflector::humanize($field) . "'); ?></dt>\n";
		echo "\t\t<dd>\n\t\t\t<?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>\n\t\t\t&nbsp;\n\t\t</dd>\n";
	}
}
?>
	</dl>
</div>
<?php
if (!empty($associations['hasOne'])) :
	foreach ($associations['hasOne'] as $alias => $details): ?>
	<div class="related">
		<h3><?php echo "<?php echo __('Related " . Inflector::humanize($details['controller']) . "'); ?>"; ?></h3>
	<?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])): ?>\n"; ?>
		<dl>
	<?php
			foreach ($details['fields'] as $field) {
				echo "\t\t<dt><?php echo __('" . Inflector::humanize($field) . "'); ?></dt>\n";
				echo "\t\t<dd>\n\t<?php echo \${$singularVar}['{$alias}']['{$field}']; ?>\n&nbsp;</dd>\n";
			}
	?>
		</dl>
	<?php echo "<?php endif; ?>\n"; ?>
		<div class="actions">
			<ul>
				<li><?php echo "<?php echo \$this->Html->link(__('Edit " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'edit', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?></li>\n"; ?>
			</ul>
		</div>
	</div>
	<?php
	endforeach;
endif;
if (empty($associations['hasMany'])) {
	$associations['hasMany'] = array();
}
if (empty($associations['hasAndBelongsToMany'])) {
	$associations['hasAndBelongsToMany'] = array();
}
$relations = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany']);
$i = 0;
foreach ($relations as $alias => $details):
	$otherSingularVar = Inflector::variable($alias);
	$otherPluralHumanName = Inflector::humanize($details['controller']);
	?>
<div class="related">
	<h3><?php echo "<?php echo __('Related " . $otherPluralHumanName . "'); ?>"; ?></h3>
	<?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])): ?>\n"; ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
<?php
			foreach ($details['fields'] as $field) {
				echo "\t\t<th><?php echo __('" . Inflector::humanize($field) . "'); ?></th>\n";
			}
?>
		<th class="actions"><?php echo "<?php echo __('Actions'); ?>"; ?></th>
	</tr>
<?php
echo "\t<?php
		\$i = 0;
		foreach (\${$singularVar}['{$alias}'] as \${$otherSingularVar}): ?>\n";
		echo "\t\t<tr>\n";
			foreach ($details['fields'] as $field) {
				echo "\t\t\t<td><?php echo \${$otherSingularVar}['{$field}']; ?></td>\n";
			}
			
			echo "\t\t\t<td class=\"actions\">\n";
				echo "\t\t\t\t<?php\n";
				echo "\t\t\t\t\$this->element('icon-actions', array(\n";
					echo "\t\t\t\t\t 'view' => array('controller' => '{$details['controller']}', 'action' => 'view', \${$otherSingularVar}['{$details['primaryKey']}']),\n";
					echo "\t\t\t\t\t 'edit' => array('controller' => '{$details['controller']}', 'action' => 'edit', \${$otherSingularVar}['{$details['primaryKey']}']),\n";
					echo "\t\t\t\t\t 'view' => array('controller' => '{$details['controller']}', 'action' => 'view', \${$otherSingularVar}['{$details['primaryKey']}']),\n";
					echo "\t\t\t\t\t 'delete_confirm' => __('Are you sure you want to delete # %s?', \${$otherSingularVar}['{$details['primaryKey']}'])\n";
				echo "\t\t\t\t));\n";
				echo "\t\t\t\t?>\n";
			echo "\t\t\t</td>\n";
			
		echo "\t\t</tr>\n";

echo "\t<?php endforeach; ?>\n";
?>
	</table>
<?php echo "<?php endif; ?>\n\n"; ?>
	<div class="actions">
		<ul>
			<li><?php echo "<?php echo \$this->Html->link(__('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add')); ?>"; ?> </li>
		</ul>
	</div>
</div>
<?php endforeach; ?>

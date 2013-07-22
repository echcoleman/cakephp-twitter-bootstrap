<?php
/**
 * Index
 */
?>
<div class="<?php echo $pluralVar; ?> index">
	<div class="actions btn-group pull-right">
		<a href="#" data-toggle="dropdown" class="btn dropdown-toggle">
			<?php echo "<?php echo __('Actions'); ?>\n"; ?>
			<span class="caret"></span>
		</a>
		<ul class="dropdown-menu">
			<li><?php echo "<?php echo \$this->Html->link(__('New " . $singularHumanName . "'), array('action' => 'add')); ?>";?></li>
		</ul>
	</div>
	<h2><?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
		<thead>
			<tr>
		<?php foreach ($fields as $field): if (in_array($field, array('id'))) continue; ?>
		<th><?php echo "<?php echo \$this->Paginator->sort('{$field}'); ?>"; ?></th>
		<?php endforeach; ?>
		<th class="actions"><?php echo "<?php echo __('Actions'); ?>"; ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			echo "<?php
			foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
			echo "\t\t\t<tr>\n";
				foreach ($fields as $field) {
					if (in_array($field, array('id'))) continue;
					echo "\t\t\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
				}

				if (strlen(trim($displayField)) > 0) {
					$deleteModelProperty = $displayField;
					$deleteMessage = "Are you sure you want to delete {$singularVar}: %s?";
				}
				else {
					$deleteModelProperty = $primaryKey;
					$deleteMessage = "Are you sure you want to delete {$singularVar} # %s?";
				}
				echo "\t\t\t\t<td class=\"actions\">\n";
					echo "\t\t\t\t\t<?php\n";
						echo "\t\t\t\t\techo \$this->element('TwitterBootstrap.icon-actions', array(\n";
						echo "\t\t\t\t\t\t 'view' => array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']),\n";
						echo "\t\t\t\t\t\t 'edit' => array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']),\n";
						echo "\t\t\t\t\t\t 'delete' => array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']),\n";
						echo "\t\t\t\t\t\t 'delete_confirm' => __('{$deleteMessage}', \${$singularVar}['{$modelClass}']['{$deleteModelProperty}'])\n";
					echo "\t\t\t\t\t));\n";
					echo "\t\t\t\t\t?>\n";
				echo "\t\t\t\t</td>\n";
				
			echo "\t\t\t</tr>\n";

			echo "\t\t\t<?php endforeach; ?>\n";
			?>
		</tbody>
	</table>
	<p>
	<?php echo "<?php
	echo \$this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>\n"; ?>
	</p>

	<div class="pagination">
		<ul>
		<?php
			echo "<?php\n";
			echo "\t\t\techo \$this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));\n";
			echo "\t\t\techo \$this->Paginator->numbers(array('separator' => ''));\n";
			echo "\t\t\techo \$this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));\n";
			echo "\t\t?>\n";
		?>
		</ul>
	</div>
</div>

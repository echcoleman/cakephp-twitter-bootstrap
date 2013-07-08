<?php
/**
 * Bootstrap flash messages
 * 
 * @uses $message Message alert content
 * @uses $type Type of alert, eg: success, error, warning, etc
 */
?>
<div class="alert alert-<?php echo $type; ?>">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $message; ?>
</div>
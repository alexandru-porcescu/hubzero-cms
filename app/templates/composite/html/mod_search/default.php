<?php // no direct access
defined('_HZEXEC_') or die(); ?>
<form method="get" action="/search" id="searchform"<?php if ($params->get('moduleclass_sfx')) { echo ' class="'.$params->get('moduleclass_sfx').'"'; } ?>>
	<fieldset>
		<legend><?php echo $text; ?></legend>
		<label for="searchword" id="searchword-label"><?php echo $text; ?></label>
		<input type="text" name="terms" id="searchword" size="<?php echo $width; ?>" placeholder="<?php echo $text; ?>" />
	</fieldset>
</form>
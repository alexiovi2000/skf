<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.skel.views.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php __('sito skf actuator selector'); ?> - <?php __('amministrazione'); ?> <?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon') . "\n";

		echo $this->Html->css('cake.generic') . "\n";

		echo $this->element('admin/default_cssjs') . "\n";

		echo $scripts_for_layout;
	?>

<?php
// X caricare css / js da view in layout
// $html->css("css_file", null, array("inline"=>false));
?>

<script type="text/javascript">
// inizializzazione variabili js
    var calendar_img_url = '<?php echo SITE_WEBROOT_URL ?>';
</script>

</head>
<body>

	<?php echo $this->element('admin/spinner'); ?>

	<div id="container">

		<?php echo $this->element('admin/header'); ?>

		<?php echo $this->element('admin/user_logged'); ?>

		<?php echo $this->element('admin/menu_main'); ?>

		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->Session->flash('change_password'); ?>

			<?php echo $content_for_layout; ?>

		</div>

		<?php echo $this->element('admin/footer'); ?>

	</div>

	<script type="text/javascript">
	$(function() {
		<?php //dopo 10 secondi fade away del messaggio 'flash', altrimenti sulle pagine in ajax resta li e confonde ?>
		$('#flashMessage').delay('10000').fadeOut('slow');
	});
	</script>

	<?php echo $this->element('sql_dump'); ?>

</body>
</html>
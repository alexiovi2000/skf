

<?php
/**
 * Common JS and CSS Include layout admin
 */
?>
<?php



    echo $this->Html->script('jquery-1.4.2.min') . "\n";
//    echo $javascript->link('admin/jQuery/jquery-1.4.4.min.js') . "\n";

//    echo $this->Html->script('jquery.bgiframe') . "\n";

/* jquery-ui */
//    echo $this->Html->css('../js/jquery.jquery-ui/jquery-ui-1.8.12.custom') . "\n";
//    echo $this->Html->script('jquery.jquery-ui/jquery-ui-1.8.12.custom.min') . "\n";
    echo $this->Html->css('../js/jquery.jquery-ui/jquery-ui-1.10.3.custom') . "\n";
    echo $this->Html->script('jquery.jquery-ui/jquery-ui-1.10.3.custom.min') . "\n";

// $user_backend_language_selected: settato in app_controller
	$language_selected = isset($user_backend_language_selected) ? $user_backend_language_selected : '';
	$language_selected = 'it';
	if ($language_selected) {
		echo $this->Html->script('jquery.jquery-ui/jquery.ui.datepicker-' . $language_selected) . "\n";
	}
/* jquery-ui */

/* jclock */
//	echo $javascript->link('admin/jQuery/jquery.jclock.js') . "\n";
/* jclock */

/* js tree */
/*
    echo $html->css('admin/jstree/style.css') . "\n";
    echo $javascript->link('admin/jQuery/jquery.jstree.js') . "\n";
*/
/* js tree */


/* jquery anytime */
//	echo $html->css('../js/admin/jQuery/anytime.css') . "\n";
//	echo $javascript->link('admin/jQuery/anytime.js') . "\n";
/* jquery anytime */

/* jquery tooltip */
//	echo $html->css('../js/admin/jQuery/jquery.tooltip.css') . "\n";
//	echo $javascript->link('admin/jQuery/jquery.tooltip.min.js') . "\n";
/* jquery tooltip */

/* jquery Jcrop */
//	echo $html->css('../js/admin/jQuery/jquery.Jcrop.css') . "\n";
//	echo $javascript->link('admin/jQuery/jquery.Jcrop.js') . "\n";
/* jquery Jcrop */

/* jquery validation */
/*
    echo $javascript->link('admin/jQuery/jquery.validate.min.js') . "\n";
    echo $javascript->link('admin/jQuery/jquery.form.js') . "\n";
    echo $javascript->link('admin/jQuery/jquery.validate.additional-methods.js') . "\n";
*/
/* jquery validation */

//	echo $javascript->link('admin/tiny_mce/tiny_mce.js') . "\n";

/* layout */
//    echo $this->Html->css('layout') . "\n";
    echo $this->Html->css('admin.layout') . "\n";
/* layout */

/* suckerfish menu */
	echo $this->Html->css('../js/jquery.superfish-1.4.8/css/superfish.css') . "\n";
//	echo $this->Html->css('../js/jquery.superfish-1.4.8/css/superfish-navbar.css') . "\n";
//	echo $this->Html->css('../js/jquery.superfish-1.4.8/css/superfish-vertical.css') . "\n";
	echo $this->Html->script('jquery.superfish-1.4.8/js/hoverIntent') . "\n";
	echo $this->Html->script('jquery.superfish-1.4.8/js/superfish') . "\n";
	echo $this->Html->script('jquery.superfish-1.4.8/js/supersubs') . "\n";
/* suckerfish menu */

	echo $this->Html->script('utils') . "\n";

?>
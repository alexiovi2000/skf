<div class="row-fluid">

<?php echo $this->MyForm->create('User', array('action'=>'login')); ?>
<?php //echo $this->MyForm->create('User', array('url'=>'/login')); ?>

<fieldset>
    <legend><?php echo __('Login', true); ?></legend>

<?php
$view_registrazione_alert = false;
if ($session->check('Message.auth')) {
	$view_registrazione_alert = true;
	$msg_tmp = $session->read('Message.auth');
	if (isset($msg_tmp['message']) && $msg_tmp['message']) {
		$msg_tmp = $msg_tmp['message'];
		if ($msg_tmp == 'Login failed. Invalid username or password.') {
			$msg_tmp = __('Login failed. Invalid username or password.', true);
		}
/*
		if ($msg_tmp == 'You are not authorized to access that location.') {
			$msg_tmp = __('You are not authorized to access that location.', true);
		}
*/
		echo "
			<script type='text/javascript'>
			// <![CDATA[
				$(document).ready(function() {
					//have an alert box displayed on body load.
					$('body').jAlert('" . $msg_tmp . "<br />&nbsp;', 'warning', 'xxxx', 300, 200);
//(msg, type, uid, alert_box_width, yoffset)
				});
			// ]]>
			</script>
		";

		$session->delete('Message.auth');

	}
}
?>
<input id="UserUsername" name="data[User][username]" type="text" maxlength="255" class="span2" value="" placeholder="<?php echo __('Username', true); ?>" />
<input id="UserPassword" name="data[User][password]" type="password" maxlength="255" class="span2" value="" placeholder="<?php echo __('Password', true); ?>" />

<p><?php echo __('Remember me', true); ?>
<input id="UserRememberMe_" type="hidden" value="0" name="data[User][remember_me]" />
<input id="UserRememberMe" class="" type="checkbox" value="1" name="data[User][remember_me]"/>
</p>

</fieldset>

<?php echo $this->MyForm->submit('Entra', array('class' => 'btn')); ?>

<?php echo $this->MyForm->end(); ?>

</div>
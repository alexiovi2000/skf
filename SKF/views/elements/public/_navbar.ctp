<!-- navbar -->
<div class="navbar navbar navbar-fixed-top" id="my_nav_bar">
  <div class="navbar-inner">
    <div class="container">
<!--
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
-->
      <div class="nav-collapse collapse">
		<ul class="nav">
		  <li<?php if ($url_selected == '/public/home/') {echo ' class="active"';}?>><a href="<?php echo $this->Html->url('/') ?>" title="<?php echo __('link.home', true); ?>"><i class="icon-home icon"></i><?php echo __('link.home', true); ?></a></li>
<?php
/*
foreach($public_menu_items as $key => $value) {

// inizializzo dati
	$name_tmp = $value['name'];
	$url_tmp = '/'.$value['slug'];
	$url_ctrl_tmp = $value['url_ctrl'];
//pr('$url_ctr_tmp  ' .$url_ctr_tmp );
// verifico voce selezionata
	if ( isset($url_selected) && strpos ( $url_selected , $url_ctrl_tmp ) === 0 ) {
		$class_active_tmp = ' class="active"';
	} else {
		$class_active_tmp = '';
	}
//	echo '<li' . $class_active_tmp. '><a href="'.$this->Html->url($url_tmp).'" title="'.$name_tmp.'"><i class="icon-home icon"></i>'.$name_tmp.'</a></li>';
	echo '<li' . $class_active_tmp. '><a href="'.$this->Html->url($url_tmp).'" title="'.$name_tmp.'">'.$name_tmp.'</a></li>';

}
*/
?>

<?php
//pr($user_logged);
if (empty($user_logged)) {
/*
?>
          <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
<?php echo $this->MyForm->create('User', array('action'=>'login')); ?>
<?php //echo $this->MyForm->create('User', array('url'=>'/login')); ?>

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

//		if ($msg_tmp == 'You are not authorized to access that location.') {
//			$msg_tmp = __('You are not authorized to access that location.', true);
//		}

		echo "
			<script type='text/javascript'>
			// <![CDATA[
				$(document).ready(function() {
					//have an alert box displayed on body load.
					$('body').jAlert('" . $msg_tmp . "<br />&nbsp;', 'warning', 'xxxx', 220, 50);
//(msg, type, uid, alert_box_width, yoffset)
				});
			// ]]>
			</script>
		";

		$session->delete('Message.auth');

	}
}
?>
<input id="UserUsername" name="data[User][username]" type="text" maxlength="255" class="span2" value="" placeholder="Username" />
<input id="UserPassword" name="data[User][password]" type="password" maxlength="255" class="span2" value="" placeholder="Password" />

<p>Rimani connesso
<input id="UserRememberMe_" type="hidden" value="0" name="data[User][remember_me]" />
<input id="UserRememberMe" class="" type="checkbox" value="1" name="data[User][remember_me]"/>
</p>

<?php echo $this->MyForm->submit('Entra', array('class' => 'btn')); ?>

<?php echo $this->MyForm->end(); ?>

						</li>

                    </ul>

          </li>

<?php
*/
} else {

	$url_tmp = '';
	$link_profile_admin = '';
	if ($user_logged_role_id == ID_USERROLE_PUBLIC_USER) {
		$url_tmp = '/users/edit_profile';
		$link_profile_admin = $html->link(__('link.profile', true), $url_tmp, array('class' => '', 'title' => __('link.profile', true)));
	} elseif ($user_logged_role_id == ID_USERROLE_SUPERADMIN || $user_logged_role_id == ID_USERROLE_ADMIN || $user_logged_role_id == ID_USERROLE_USER) {
		$url_tmp = '/admin/users/index/';
		$link_profile_admin = $html->link(__('link.admin', true), $url_tmp, array('class' => '', 'title' => __('link.admin', true)));
	}

?>
                    <li><?php echo $link_profile_admin ?></li>

					<li class="divider"></li>
                    <li><?php echo $html->link(__('link.logout', true), '/users/logout/', array('class' => '', 'title' => __('link.logout', true))); ?></li>

<!--
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="<?php echo __('link.administration', true); ?>"><?php echo __('link.administration', true); ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><?php echo $link_profile_admin ?></li>

					<li class="divider"></li>
                    <li><?php echo $html->link(__('link.logout', true), '/users/logout/', array('class' => '', 'title' => __('link.logout', true))); ?></li>
                </ul>
          </li>
-->
<?php
}
?>

        </ul>

    <div id="polyglotLanguageSwitcher" class="navbar-search pull-right">
		<form>
			<select id="polyglot-language-options">
<?php
//pr ($localization);
foreach ($localization as $key => $value) {
	$selected = '';
	if ($key == $session->read('locale')) {
		$selected = 'selected="selected"';
	}
	echo '<option id="'.$key.'" value="'.$key.'" ' . $selected . '>'.$value.'</option>';
}
?>
			</select>
		</form>

<?php
echo $this->MyForm->create('User', array('id' => 'form_change_language', 'action'=>'change_language'));
echo $this->MyForm->input('language_selected', array( 'type' => 'hidden', 'value' => $session->read('locale')));
echo $this->MyForm->end();
?>

	</div>

<?php /* ?>

			<select id="language-options">
<?php
//pr ($localization);
foreach ($localization as $key => $value) {
	$selected = '';
	if ($key == $session->read('locale')) {
		$selected = 'selected="selected"';
	}
	echo '<option id="'.$key.'" value="'.$key.'" ' . $selected . '>'.$value.'</option>';
}
?>
			</select>
<?php */ ?>

<script type="text/javascript">
// <![CDATA[

    $(document).ready(function() {
        $('#polyglotLanguageSwitcher').polyglotLanguageSwitcher({
			effect: 'fade',
            openMode: 'hover',
            onChange: function(evt){
                $('#UserLanguageSelected').val(evt.selectedItem);
                $('#form_change_language').submit();
            }
		});
    });

// ]]>
</script>

      </div>
    </div>
  </div>
</div>
<!-- navbar -->
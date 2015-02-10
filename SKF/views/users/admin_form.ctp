<?php
    $title_page_tmp = $my_page_title;
    $title_form_tmp = $my_form_title;
?>

<div id="content-top">
    <h2><?php echo $title_page_tmp;?></h2>
    <span class="clearFix">&nbsp;</span>
</div>

<!--
<div id="breadcrumbs">
    <p><strong>Breadcrumbs: </strong><?php echo $html->getCrumbs(' > '); ?></p>
</div>
-->

<div id="mid-col" class="full-col">

    <div class="box">
        <h4 class="white"><?php echo $title_page_tmp; ?></h4>
        <div class="box-container">
            <?php echo $this->MyForm->create('User',array('class' => 'middle-forms', 'type' => 'file'));?>
            <?php // echo $cropForm->add_to_textareas('tinyMce', Configure::read('tinymce_limited'));?>
            <?php echo $this->element('admin/form_field_required'); ?>

            <div class="button_bar_form">
                <?php echo $this->MyForm->submit(__('Save', true), array()); ?>
                <?php echo $html->link(__('Back', true), '/admin/users/index/'.$usertype,array('class' => 'button-back-link')); ?>
            </div>
            <span class="clearFix">&nbsp;</span>

            <fieldset>
                <legend><?php echo $title_form_tmp;?></legend>
<?php
				$user_exist = $this->MyForm->value('id');

				echo $this->MyForm->input('id');
				echo $this->MyForm->input('usertype_id', array('type' => 'hidden'));
				echo $this->MyForm->input('admin_confirmed', array('type' => 'hidden'));

//pr('$usertype ' . $usertype );

	if ($usertype == 'backend') {

		echo $this->MyForm->input('firstname', array('label' => __('User.firstname', true), 'class' => 'txtbox-middle'));
		echo $this->MyForm->input('lastname', array('label' => __('User.lastname', true), 'div' => 'even','class' => 'txtbox-middle'));
		echo $this->MyForm->input('email', array('label' => __('User.email', true), 'class' => 'txtbox-middle'));

		echo $this->MyForm->input('username', array('label' => __('User.username', true), 'class' => 'txtbox-middle'));
        if($user_exist) {
            echo $this->MyForm->input('new_password', array('label' => __('User.new_password', true), 'type' => 'password', 'div' => 'even','class' => 'txtbox-middle'));
        } else {
            echo $this->MyForm->input('new_password_add', array('label' => __('User.new_password_add', true), 'type' => 'password', 'div' => 'even','class' => 'txtbox-middle'));
        }
		echo $this->MyForm->input('confirm_password', array('label' => __('User.confirm_password', true), 'type' => 'password', 'div' => 'even','class' => 'txtbox-middle'));

    // l'utente superadmin con id 1 non è modificabile
        if ($user_exist && $this->data['User']['id'] == ID_USERADMIN_DEFAULT)  {
        	echo $this->MyForm->input('userrole_description', array('type' => 'text', 'label' => __('User.userrole_id', true), 'value' => $userroles[ID_USERROLE_SUPERADMIN], 'div' => 'even','class' => 'txtbox-middle', 'readonly' => true));
        } else {
        	echo $this->MyForm->input('userrole_id', array('label' => __('User.userrole_id', true), 'div' => 'even','class' => 'txtbox-middle', 'empty' => __('select option ...', true)));
        	echo $this->MyForm->input('userstatus_id', array('label' => __('User.userstatus_id', true), 'div' => 'even','class' => 'txtbox-middle', 'empty' => __('select option ...', true)));
        }

        if($user_exist) {
			echo $this->MyForm->input('lastlogin', array('label' => __('User.lastlogin', true), 'type' => 'text', 'class' => 'txtbox-middle', 'readonly' => true));
        }

		echo $this->MyForm->input('note', array('label' => __('User.note', true), 'div' => 'even', 'class' => 'txtbox-middle'));

	}


	if ($usertype == 'frontend') {

		echo $this->MyForm->input('firstname', array('label' => __('User.firstname', true), 'class' => 'txtbox-middle'));
		echo $this->MyForm->input('lastname', array('label' => __('User.lastname', true), 'div' => 'even','class' => 'txtbox-middle'));
		echo $this->MyForm->input('company', array('label' => __('User.company', true),'class' => 'txtbox-middle'));
		echo $this->MyForm->input('address', array('label' => __('User.address', true), 'div' => 'even','class' => 'txtbox-middle'));
		echo $this->MyForm->input('city', array('label' => __('User.city', true), 'class' => 'txtbox-middle'));
		echo $this->MyForm->input('zipcode', array('label' => __('User.zipcode', true), 'div' => 'even','class' => 'txtbox-middle'));

		//echo $this->MyForm->input('provincia', array('label' => __('User.provincia', true), 'class' => 'txtbox-middle'));
		//echo $this->MyForm->input('nazione', array('label' => __('User.nazione', true), 'div' => 'even','class' => 'txtbox-middle'));

		echo $this->MyForm->input('phonenumber', array('label' => __('User.phonenumber', true), 'class' => 'txtbox-middle'));
		//echo $this->MyForm->input('faxnumber', array('label' => __('User.faxnumber', true), 'div' => 'even','class' => 'txtbox-middle'));

		echo $this->MyForm->input('email', array('label' => __('User.email', true), 'class' => 'txtbox-middle'));
		echo $this->MyForm->input('professione', array('label' => __('User.professione', true), 'type' => 'select', 'options' => $elenco_professioni, 'div' => 'even','class' => 'txtbox-middle'));

		echo $this->MyForm->input('username', array('label' => __('User.username', true), 'class' => 'txtbox-middle'));

        if($user_exist) {
            echo $this->MyForm->input('new_password', array('label' => __('User.new_password', true), 'type' => 'password', 'div' => 'even','class' => 'txtbox-middle'));
        } else {
            echo $this->MyForm->input('new_password_add', array('label' => __('User.new_password_add', true), 'type' => 'password', 'div' => 'even','class' => 'txtbox-middle'));
        }
		echo $this->MyForm->input('confirm_password', array('label' => __('User.confirm_password', true), 'type' => 'password', 'div' => 'even','class' => 'txtbox-middle'));

		$userstatus_id_pre = $this->MyForm->value('userstatus_id');
		if ($userstatus_id_pre != ID_USERSTATUS_PENDING) {
			unset($userstatuses[ID_USERSTATUS_PENDING]);
		}
		echo $this->MyForm->input('userstatus_id_pre', array('type' => 'hidden', 'value' => $userstatus_id_pre));
		echo $this->MyForm->input('userstatus_id', array('label' => __('User.userstatus_id', true), 'options' => $userstatuses, 'div' => 'even','class' => 'txtbox-middle', 'empty' => __('select option ...', true)));

	    if($user_exist) {
			echo $this->MyForm->input('lastlogin', array('label' => __('User.lastlogin', true), 'type' => 'text', 'class' => 'txtbox-middle', 'readonly' => true));
	    }

		echo $this->MyForm->input('mailinglist', array('label' => __('User.mailinglist', true), 'div' => 'even','class' => 'txtbox-middle'));

		echo $this->MyForm->input('note', array('label' => __('User.note', true), 'div' => 'even', 'class' => 'txtbox-middle'));

	}

?>
            </fieldset>

            <div class="button_bar_form">
                <?php echo $this->MyForm->submit(__('Save', true), array()); ?>
                <?php echo $html->link(__('Back', true), '/admin/users/index/'.$usertype,array('class' => 'button-back-link')); ?>
            </div>
            <span class="clearFix">&nbsp;</span>

            <?php echo $this->MyForm->end();?>
        </div>

    </div>

</div>
<?php $this->MyPaginator->options(array('update' => 'table-data', 'indicator' => 'spinner')); ?>

<?php echo $this->element('admin/paging_up'); ?>

<?php echo $this->MyForm->create('User',array('id' => 'search_form', 'action' => 'index/' . $usertype,'class' => 'middle-forms'));?>

<?php
	if ($usertype == 'backend') {
?>
<div class="button_bar_index">
    <?php echo $html->link(__('Add', true), array('action' => 'add'),array('class' => 'button-add-link')); ?>
</div>
<?php
	}
?>


<?php
	if ($usertype == 'frontend') {
?>
<div class="button_bar_index">
    <?php echo $html->link(__('Export', true), array('action' => 'export'),array('class' => 'button-add-link')); ?>
</div>
<?php
	}
?>

<table class="table-long table-100">
    <thead>
        <tr>
            <td>&nbsp;</td>

<?php
	if ($usertype == 'backend') {
?>
            <td><?php echo $this->MyPaginator->sort(__('User.firstname', true), 'firstname');?></td>
            <td><?php echo $this->MyPaginator->sort(__('User.lastname', true), 'lastname');?></td>
            <td><?php echo $this->MyPaginator->sort(__('User.email', true), 'email');?></td>
            <td><?php echo $this->MyPaginator->sort(__('User.lastlogin', true), 'lastlogin');?></td>
<?php
		if ($user_logged_role_id == ID_USERROLE_SUPERADMIN) {
?>
            <td><?php echo $this->MyPaginator->sort(__('User.userrole_id', true), 'Userrole.name');?></td>
<?php
		}
?>
            <td><?php echo $this->MyPaginator->sort(__('User.userstatus_id', true), 'Userstatus.name');?></td>
<?php
	}
?>

<?php
	/*if ($usertype == 'onlus') {
?>
			<td><?php echo $this->MyPaginator->sort(__('User.company', true), 'company');?></td>
			<td><?php echo $this->MyPaginator->sort(__('User.city', true), 'city');?></td>
			<td><?php echo $this->MyPaginator->sort(__('User.email', true), 'email');?></td>
			<td><?php echo $this->MyPaginator->sort(__('User.lastlogin', true), 'lastlogin');?></td>
			<td><?php echo $this->MyPaginator->sort(__('User.admin_confirmed', true), 'status');?></td>

			<td><?php echo $this->MyPaginator->sort(__('User.userstatus_id', true), 'Userstatus.name');?></td>
<?php
	}*/
?>

<?php
	/*if ($usertype == 'fundraiser') {
?>
			<td><?php echo $this->MyPaginator->sort(__('User.company', true), 'company');?></td>
			<td><?php echo $this->MyPaginator->sort(__('User.firstname', true), 'firstname');?></td>
			<td><?php echo $this->MyPaginator->sort(__('User.lastname', true), 'lastname');?></td>
			<td><?php echo $this->MyPaginator->sort(__('User.city', true), 'city');?></td>
			<td><?php echo $this->MyPaginator->sort(__('User.email', true), 'email');?></td>
			<td><?php echo $this->MyPaginator->sort(__('User.lastlogin', true), 'lastlogin');?></td>
			<td><?php echo $this->MyPaginator->sort(__('User.admin_confirmed', true), 'status');?></td>

			<td><?php echo $this->MyPaginator->sort(__('User.userstatus_id', true), 'Userstatus.name');?></td>
<?php
	}*/
?>

<?php
	if ($usertype == 'frontend') {
?>
			<td><?php echo $this->MyPaginator->sort(__('User.company', true), 'company');?></td>
			<td><?php echo $this->MyPaginator->sort(__('User.firstname', true), 'firstname');?></td>
			<td><?php echo $this->MyPaginator->sort(__('User.lastname', true), 'lastname');?></td>
			<td><?php echo $this->MyPaginator->sort(__('User.city', true), 'city');?></td>
			<td><?php echo $this->MyPaginator->sort(__('User.email', true), 'email');?></td>
			<td><?php echo $this->MyPaginator->sort(__('User.lastlogin', true), 'lastlogin');?></td>
			<td><?php echo $this->MyPaginator->sort(__('User.admin_confirmed', true), 'status');?></td>

			<td><?php echo $this->MyPaginator->sort(__('User.userstatus_id', true), 'Userstatus.name');?></td>
<?php
	}
?>

            <td><?php //__('Actions');?>&nbsp;</td>
        </tr>
    </thead>

    <tbody>
	    <tr class="filter">
	        <td>
	            <a href="" id="reset"><?php echo __('Reset Filters',true); ?></a>
	            <script language="javascript"  type="text/javascript">
	            $(function(){
	                $('#reset').click(function() {$('form').formClear(); submit_index_search_form(); return false;});
	            });
	            </script>
	        </td>

<?php
	if ($usertype == 'backend') {
?>
	        <td><?php echo $this->MyForm->searchInput('firstname'); ?></td>
	        <td><?php echo $this->MyForm->searchInput('lastname'); ?></td>
	        <td><?php echo $this->MyForm->searchInput('email'); ?></td>
	        <td class="date_from_to"><?php echo $this->MyForm->searchInput('lastlogin'); ?></td>
<?php
		if ($user_logged_role_id == ID_USERROLE_SUPERADMIN) {
?>
			<td>
			<?php
			$userrole_id_selected = isset($this->data['User']['userrole_id']) ? $this->data['User']['userrole_id'] : '';
			echo $this->MyForm->searchInput('userrole_id', array('selected' => $userrole_id_selected));
			?>
			</td>
<?php
		}
?>
	        <td>
			<?php
			$userstatus_id_selected = isset($this->data['User']['userstatus_id']) ? $this->data['User']['userstatus_id'] : '';
			echo $this->MyForm->searchInput('userstatus_id', array('selected' => $userstatus_id_selected));
			?>
			</td>
<?php
	}
?>

<?php
	/*if ($usertype == 'onlus') {
?>
			<td><?php echo $this->MyForm->searchInput('company'); ?></td>
			<td><?php echo $this->MyForm->searchInput('city'); ?></td>
			<td><?php echo $this->MyForm->searchInput('email'); ?></td>
			<td class="date_from_to"><?php echo $this->MyForm->searchInput('lastlogin'); ?></td>
			<td><?php echo $this->MyForm->searchInput('admin_confirmed'); ?></td>

	        <td>
			<?php
			$userstatus_id_selected = isset($this->data['User']['userstatus_id']) ? $this->data['User']['userstatus_id'] : '';
			echo $this->MyForm->searchInput('userstatus_id', array('selected' => $userstatus_id_selected));
			?>
			</td>
<?php
	}*/
?>

<?php
	/*if ($usertype == 'fundraiser') {
?>
			<td><?php echo $this->MyForm->searchInput('company'); ?></td>

			<td><?php echo $this->MyForm->searchInput('firstname'); ?></td>
			<td><?php echo $this->MyForm->searchInput('lastname'); ?></td>

			<td><?php echo $this->MyForm->searchInput('city'); ?></td>
			<td><?php echo $this->MyForm->searchInput('email'); ?></td>
			<td class="date_from_to"><?php echo $this->MyForm->searchInput('lastlogin'); ?></td>
			<td><?php echo $this->MyForm->searchInput('admin_confirmed'); ?></td>

	        <td>
			<?php
			$userstatus_id_selected = isset($this->data['User']['userstatus_id']) ? $this->data['User']['userstatus_id'] : '';
			echo $this->MyForm->searchInput('userstatus_id', array('selected' => $userstatus_id_selected));
			?>
			</td>
<?php
	}*/
?>

<?php
	if ($usertype == 'frontend') {
?>
			<td><?php echo $this->MyForm->searchInput('company'); ?></td>

			<td><?php echo $this->MyForm->searchInput('firstname'); ?></td>
			<td><?php echo $this->MyForm->searchInput('lastname'); ?></td>

			<td><?php echo $this->MyForm->searchInput('city'); ?></td>
			<td><?php echo $this->MyForm->searchInput('email'); ?></td>
			<td class="date_from_to"><?php echo $this->MyForm->searchInput('lastlogin'); ?></td>
			<td><?php echo $this->MyForm->searchInput('admin_confirmed'); ?></td>

	        <td>
			<?php
			$userstatus_id_selected = isset($this->data['User']['userstatus_id']) ? $this->data['User']['userstatus_id'] : '';
			echo $this->MyForm->searchInput('userstatus_id', array('selected' => $userstatus_id_selected));
			?>
			</td>
<?php
	}
?>

	        <td><?php echo $this->MyForm->submit(__('Filter',true), array('onclick' => 'submit_index_search_form(); return false;')); ?></td>
	    </tr>

<?php
//pr($users);
$i = 0;
foreach ($users as $user):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="odd"';
	}
?>

		<tr<?php echo $class;?>>
			<td>&nbsp;</td>

<?php
	if ($usertype == 'backend') {
?>
			<td><?php echo $user['User']['firstname']; ?></td>
			<td><?php echo $user['User']['lastname']; ?></td>
			<td><?php echo $user['User']['email']; ?></td>
			<td><?php echo $user['User']['lastlogin']; ?></td>
<?php
		if ($user_logged_role_id == ID_USERROLE_SUPERADMIN) {
?>
			<td><?php echo $user['Userrole']['name']; ?></td>
<?php
		}
?>
			<td><?php echo $user['Userstatus']['name']; ?></td>
<?php
	}
?>

<?php
	/*if ($usertype == 'onlus') {
?>
			<td><?php echo $user['User']['company']; ?></td>
			<td><?php echo $user['User']['city']; ?></td>
			<td><?php echo $user['User']['email']; ?></td>
			<td><?php echo $user['User']['lastlogin']; ?></td>
			<td>
				<?php
		            if ($user['User']['admin_confirmed']) {
		                echo $html->image('admin/icon-publish.gif', array('label' => __('published', true), 'alt' => __('published', true), 'title' => __('published', true)));
		            } else {
		                echo $html->image('admin/icon-unpublish.gif', array('label' => __('unpublished', true), 'alt' => __('unpublished', true), 'title' => __('published', true)));
		            }

				?>
			</td>

	        <td><?php echo $user['Userstatus']['name']; ?></td>
<?php
	}*/
?>

<?php
	/*if ($usertype == 'fundraiser') {
?>
			<td><?php echo $user['User']['company']; ?></td>

			<td><?php echo $user['User']['firstname']; ?></td>
			<td><?php echo $user['User']['lastname']; ?></td>

			<td><?php echo $user['User']['city']; ?></td>
			<td><?php echo $user['User']['email']; ?></td>
			<td><?php echo $user['User']['lastlogin']; ?></td>
			<td>
				<?php
		            if ($user['User']['admin_confirmed']) {
		                echo $html->image('admin/icon-publish.gif', array('label' => __('published', true), 'alt' => __('published', true), 'title' => __('published', true)));
		            } else {
		                echo $html->image('admin/icon-unpublish.gif', array('label' => __('unpublished', true), 'alt' => __('unpublished', true), 'title' => __('published', true)));
		            }
				?>
			</td>

	        <td><?php echo $user['Userstatus']['name']; ?></td>
<?php
	}*/
?>

<?php
	if ($usertype == 'frontend') {
?>
			<td><?php echo $user['User']['company']; ?></td>

			<td><?php echo $user['User']['firstname']; ?></td>
			<td><?php echo $user['User']['lastname']; ?></td>

			<td><?php echo $user['User']['city']; ?></td>
			<td><?php echo $user['User']['email']; ?></td>
			<td><?php echo $user['User']['lastlogin']; ?></td>
			<td>
				<?php
		            if ($user['User']['admin_confirmed']) {
		                echo $html->image('admin/icon-publish.gif', array('label' => __('published', true), 'alt' => __('published', true), 'title' => __('published', true)));
		            } else {
		                echo $html->image('admin/icon-unpublish.gif', array('label' => __('unpublished', true), 'alt' => __('unpublished', true), 'title' => __('published', true)));
		            }
				?>
			</td>

	        <td><?php echo $user['Userstatus']['name']; ?></td>
<?php
	}
?>

			<td class="row-nav">
		<!--
				<br />
				<?php //echo $html->link(__('View', true), array('action' => 'view', $user['User']['id']),array('class' => 'table-view-link')); ?>
				<br />
		-->
				<?php echo $html->link(__('Edit', true), array('action' => 'edit', $user['User']['id']),array('class' => 'table-edit-link')); ?>
		<?php
		// l'utente admin con id 1 non è eliminabile
		if ($user['User']['id'] != ID_USERADMIN_DEFAULT)  {
		?>
				<br />
				<?php echo $html->link(__('Delete', true), array('action' => 'delete', $user['User']['id']),array('class' => 'table-delete-link'), sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?>
		<?php
		}
		?>
			</td>
		</tr>

<?php endforeach; ?>

    </tbody>
</table>

<?php
	if ($usertype == 'backend') {
?>
<div class="button_bar_index">
<?php echo $html->link(__('Add', true), array('action' => 'add'),array('class' => 'button-add-link')); ?>
</div>
<?php
	}
?>

<?php echo $this->MyForm->end(); ?>
<?php //echo $this->renderElement('admin/paging_bottom'); ?>
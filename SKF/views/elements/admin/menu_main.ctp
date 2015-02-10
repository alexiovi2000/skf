<div id="my_menu">
<?php
if (!empty($main_menu_items['items'])) {
?>
    <ul class="sf-menu sf-js-enabled sf-shadow">
    <?php echo $this->MyMenu->main_menu($main_menu_items['items'], 'sf-with-ul', $user_logged_role_id); ?>
    </ul>
<?php
}
?>
</div>
<p id="userbox">
    <?php if(isset($user_logged)):?>
        <?php echo __('Welcome ',true); ?> <strong><?php echo ucwords($user_logged['User']['firstname'] . ' ' . $user_logged['User']['lastname']); ?></strong> &nbsp;|&nbsp;
        <?php echo $html->link(__('Logout',true),'/users/logout/'); ?>
        <br />
        <small><?php echo __('Last login',true) . ': ' . $user_logged['User']['lastlogin']; ?> </small>
    <?php endif; ?>
</p>
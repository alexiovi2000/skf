<?php
if (isset($message_tmp) && $message_tmp) {
	$message = $message_tmp;
} else {
	$message = __('Caricamento',true);
}
?>
<div id="spinner">
<div id="spinner_box">
        <?php echo $html->image('admin/loading.gif'); ?>
        <p><?php echo $message; ?></p>
</div>
</div>
<script type="text/javascript">

$(function() {
	$("#spinner").fadeOut();
});

</script>
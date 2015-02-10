<?php
if (isset($message_loading) && $message_loading) {
	$message = $message_loading;
} else {
	$message = __('Loading ...', true);
}
?>
<div id="spinner">
<div id="spinner_box">
        <?php echo $html->image('loading.gif'); ?>
        <br />
        <p><?php echo $message; ?></p>
</div>
</div>
<script type="text/javascript">

$(function() {
	$("#spinner").fadeOut();
});

</script>
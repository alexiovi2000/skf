<?php
//mail user_change_status_enabled
//pr('$params');
//pr($params);
$email_body = isset($params['email_body']) ? $params['email_body'] : 'mail user_change_status_enabled - manca testo email';
echo ($email_body);
?>
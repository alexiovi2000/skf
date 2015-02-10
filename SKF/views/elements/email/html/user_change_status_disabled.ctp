<?php
//mail user_change_status_disabled
//pr('$params');
//pr($params);
$email_body = isset($params['email_body']) ? $params['email_body'] : 'mail user_change_status_disabled - manca testo email';
echo nl2br($email_body);
?>
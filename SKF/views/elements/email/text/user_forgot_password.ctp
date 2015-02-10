<?php
//mail user_forgot_password
//pr('$params');
//pr($params);
$email_body = isset($params['email_body']) ? $params['email_body'] : '';
$new_password = isset($params['new_password']) ? $params['new_password'] : '';
$activation_link = isset($params['activation_link']) ? $params['activation_link'] : '';

echo nl2br($email_body);
echo "\n";
echo nl2br($new_password);
echo "\n";
echo nl2br($activation_link);
?>
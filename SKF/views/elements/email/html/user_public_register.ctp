<?php
//mail conferma registrazione fundraiser privato
//pr('$params');
//pr($params);
$email_body = isset($params['email_body']) ? $params['email_body'] : '';
$activation_url = isset($params['activation_url']) ? $params['activation_url'] : '';
$activation_link = isset($params['activation_link']) ? $params['activation_link'] : '';

echo nl2br($email_body);
echo '<br />';
echo nl2br($activation_url);
echo '<br />';
echo nl2br($activation_link);
?>
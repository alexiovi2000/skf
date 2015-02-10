<?php
//mail conferma registrazione fundraiser privato
//pr('$params');
//pr($params);
$email_body = isset($params['email_body']) ? $params['email_body'] : '';
$activation_url = isset($params['activation_url']) ? $params['activation_url'] : '';
$activation_link = isset($params['activation_link']) ? $params['activation_link'] : '';

echo ($email_body);
echo "\n";
echo ($activation_url);
echo "\n";
echo ($activation_link);
?>
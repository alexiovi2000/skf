<?php
//mail richiesta catalogo italnolo
//pr('$params');
//pr($params);
$email_body = isset($params['email_body']) ? $params['email_body'] : 'mail conferma richiesta catalogo italnolo - manca testo email';


echo nl2br($email_body);

?>
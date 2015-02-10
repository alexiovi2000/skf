<?php
//mail richiesta spedizioni tutta italia
//pr('$params');
//pr($params);
$email_body = isset($params['email_body']) ? $params['email_body'] : 'mail richiesta spedizioni tutta italia - manca testo email';


echo nl2br($email_body);

?>
<?php
//mail richiesta info
//pr('$params');
//pr($params);
$email_body = isset($params['email_body']) ? $params['email_body'] : 'mail conferma richiesta info - manca testo email';


echo nl2br($email_body);

?>
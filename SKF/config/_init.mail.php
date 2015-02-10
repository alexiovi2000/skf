<?php

define('APP_MAIL_SEND', true);

// indirizzi mail sito web
$mail_to_hidden = array();
$mail_to_hidden[] = 'gianni.de.amicis@gmail.com';
//$mail_to_hidden[] = 'davide@vg59.it';

define('APP_MAIL_TO_HIDDEN', serialize($mail_to_hidden));


define('APP_MAIL_FROM', 'info@skf-actuator.local');
define('APP_MAIL_REPLY', 'info@skf-actuator.local');
/*
define('APP_MAIL_TO_CATALOGO_ITALNOLO', 'info@skf-actuator.local');

define('APP_MAIL_TO_INFO', 'info@skf-actuator.local');
*/

// email config
Configure::write (
    'Email.optionSmtp', array (
        'port' => '25',
        'timeout'=>'30',
        'host'=> 'smtp.crop.it',
        'username' => 'sender@synesthesia.it',
        'password' => '--sender--',
    )
);

?>
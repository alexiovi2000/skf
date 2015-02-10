<?php

//parametri configurazione PHP
define('TIME_LIMIT', 14400);
define('MEMORY_LIMIT', 1024*2 . 'M');
set_time_limit (TIME_LIMIT);
ini_set('memory_limit', MEMORY_LIMIT);


// ruoli utente
define('ID_USERROLE_SUPERADMIN', '1');
define('ID_USERROLE_ADMIN', '2');
define('ID_USERROLE_USER', '3');

define('ID_USERROLE_PUBLIC_USER', '7');


// tipi utente
define('ID_USERTYPE_FRONTEND', '1');
define('ID_USERTYPE_BACKEND', '2');

$usertypes = array();
$usertypes[ID_USERTYPE_FRONTEND] = ID_USERTYPE_FRONTEND;
$usertypes[ID_USERTYPE_BACKEND] = ID_USERTYPE_BACKEND;
define('USERTYPES', serialize($usertypes));


// status utente
define('ID_USERSTATUS_PENDING', '1');
define('ID_USERSTATUS_ENABLED', '2');
define('ID_USERSTATUS_DISABLED', '3');

define('ID_USERSTATUS_DEFAULT', ID_USERSTATUS_PENDING);


// utente non eliminabile
define('ID_USERADMIN_DEFAULT', '1');


// regole controllo pwd
define('PASSWORD_MIN_CHAR', '5');
define('PASSWORD_MAX_CHAR', '20');

define('PASSWORD_RANDOM_MAX_CHAR', '8');
define('PASSWORD_RANDOM_POSSIBLE', '1234567890' . 'abcdefghijklmnopqrstuvwxyz');


// parametri paginazione
define('MAX_RECORD_LIST_RECORD', '10');


// tipi email
define('ID_MAILMESSAGETYPE_SISTEMA', '1');
define('ID_MAILMESSAGETYPE_UTENTE', '2');

define('MAILMESSAGE_SUBJECT_PREFIX', 'skf actuator selector - ');


// famiglie prodotti
define('ID_PRODUCT_TYPE_CONTROL', '1');
define('ID_PRODUCT_TYPE_LINEAR', '2');
define('ID_PRODUCT_TYPE_PILLAR', '3');
define('ID_PRODUCT_TYPE_ROTARY', '4');

define('ID_PRODUCT_TYPE_ACCESSORY', '5');
define('ID_PRODUCT_TYPE_ASSOCIATION', '6');


define('CODE_PRODUCT_TYPE_CONTROL', 'control');
define('CODE_PRODUCT_TYPE_LINEAR', 'linear');
define('CODE_PRODUCT_TYPE_PILLAR', 'pillar');
define('CODE_PRODUCT_TYPE_ROTARY', 'rotary');

define('CODE_PRODUCT_TYPE_ACCESSORY', 'accessory');


define('SLUG_PRODUCT_TYPE_CONTROL', 'products-control');
define('SLUG_PRODUCT_TYPE_LINEAR', 'products-linear');
define('SLUG_PRODUCT_TYPE_PILLAR', 'products-pillar');
define('SLUG_PRODUCT_TYPE_ROTARY', 'products-rotary');

define('SLUG_PRODUCT_TYPE_ACCESSORY', 'products-accessory');


// utility visualizzazione
define('SLUG_PRODUCT_COMPARE_SELECT', 'products-compare-select');

define('SLUG_PRODUCT_COMPARE_VIEW', 'products-compare-view');

define('SLUG_PRODUCT_ACCESSORIES', 'products-accessories');



// numero massimo prodotti comparabili
define('MAX_PRODUCT_COMPARE', '3');



// gestione allegati
$max_file_size_tmp = 4; // MB
$max_file_size_ctrl = (int) ini_get('upload_max_filesize');
$max_file_size_selected = ($max_file_size_tmp > $max_file_size_ctrl) ? $max_file_size_ctrl : $max_file_size_tmp;

define('UPLOAD_MAX_FILE_SIZE', $max_file_size_selected);
define('UPLOAD_MAX_FILE_SIZE_BYTE', UPLOAD_MAX_FILE_SIZE * 1024 * 1024);


define('MAX_WIDTH_IMAGE_PRODUCT_PREVIEW', 150);
define('MAX_HEIGHT_IMAGE_PRODUCT_PREVIEW', 120);
define('IMAGE_RESIZE_QUALITY', 90);


// Date format
define('DATE_FORMAT', 'd/m/Y');
define('DATE_HOUR_FORMAT', 'd/m/Y H:i:s');


//date formatter behaviour
Configure::write('DateBehaviour.dateFormat', 'dd/mm/yyyy');
Configure::write('DateBehaviour.delimiterDateFormat', '/');

//language default admin
//Configure::write('Config.language', $locale);

//Configure::write('Config.language_admin', 'eng');



// formattazione valuta
/*
 * - `before` - The currency symbol to place before whole numbers ie. '$'
 * - `after` - The currency symbol to place after decimal numbers ie. 'c'. Set to boolean false to
 *    use no decimal symbol.  eg. 0.35 => $0.35.
 * - `zero` - The text to use for zero values, can be a string or a number. ie. 0, 'Free!'
 * - `places` - Number of decimal places to use. ie. 2
 * - `thousands` - Thousands separator ie. ','
 * - `decimals` - Decimal separator symbol ie. '.'
 * - `negative` - Symbol for negative numbers. If equal to '()', the number will be wrapped with ( and )
 * - `escape` - Should the output be htmlentity escaped? Defaults to true
*/
/*
$numbers_format = array();
$numbers_format['before'] = '';
$numbers_format['after'] = '';
$numbers_format['zero'] = '0';
$numbers_format['places'] = '2';
$numbers_format['thousands'] = '.';
$numbers_format['decimals'] = ',';

define('NUMBERS_FORMAT', serialize($numbers_format));
*/


// durata archivio log
define('LOG_DURATION_DAY', 30);






define('URL_CODE_SEPARATOR', '|||');











//TODO: verificare implementazione traduzioni voci menu
// menu admin navigazione top
$navigation_links = array();



////////////////////////////////////////////////////////////////////////////////////////////////
// link backend abilitati x utenti loggati (ruoli definiti in enabled_roles)
////////////////////////////////////////////////////////////////////////////////////////////////

// torna al sito pubblico
$navigation_links['items']['Menu.title.Home'] = array('target' => '/','items' => array());
$navigation_links['items']['Menu.title.Home']['visible'] = true;
$navigation_links['items']['Menu.title.Home']['page_title'] = 'Menu.page_title.Home';
$navigation_links['items']['Menu.title.Home']['form_title'] = 'Menu.form_title.Home';
$navigation_links['items']['Menu.title.Home']['enabled_roles'] = array(ID_USERROLE_SUPERADMIN, ID_USERROLE_ADMIN, ID_USERROLE_USER);
// x file pot //
$var_tmp = __('Menu.title.Home', true);
$var_tmp = __('Menu.page_title.Home', true);
$var_tmp = __('Menu.form_title.Home', true);
// x file pot //


// gestione utenti
$navigation_links['items']['Menu.title.User.change_pwd'] = array('target' => '/admin/users/change_password/','items' => array());
$navigation_links['items']['Menu.title.User.change_pwd']['visible'] = true;
$navigation_links['items']['Menu.title.User.change_pwd']['page_title'] = 'Menu.page_title.User.change_pwd';
$navigation_links['items']['Menu.title.User.change_pwd']['form_title'] = 'Menu.form_title.User.change_pwd';
$navigation_links['items']['Menu.title.User.change_pwd']['enabled_roles'] = array(ID_USERROLE_SUPERADMIN, ID_USERROLE_ADMIN, ID_USERROLE_USER);
// x file pot //
$var_tmp = __('Menu.title.User.change_pwd', true);
$var_tmp = __('Menu.page_title.User.change_pwd', true);
$var_tmp = __('Menu.form_title.User.change_pwd', true);
// x file pot //

$navigation_links['items']['Menu.title.User.index'] = array('target' => '/admin/users/index/','items' => array());
$navigation_links['items']['Menu.title.User.index']['visible'] = true;
$navigation_links['items']['Menu.title.User.index']['page_title'] = 'Menu.page_title.User.index';
$navigation_links['items']['Menu.title.User.index']['form_title'] = 'Menu.form_title.User.index';
$navigation_links['items']['Menu.title.User.index']['enabled_roles'] = array(ID_USERROLE_SUPERADMIN, ID_USERROLE_ADMIN);
// x file pot //
$var_tmp = __('Menu.title.User.index', true);
$var_tmp = __('Menu.page_title.User.index', true);
$var_tmp = __('Menu.form_title.User.index', true);
// x file pot //

	$navigation_links['items']['Menu.title.User.index']['items']['Menu.title.User.add'] = array('target' => '/admin/users/add/','items' => array());
	$navigation_links['items']['Menu.title.User.index']['items']['Menu.title.User.add']['visible'] = false;
	$navigation_links['items']['Menu.title.User.index']['items']['Menu.title.User.add']['page_title'] = 'Menu.page_title.User.add';
	$navigation_links['items']['Menu.title.User.index']['items']['Menu.title.User.add']['form_title'] = 'Menu.form_title.User.add';
	$navigation_links['items']['Menu.title.User.index']['items']['Menu.title.User.add']['enabled_roles'] = array(ID_USERROLE_SUPERADMIN, ID_USERROLE_ADMIN);
// x file pot //
$var_tmp = __('Menu.title.User.add', true);
$var_tmp = __('Menu.page_title.User.add', true);
$var_tmp = __('Menu.form_title.User.add', true);
// x file pot //

	$navigation_links['items']['Menu.title.User.index']['items']['Menu.title.User.edit'] = array('target' => '/admin/users/edit/','items' => array());
	$navigation_links['items']['Menu.title.User.index']['items']['Menu.title.User.edit']['visible'] = false;
	$navigation_links['items']['Menu.title.User.index']['items']['Menu.title.User.edit']['page_title'] = 'Menu.page_title.User.edit';
	$navigation_links['items']['Menu.title.User.index']['items']['Menu.title.User.edit']['form_title'] = 'Menu.form_title.User.edit';
	$navigation_links['items']['Menu.title.User.index']['items']['Menu.title.User.edit']['enabled_roles'] = array(ID_USERROLE_SUPERADMIN, ID_USERROLE_ADMIN);
// x file pot //
$var_tmp = __('Menu.title.User.edit', true);
$var_tmp = __('Menu.page_title.User.edit', true);
$var_tmp = __('Menu.form_title.User.edit', true);
// x file pot //

	$navigation_links['items']['Menu.title.User.index']['items']['Menu.title.User.delete'] = array('target' => '/admin/users/delete/','items' => array());
	$navigation_links['items']['Menu.title.User.index']['items']['Menu.title.User.delete']['visible'] = false;
	$navigation_links['items']['Menu.title.User.index']['items']['Menu.title.User.delete']['page_title'] = 'Menu.page_title.User.delete';
	$navigation_links['items']['Menu.title.User.index']['items']['Menu.title.User.delete']['form_title'] = 'Menu.form_title.User.delete';
	$navigation_links['items']['Menu.title.User.index']['items']['Menu.title.User.delete']['enabled_roles'] = array(ID_USERROLE_SUPERADMIN, ID_USERROLE_ADMIN);
// x file pot //
$var_tmp = __('Menu.title.User.delete', true);
$var_tmp = __('Menu.page_title.User.delete', true);
$var_tmp = __('Menu.form_title.User.delete', true);
// x file pot //


// gestione importazione dati
$navigation_links['items']['Menu.title.Importfile'] = array('target' => '','items' => array());
$navigation_links['items']['Menu.title.Importfile']['visible'] = true;
$navigation_links['items']['Menu.title.Importfile']['page_title'] = 'Menu.page_title.Importfile';
$navigation_links['items']['Menu.title.Importfile']['form_title'] = 'Menu.form_title.Importfile';
$navigation_links['items']['Menu.title.Importfile']['enabled_roles'] = array(ID_USERROLE_SUPERADMIN, ID_USERROLE_ADMIN, ID_USERROLE_USER);
// x file pot //
$var_tmp = __('Menu.title.Importfile', true);
$var_tmp = __('Menu.page_title.Importfile', true);
$var_tmp = __('Menu.form_title.Importfile', true);
// x file pot //

    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.pillar'] = array('target' => '/admin/importfiles/pillar/','items' => array());
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.pillar']['visible'] = true;
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.pillar']['page_title'] = 'Menu.page_title.Importfile.pillar';
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.pillar']['form_title'] = 'Menu.form_title.Importfile.pillar';
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.pillar']['enabled_roles'] = array(ID_USERROLE_SUPERADMIN, ID_USERROLE_ADMIN, ID_USERROLE_USER);
// x file pot //
$var_tmp = __('Menu.title.Importfile.pillar', true);
$var_tmp = __('Menu.page_title.Importfile.pillar', true);
$var_tmp = __('Menu.form_title.Importfile.pillar', true);
// x file pot //

    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.linear'] = array('target' => '/admin/importfiles/linear/','items' => array());
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.linear']['visible'] = true;
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.linear']['page_title'] = 'Menu.page_title.Importfile.linear';
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.linear']['form_title'] = 'Menu.form_title.Importfile.linear';
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.linear']['enabled_roles'] = array(ID_USERROLE_SUPERADMIN, ID_USERROLE_ADMIN, ID_USERROLE_USER);
// x file pot //
$var_tmp = __('Menu.title.Importfile.linear', true);
$var_tmp = __('Menu.page_title.Importfile.linear', true);
$var_tmp = __('Menu.form_title.Importfile.linear', true);
// x file pot //

    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.rotary'] = array('target' => '/admin/importfiles/rotary/','items' => array());
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.rotary']['visible'] = true;
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.rotary']['page_title'] = 'Menu.page_title.Importfile.rotary';
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.rotary']['form_title'] = 'Menu.form_title.Importfile.rotary';
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.rotary']['enabled_roles'] = array(ID_USERROLE_SUPERADMIN, ID_USERROLE_ADMIN, ID_USERROLE_USER);
// x file pot //
$var_tmp = __('Menu.title.Importfile.rotary', true);
$var_tmp = __('Menu.page_title.Importfile.rotary', true);
$var_tmp = __('Menu.form_title.Importfile.rotary', true);
// x file pot //

    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.control'] = array('target' => '/admin/importfiles/control/','items' => array());
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.control']['visible'] = true;
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.control']['page_title'] = 'Menu.page_title.Importfile.control';
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.control']['form_title'] = 'Menu.form_title.Importfile.control';
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.control']['enabled_roles'] = array(ID_USERROLE_SUPERADMIN, ID_USERROLE_ADMIN, ID_USERROLE_USER);
// x file pot //
$var_tmp = __('Menu.title.Importfile.control', true);
$var_tmp = __('Menu.page_title.Importfile.control', true);
$var_tmp = __('Menu.form_title.Importfile.control', true);
// x file pot //

    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.accessory'] = array('target' => '/admin/importfiles/accessory/','items' => array());
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.accessory']['visible'] = true;
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.accessory']['page_title'] = 'Menu.page_title.Importfile.accessory';
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.accessory']['form_title'] = 'Menu.form_title.Importfile.accessory';
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.accessory']['enabled_roles'] = array(ID_USERROLE_SUPERADMIN, ID_USERROLE_ADMIN, ID_USERROLE_USER);
// x file pot //
$var_tmp = __('Menu.title.Importfile.accessory', true);
$var_tmp = __('Menu.page_title.Importfile.accessory', true);
$var_tmp = __('Menu.form_title.Importfile.accessory', true);
// x file pot //

    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.association'] = array('target' => '/admin/importfiles/association/','items' => array());
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.association']['visible'] = true;
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.association']['page_title'] = 'Menu.page_title.Importfile.association';
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.association']['form_title'] = 'Menu.form_title.Importfile.association';
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.association']['enabled_roles'] = array(ID_USERROLE_SUPERADMIN, ID_USERROLE_ADMIN, ID_USERROLE_USER);
// x file pot //
$var_tmp = __('Menu.title.Importfile.association', true);
$var_tmp = __('Menu.page_title.Importfile.association', true);
$var_tmp = __('Menu.form_title.Importfile.association', true);
// x file pot //

    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.import_result'] = array('target' => '/admin/importfiles/import_result/','items' => array());
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.import_result']['visible'] = false;
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.import_result']['page_title'] = 'Menu.page_title.Importfile.import_result';
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.import_result']['form_title'] = 'Menu.form_title.Importfile.import_result';
    $navigation_links['items']['Menu.title.Importfile']['items']['Menu.title.Importfile.import_result']['enabled_roles'] = array(ID_USERROLE_SUPERADMIN, ID_USERROLE_ADMIN, ID_USERROLE_USER);
// x file pot //
$var_tmp = __('Menu.title.Importfile.import_result', true);
$var_tmp = __('Menu.page_title.Importfile.import_result', true);
$var_tmp = __('Menu.form_title.Importfile.import_result', true);
// x file pot //



/*
$navigation_links['items']['Menu.title.Log.index'] = array('target' => '/admin/logs/index/','items' => array());
$navigation_links['items']['Menu.title.Log.index']['visible'] = true;
$navigation_links['items']['Menu.title.Log.index']['page_title'] = 'Menu.page_title.Log.index';
$navigation_links['items']['Menu.title.Log.index']['form_title'] = 'Menu.form_title.Log.index';
$navigation_links['items']['Menu.title.Log.index']['enabled_roles'] = array(ID_USERROLE_SUPERADMIN, ID_USERROLE_ADMIN);
// x file pot //
$var_tmp = __('Menu.title.Log.index', true);
$var_tmp = __('Menu.page_title.Log.index', true);
$var_tmp = __('Menu.form_title.Log.index', true);
// x file pot //

    $navigation_links['items']['Menu.title.Log.index']['items']['Menu.title.Log.view'] = array('target' => '/admin/logs/view/','items' => array());
    $navigation_links['items']['Menu.title.Log.index']['items']['Menu.title.Log.view']['visible'] = false;
    $navigation_links['items']['Menu.title.Log.index']['items']['Menu.title.Log.view']['page_title'] = 'Menu.page_title.Log.view';
    $navigation_links['items']['Menu.title.Log.index']['items']['Menu.title.Log.view']['form_title'] = 'Menu.form_title.Log.view';
    $navigation_links['items']['Menu.title.Log.index']['items']['Menu.title.Log.view']['enabled_roles'] = array(ID_USERROLE_SUPERADMIN, ID_USERROLE_ADMIN);
// x file pot //
$var_tmp = __('Menu.title.Log.view', true);
$var_tmp = __('Menu.page_title.Log.view', true);
$var_tmp = __('Menu.form_title.Log.view', true);
// x file pot //
*/

define('NAVIGATION_LINKS', serialize($navigation_links));


// url che non devono essere loggati
$url_not_logged = array();
/*
$url_not_logged[] = '/admin/logs/index/';
$url_not_logged[] = '/admin/logs/view/';
$url_not_logged[] = '/admin/userbackend/index/';
$url_not_logged[] = '/admin/standardconfig/index/';
$url_not_logged[] = '/admin/tableconfig/index/';

$url_not_logged[] = '/mystandard/index/';

//TODO: verificare se escludere o no ...
$url_not_logged[] = '/admin/exportdata/index/';
*/


/*
$url_not_logged[] = '/admin/menus/get_childs/';
$url_not_logged[] = '/admin/contenutis/upload/';
$url_not_logged[] = '/admin/contenutis/paginate/';
$url_not_logged[] = '/admin/contenutis/crop/';
$url_not_logged[] = '/admin/contenutis/add_listino/';
*/

define('URL_NOT_LOGGED', serialize($url_not_logged));



// url che devono essere loggati
$url_logged = array();
$url_logged[] = '/users/login/';
$url_logged[] = '/users/logout/';
/*
$url_logged[] = '/admin/surveys/add/';
$url_logged[] = '/admin/surveys/edit/';
$url_logged[] = '/admin/surveys/delete/';
$url_logged[] = '/admin/surveys/new_copy/';
$url_logged[] = '/admin/surveys/new_release/';
*/
define('URL_LOGGED', serialize($url_logged));



?>
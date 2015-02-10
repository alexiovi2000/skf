<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */
class AppController extends Controller {

	var $components = array('Auth', 'RequestHandler', 'Email', 'Cookie', 'Session');
	var $helpers = array('Html', 'Session', 'Paginator', 'MyForm', 'MyPaginator', 'MyMenu', 'Number');

	var $uses = array('User', 'Log');

	public $localization = array(
//		'ita' => 'italiano',
		'eng' => 'inglese',
//		'fre' => 'francese',
//		'deu' => 'tedesco',
//		'spa' => 'spagnolo',
//		'por' => 'portoghese',
//		'chi' => 'cinese',
	);

	var $user_logged = array();
	var $user_logged_role_id = 0;
	var $user_logged_type_id = 0;

	var $main_menu_items = array();

	var $public_menu_items = array();

/*
var $last_contents = array();
var $more_viewed_contents = array();
*/

	var $my_page_title = 'page title default';
	var $my_form_title = 'form title default';

/*
	var $user_sex = array();

	var $user_agent = '';
	var $user_agent_ctrl = array();
*/

	function beforeFilter() {
//		Configure::write('Cache.disable', Configure::read('debug'));


		//Gestione lingue
		$this->_detectLanguage();

/*
//TODO: da eliminare con relative dipendenze
$this->user_agent = env('HTTP_USER_AGENT');
$this->set('user_agent', $this->user_agent);

$this->user_agent_ctrl = unserialize(USER_AGENT_CTRL);
$this->set('user_agent_ctrl', $this->user_agent_ctrl);
//TODO: da eliminare con relative dipendenze
*/

		$this->set('localization', $this->localization);



//TODO: personalizzare su controller / action
		$description_for_layout = __('metatag description default', true);
		$this->set('description_for_layout', $description_for_layout);

		$keywords_for_layout = __('metatag keywords default', true);
		$this->set('keywords_for_layout', $keywords_for_layout);
//TODO: personalizzare su controller / action


/*
		$this->user_sex = unserialize(USER_SEX);
		$this->set('user_sex',$this->user_sex);
*/

/*
		$this->numbers_format = unserialize(NUMBERS_FORMAT);
		$this->set('numbers_format',$this->numbers_format);
*/

/*
		$this->elenco_professioni = unserialize(ELENCO_PROFESSIONI);
		$this->set('elenco_professioni',$this->elenco_professioni);
*/
//pr('$this->params');
//pr($this->params);

		$is_protected = false;

		$url_redirect = '';
		$user_admin_confirmed = true;
		$user_menu_enabled = true;
		$user_status_enabled = true;


// inizializzo parametri auth component
		if (isset($this->Auth)) {
//			$this->Auth->userScope = array('User.admin_confirmed' => '1');
			$this->Auth->loginAction = '/users/login/';
			$this->Auth->autoRedirect = false;
		}

//pr($this->params);



$url_selected = $this->_verify_url_selected ();
//pr('$url_selected  ' .$url_selected );


$this->layout = 'public';
$this->set('url_selected', $url_selected);
//pr('$url_selected ' . $url_selected);
$this->main_menu_items = unserialize(NAVIGATION_LINKS);
$this->set('main_menu_items', $this->main_menu_items);

$this->public_menu_items = $this->_create_public_menu();
$this->set('public_menu_items', $this->public_menu_items);

/*
$this->last_contents = $this->_create_last_contents();
$this->set('last_contents', $this->last_contents);

$this->more_viewed_contents = $this->_create_more_viewed_contents();
$this->set('more_viewed_contents', $this->more_viewed_contents);
*/

		if (!empty($this->params['admin']) && $this->params['admin'] == 1) {

			$is_protected = true;
			$this->layout = 'admin';
//TODO: verificare
// settaggio lingua defaul x admin
/*
			$locale_admin = Configure::read('Config.language_admin');
			if (!$this->Session->check('locale_public')) {
				$locale_public = $this->Session->read('locale');
				$this->Session->write('locale_public', $locale_public);
			}
			$this->Session->write('locale', $locale_admin);
pr('$locale_admin ' . $locale_admin);
pr('$locale_public ' . $locale_public);
pr('qqqq $this->Session->read(\'locale_public\') ' . $this->Session->read('locale_public'));
		} else {
pr('qqqq ' . $this->Session->read('locale_public'));
//exit();
			if ($this->Session->check('locale_public') && $this->Session->read('locale_public')) {
				$locale_public = $this->Session->read('locale_public');
				$this->Session->write('locale', $locale_public);
				$this->Session->delete('locale_public');
pr('$locale_public ' . $locale_public);
			}
*/
		}
//TODO: verificare

/*
pr('$this->layout ' . $this->layout);
pr('$is_protected ' . $is_protected);
exit();
*/

		if ($is_protected) {

			if (isset($this->Auth)) {

			// dati utente loggato x trackable behavior
				$this->user_logged = $this->Auth->user();
				$this->user_logged_role_id = $this->user_logged['User']['userrole_id'];
				$this->user_logged_type_id = $this->user_logged['User']['usertype_id'];

				$user_admin_confirmed = ($this->user_logged['User']['admin_confirmed'] == true) ? true : false;
				$user_status_enabled = ($this->user_logged['User']['userstatus_id'] == ID_USERSTATUS_ENABLED) ? true : false;
				$user_menu_enabled = $this->_verifyUserMenuEnabled();

			}

		} else {

			if (isset($this->Auth)) {

			// dati utente loggato x trackable behavior
				$this->user_logged = $this->Auth->user();
				$this->user_logged_role_id = $this->user_logged['User']['userrole_id'];
				$this->user_logged_type_id = $this->user_logged['User']['usertype_id'];

//				$user_admin_confirmed = ($this->user_logged['User']['admin_confirmed'] == true) ? true : false;
//				$user_status_enabled = ($this->user_logged['User']['userstatus_id'] == ID_USERSTATUS_ENABLED) ? true : false;
//				$user_menu_enabled = $this->_verifyUserMenuEnabled();

			}

			$this->Auth->allow();
		}


	// dati utente loggato x trackable behavior
		Configure::write('User', $this->user_logged);
/*
pr($this->user_logged);
pr('$user_admin_confirmed ' . $user_admin_confirmed);
pr('$user_status_enabled ' . $user_status_enabled);
pr('$user_menu_enabled ' . $user_menu_enabled);
exit();
*/



    //trim su tutti i dati passati da form
        if(!empty($this->data)){
            array_walk_recursive($this->data, create_function('&$var, $key', '$var = trim($var);'));
        }

		$this->set('user_logged',$this->user_logged);

		$this->set('user_logged_role_id',$this->user_logged_role_id);
		$this->set('user_logged_type_id',$this->user_logged_type_id);


	// verifico conferma backend
		if (!$user_admin_confirmed) {
//			$url_redirect = '/users/backend_not_confirmed/';
			$url_redirect = '/';
			$this->my_page_title = '/users/backend_not_confirmed/';
		}

	// verifico status utente
		if (!$user_status_enabled) {
//			$url_redirect = '/users/status_not_enabled/';
			$url_redirect = '/';
			$this->my_page_title = '/users/status_not_enabled/';
		}

	// verifico abilitazione voce menu selezionata
		if (!$user_menu_enabled) {
//			$url_redirect = '/users/menu_not_enabled/';
			$url_redirect = '/';
			$this->my_page_title = '/users/menu_not_enabled/';
		}

	// inizializzo titoli pagina form (eventualmente aggiornati da $this->_verifyUserMenuEnabled())
		$this->set('my_page_title', __($this->my_page_title, true));
		$this->set('my_form_title', __($this->my_form_title, true));
/*
pr('$url_redirect ' . $url_redirect);
exit();
*/
		if ($url_redirect) {
			$this->redirect($url_redirect);
		}

		parent::beforeFilter();
	}


	function beforeRender() {
/*
pr($this->name);
exit();
*/
/*

	    if($this->name == 'CakeError') {

			$this->layout = 'error';

	//TODO: personalizzare su controller / action
			$description_for_layout = '';
			$this->set('description_for_layout', $description_for_layout);

			$keywords_for_layout = '';
			$this->set('keywords_for_layout', $keywords_for_layout);
	//TODO: personalizzare su controller / action

			$url_selected = '/errore_controller/';
			$this->set('url_selected', $url_selected);
//pr('$url_selected ' . $url_selected);

			$this->main_menu_items = unserialize(NAVIGATION_LINKS);

			$this->public_menu_items = $this->_create_public_menu();


			if (isset($this->Auth)) {
			// dati utente loggato x trackable behavior
				$this->user_logged = $this->Auth->user();
				$this->user_logged_role_id = $this->user_logged['User']['userrole_id'];
				$this->user_logged_type_id = $this->user_logged['User']['usertype_id'];
			}

			$this->Auth->allow();


			$this->set('user_logged',$this->user_logged);

			$this->set('user_logged_role_id',$this->user_logged_role_id);
			$this->set('user_logged_type_id',$this->user_logged_type_id);

			$this->set('main_menu_items', $this->main_menu_items);

			$this->set('public_menu_items', $this->public_menu_items);

	    }
*/

	}


	function _verifyUserMenuEnabled ($user_type = null) {
		$user_enabled = true;
//pr('$this->_verify_url_selected() ' . $this->_verify_url_selected());
//pr($this->menuItems['items']);

		// verifico esistenza voce menu selezionata
		$menu_selected = $this->_getMenuByUrl($this->main_menu_items['items'], $this->_verify_url_selected());
//pr('$menu_selected');
//pr($menu_selected);
//exit();
		// verifico abilitazioni utente
		if ($menu_selected) {

			$user_logged_role_id = $this->user_logged_role_id;

// definisco titoli delle pagine
            $this->my_page_title = isset($menu_selected['page_title']) ? __($menu_selected['page_title'], true) : 'page title default';
            $this->my_form_title = isset($menu_selected['form_title']) ? __($menu_selected['form_title'], true) : 'form title default';

			if (
                    (isset($menu_selected['enabled_roles']) && count($menu_selected['enabled_roles']) && in_array($user_logged_role_id, $menu_selected['enabled_roles']))
                    ||
                    (isset($menu_selected['enabled_roles']) && !count($menu_selected['enabled_roles']))
                    ||
                    !isset($menu_selected['enabled_roles'])
                ) {
				// utente abilitato
				$user_enabled = true;
			} else {
				// utente non abilitato
				$user_enabled = false;
			}
		} else {
			//TODO: gestire non esiste voce di menu in array
			$user_enabled = false;
		}

		return $user_enabled;

	}



	function _getMenuByUrl ($items, $url_selected) {
		static $menu_selected = array();
//pr($items);
//pr('$url_selected ' . $url_selected);
		if(is_array($items)){
			foreach($items as $label => $item) {
//pr('$label ' . $label);
//pr('$item[\'target\'] ' . $item['target']);
				$target = (isset($item['target'])) ? $item['target'] : '#';
				if ($target == $url_selected) {
					$menu_selected = $item;
					break;
				} elseif (isset($item['items']) && sizeof($item['items']) > 0) {
					$this->_getMenuByUrl($item['items'], $url_selected);
				}
			}
		}
//pr('$menu_selected _getMenuByUrl');
//pr($menu_selected);
		return $menu_selected;
	}



	function _verify_url_selected ($params_tmp = array()) {
	   if ($params_tmp) {
	       $this->params = $params_tmp;
	   }

		$url_selected = '/';
		$routing_prefix_tmp = '';

		$controller_tmp = isset($this->params['controller']) ? $this->params['controller'] : '';
		$action_tmp = isset($this->params['action']) ? $this->params['action'] : '';


		$routing_prefixes = Configure::read('Routing.prefixes');
		foreach ($routing_prefixes as $key => $value) {
			if (isset($this->params[$value]) && $this->params[$value] == 1) {
				$routing_prefix_tmp = $value;
				break;
			}
		}

		if ($routing_prefix_tmp) {
			$url_selected .= $routing_prefix_tmp . '/';
		}

		if ($controller_tmp) {
			$url_selected .= $controller_tmp . '/';
		}

		if ($action_tmp) {
			if($routing_prefix_tmp) {
				$action_tmp = substr($action_tmp, strlen($routing_prefix_tmp)+1, strlen($action_tmp));
			}
			$url_selected .= $action_tmp . '/';
		}
//		pr('$url_selected ' . $url_selected);
		//pr($this->vociMenu);
		return $url_selected;

	}



	function _create_public_menu () {
// dati x menu di navigazione categorie prodotti
// TODO: eliminare il duplicato $public_menu / $nav_pills_data
		$public_menu = array();
/*
•	Telescopic pillars
•	Linear actuators
•	Rotary actuators
•	Control units
*/
		$public_menu[ID_PRODUCT_TYPE_PILLAR]['name'] = __('nome prodotto pillar', true);
		$public_menu[ID_PRODUCT_TYPE_PILLAR]['slug'] = SLUG_PRODUCT_TYPE_PILLAR;
		$public_menu[ID_PRODUCT_TYPE_PILLAR]['description'] = __('descrizione prodotto pillar', true);
		$public_menu[ID_PRODUCT_TYPE_PILLAR]['url_ctrl'] = '/public/' . str_replace ( '-', '_', SLUG_PRODUCT_TYPE_PILLAR);

		$public_menu[ID_PRODUCT_TYPE_LINEAR]['name'] = __('nome prodotto linear', true);
		$public_menu[ID_PRODUCT_TYPE_LINEAR]['slug'] = SLUG_PRODUCT_TYPE_LINEAR;
		$public_menu[ID_PRODUCT_TYPE_LINEAR]['description'] = __('descrizione prodotto linear', true);
		$public_menu[ID_PRODUCT_TYPE_LINEAR]['url_ctrl'] = '/public/' . str_replace ( '-', '_', SLUG_PRODUCT_TYPE_LINEAR);

		$public_menu[ID_PRODUCT_TYPE_ROTARY]['name'] = __('nome prodotto rotary', true);
		$public_menu[ID_PRODUCT_TYPE_ROTARY]['slug'] = SLUG_PRODUCT_TYPE_ROTARY;
		$public_menu[ID_PRODUCT_TYPE_ROTARY]['description'] = __('descrizione prodotto rotary', true);
		$public_menu[ID_PRODUCT_TYPE_ROTARY]['url_ctrl'] = '/public/' . str_replace ( '-', '_', SLUG_PRODUCT_TYPE_ROTARY);

		$public_menu[ID_PRODUCT_TYPE_CONTROL]['name'] = __('nome prodotto control', true);
		$public_menu[ID_PRODUCT_TYPE_CONTROL]['slug'] = SLUG_PRODUCT_TYPE_CONTROL;
		$public_menu[ID_PRODUCT_TYPE_CONTROL]['description'] = __('descrizione prodotto control', true);
		$public_menu[ID_PRODUCT_TYPE_CONTROL]['url_ctrl'] = '/public/' . str_replace ( '-', '_', SLUG_PRODUCT_TYPE_CONTROL);

		$public_menu[ID_PRODUCT_TYPE_ACCESSORY]['name'] = __('nome prodotto accessory', true);
		$public_menu[ID_PRODUCT_TYPE_ACCESSORY]['slug'] = SLUG_PRODUCT_TYPE_ACCESSORY;
		$public_menu[ID_PRODUCT_TYPE_ACCESSORY]['description'] = __('descrizione prodotto accessory', true);
		$public_menu[ID_PRODUCT_TYPE_ACCESSORY]['url_ctrl'] = '/public/' . str_replace ( '-', '_', SLUG_PRODUCT_TYPE_ACCESSORY);


//TODO: verificare
$nav_pills_data = array();
$nav_pills_data = $public_menu;
$this->set('nav_pills_data', $nav_pills_data);
//TODO: verificare

		return $public_menu;

	}



	function _sendMail($to = '', $bcc = array(), $subject = '', $replyTo = '', $from = '', $template = 'default', $attachments = array(), $params = array()) {

		$this->Email->reset();

		// set delivery method
		$this->Email->delivery = 'smtp'; //APP_MAIL_DELIVERY;
		$this->Email->smtpOptions = Configure::read('Email.optionSmtp');
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs = 'both'; // because we like to send pretty mail

		$this->Email->to = $to; //$User['User']['email'];


// verifico se inviare anche mail bcc a indirizzi predefiniti in _init.mail
		$mail_to_hidden = unserialize(APP_MAIL_TO_HIDDEN);
		if (is_array($mail_to_hidden) && count($mail_to_hidden)) {
			foreach($mail_to_hidden as $key => $value) {
				$bcc[] = $value;
			}
        }

		$this->Email->bcc = $bcc; //array('secret@example.com');

		$this->Email->subject = $subject; //'Welcome to our really cool thing';

		if(!$replyTo) {
			$replyTo = APP_MAIL_REPLY;
		}
		$this->Email->replyTo = $replyTo; //'support@example.com';

		if(!$from) {
			$from = APP_MAIL_FROM;
		}
		$this->Email->from = $from; //'Cool Web App <app@example.com>';

		$this->Email->template = $template; //'simple_message'; // note no '.ctp'

		$this->Email->attachments = $attachments;
/*
$this->Email->attachments = array(
	TMP . 'foo.doc',
	'bar.doc' => TMP . 'some-temp-name'
);
*/

	//Email's parameters, $params must be an associative array ie. $params['key']
		$this->set('params',$params);


		$result = array();

        if (APP_MAIL_SEND) {
			$result['send'] = $this->Email->send();
			$result['smtp_errors'] = $this->Email->smtpError;
/* Check for SMTP errors. */
//$this->set('smtp_errors', $this->Email->smtpError);
        } else {
            pr('$this->Email->to');
            pr($this->Email->to);
            pr('$this->Email->bcc');
            pr($this->Email->bcc);
            pr('$this->Email->subject');
            pr($this->Email->subject);
            pr('$this->Email->from');
            pr($this->Email->from);
            pr('$this->Email->template');
            pr($this->Email->template);
            pr('$params');
            pr($params);

            $result['send'] = true;
            //exit();
        }

		return $result;
	}



/**
 * Auto-detect the request language settings
 */
	function _detectLanguage() {
/*
pr('$this->Session->read(locale)');
pr($this->Session->read('locale'));
*/

/*
		if ($this->Session->check('locale')) {
			$locale = $this->Session->read('locale');
//			$this->l10n->locale = $locale;
		} else {
			$this->l10n->get();
			$locale = $this->l10n->locale;
		}

		switch (true) {
// TODO: verificare funzionamento cambio lingua

			// Italiano
			case ($locale == 'ita'):
			case (strstr($locale, 'it-') !== false):
			case (strstr($locale, 'it_') !== false):
			$locale = 'ita';
			break;

			// Inglese
			case ($locale == 'eng'):
			case (strstr($locale, 'en-') !== false):
			case (strstr($locale, 'en_') !== false):
			$locale = 'eng';
			break;

			// Francese
			case ($locale == 'fre'):
			case (strstr($locale, 'fr-') !== false):
			case (strstr($locale, 'fr-') !== false):
			$locale = 'fre';
			break;

			// Tedesco
			case ($locale == 'deu'):
			case (strstr($locale, 'de_') !== false):
			case (strstr($locale, 'de-') !== false):
			$locale = 'deu';
			break;

			// Spagnolo
			case ($locale == 'spa'):
			case (strstr($locale, 'es_') !== false):
			case (strstr($locale, 'es-') !== false):
			$locale = 'spa';
			break;

			// Portoghese
			case ($locale == 'por'):
			case (strstr($locale, 'pt_') !== false):
			case (strstr($locale, 'pt-') !== false):
			$locale = 'por';
			break;

			// Cinese
			case ($locale == 'chi'):
			case (strstr($locale, 'zh_') !== false):
			case (strstr($locale, 'zh-') !== false):
			$locale = 'chi';
			break;

			default:
			$locale = 'eng';
			break;
// TODO: verificare funzionamento cambio lingua

		}
*/

		$locale = 'eng';
		if ($this->Session->check('locale')) {
			$locale = $this->Session->read('locale');
//			$this->l10n->locale = $locale;
		}
/*
pr('$locale');
pr($locale);
*/
/*
pr('$this->l10n->locale');
pr($this->l10n->locale);
*/
/*
$this->l10n->locale = $locale;
*/

		$this->Session->write('locale', $locale);
		Configure::write('Config.language', $locale);
		$this->Session->write('Config.language', $locale);

	}


	protected function _initPHPExcel() {
	    // Include path
	    set_include_path(get_include_path() . PATH_SEPARATOR . ROOT . DS . APP_DIR . DS . 'vendors' . DS . 'PHPExcel-1.7.7' . DS);
	    // PHPExcel
	    // PHPExcel_IOFactory
	    require_once('PHPExcel/IOFactory.php');
	    //AdvancedValueBinder ADVANCED FORMAT
	    //require_once 'PHPExcel/Cell/AdvancedValueBinder.php';
	}

}
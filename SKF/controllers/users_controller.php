<?php
class UsersController extends AppController {

	var $name = 'Users';

	var $uses = array('User'/*, 'Mailmessage'*/);

	var $page_selected = null;

/*
	// registrazione utente da sito web
	function register ($id = null) {
		$usertype_selected  = '';

		$usertype_selected = ID_USERTYPE_FRONTEND;

		$usertypes = unserialize(USERTYPES);
		$this->set('usertypes', $usertypes);

		$this->set('usertype_selected', $usertype_selected);
		$this->set('usertype_selected_description', $id);
		//pr('$usertype_selected ' . $usertype_selected);

		$confirm_form = false;
		if (isset($this->data['User']['confirm_form']) && $this->data['User']['confirm_form']) {
			$confirm_form = true;
		}


		$this->my_page_title = __('titolo pagina registrazione', true);
		$this->my_form_title = __('titolo form registrazione', true);

		$this->set('my_page_title', __($this->my_page_title, true));
		$this->set('my_form_title', __($this->my_form_title, true));

//TODO: personalizzare su controller / action
		$title_for_layout = __('title_for_layout_registrazione', true);
		$this->set('title_for_layout', $title_for_layout);

		$description_for_layout = __('description_for_layout_registrazione', true);
		$description_for_layout = htmlspecialchars ($description_for_layout);
		$this->set('description_for_layout', $description_for_layout);

		$keywords_for_layout = __('keywords_for_layout_registrazione', true);
		$this->set('keywords_for_layout', $keywords_for_layout);
//TODO: personalizzare su controller / action

		$this->User->create();
		$this->User->Behaviors->detach('Trackable');
		//        $this->User->validate['new_password'];

		unset($this->User->validate['old_password']);
		unset($this->User->validate['new_password']);


		if ($usertype_selected && $confirm_form && !empty($this->data)) {

			// TODO: verificare controlli x salvataggio password e definizione regole in model
			//$this->data['User']['username'] = $this->data['User']['email'];

			if ($this->data['User']['new_password_add']) {
				$this->data['User']['password'] = $this->Auth->password($this->data['User']['new_password_add']);
			}

			$id_userrole_tmp = 0;
			$mail_code_tmp = '';



			if ($usertype_selected == ID_USERTYPE_FRONTEND) {
				$id_userrole_tmp = ID_USERROLE_PUBLIC_USER;
				$mail_code_tmp = 'user_public_register';
			}

			//TODO: userstatus dipende da tipo utente
			$id_userstatus_tmp = ID_USERSTATUS_DEFAULT;

			$conditions = array();
			$conditions['code'] = $mail_code_tmp;
			$mail_message_selected = $this->Mailmessage->find('first', array('conditions' => $conditions));
			//pr($mail_message_selected);

			$email_tpl_tmp = $mail_code_tmp;
			$email_subject_tmp = MAILMESSAGE_SUBJECT_PREFIX;
			$email_subject_tmp .= isset($mail_message_selected['Mailmessage']['subject']) ? $mail_message_selected['Mailmessage']['subject'] : '';
			$email_body_tmp = isset($mail_message_selected['Mailmessage']['body']) ? $mail_message_selected['Mailmessage']['body'] : '';

			$this->data['User']['userrole_id'] = $id_userrole_tmp;
			$this->data['User']['userstatus_id'] = $id_userstatus_tmp;
			// genero codice attivazione
			$this->data['User']['activation_code'] = md5(time() . $this->data['User']['email'] . time());
			//pr($this->data['User']);

			$this->User->set($this->data);

			if ($this->User->validates()) {
				// invio mail notifica registrazione
				// nome tpl email in elements / email
				$email_tpl = $email_tpl_tmp;
				$email_subject = $email_subject_tmp;
				$email_to = $this->data['User']['email'];

				$email_reply_to = '';
				$email_from = '';

				$email_bcc = array();
				$email_attachments = array();

				$activation_url = SITE_BASE_URL . 'users/register_confirm/?code=' . $this->data['User']['activation_code'];
				$activation_link = ''; //'<a href="' . $activation_url . '">' . __('Use this link to confirm subscription', true) . '</a>';

				$email_body = $email_body_tmp;

				$msg_confirm = '';

				$result_mail_send = array();

				$email_params = array(
										'user_data' => $this->data['User'],
										'activation_url' => $activation_url,
										'activation_link' => $activation_link,
										'email_body' => $email_body
				);

				if (APP_MAIL_SEND) {
					$result_mail_send = $this->_sendMail($email_to, $email_bcc, $email_subject_tmp, $email_reply_to, $email_from, $email_tpl_tmp, $email_attachments, $email_params);
				} else {
					$msg_confirm .= '<br />';
					$msg_confirm .= '$url confirm: ' . $url . '<br />';
					$msg_confirm .= '$activation_link: ' . $activation_link . '<br />';
					$result_mail_send['send'] = true;
					$result_mail_send['smtp_errors'] = array();
				}

				// vincolo registrazione utente a invio positivo email
				if ($result_mail_send['send'] == true) {

					$this->User->save($this->data);
					$this->Session->setFlash(__('The User has been registered', true) . $msg_confirm);
					$this->set('send_form', true);

				} else {

					$msg_tmp = __('The User could not be saved. Please, try again.', true) . '<br/>' . __('Registration send mail error', true);
					$this->Session->setFlash($msg_tmp);
					pr($result['smtp_errors']);
				}

			} else {

//$errors = $this->User->invalidFields();
//pr($errors);

				$this->data['User']['new_password_add'] = '';
				$this->data['User']['confirm_password'] = '';

				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}


		}

	}
*/


/*
	// conferma registrazione utente da sito web
	function register_confirm() {

		$this->my_page_title = __('titolo pagina conferma registrazione', true);
		$this->my_form_title = __('titolo form conferma registrazione', true);

		$this->set('my_page_title', __($this->my_page_title, true));
		$this->set('my_form_title', __($this->my_form_title, true));

		$msg_result = '';

		$activation_code = $this->params['url']['code'];

		$conditions = "	User.activation_code = '" . $activation_code . "' and
						User.activation_date is null ";
		$user_register_confirm = $this->User->find('all', array('conditions' => $conditions));

		if (count($user_register_confirm) == 1) {

			$admin_confirmed_tmp = '0';
			$admin_confirmed_tmp = '0';
			$userstatus_id_tmp = '0';

			$user_logging = $user_register_confirm[0];
			$usertype_selected = $user_logging['User']['usertype_id'];


			// genero messaggio conferma ok
			// e reindirizzo a pagina in base a statuts profilo
			$url_tmp = '/';
			//$msg_result = __('msg confirm registration ok', true);

//			 if ($user_logging['User']['id'] != ID_USER_SUPERADMIN && $user_logging['User']['id'] != ID_USER_ADMIN && !$user_logging['User']['profile_ctrl']) {
//				$url_tmp = '/users/my_profile/';
//				$msg_result = __('Your Profile not yet completed, please fill it', true);
//				}


			// aggiorno dati utente

			// gestione flag x abilitazione accesso in base a tipo utente che conferma

			$admin_confirmed_tmp = null;
			$userstatus_id_tmp = null;

			if ($usertype_selected == ID_USERTYPE_FRONTEND) {
				$admin_confirmed_tmp = '1';
				$userstatus_id_tmp = ID_USERSTATUS_ENABLED;
			}


			if ($admin_confirmed_tmp !== null && $userstatus_id_tmp !== null) {

				$user_logging['User']['admin_confirmed'] = $admin_confirmed_tmp;

				$user_logging['User']['userstatus_id'] = $userstatus_id_tmp;
				$user_logging['User']['activation_date'] = date("d/m/Y H:i:s", time());

				$this->User->Behaviors->detach('Trackable');

				$this->User->save($user_logging, false);


				$this->set('user_logging', $user_logging);

				// eseguo login utente confermato in background
				//			$result = $this->login_confirm($user_logging);

			} else {
				$msg_result = __('msg confirm registration error', true);
			}



		} else {
			// errore conferma registrazione messaggio errore

			// TODO: gestire errore codice gia usato
			// TODO: gestire errore codice non passato
			// TODO: getire erorre codice inesistente

			$msg_result = __('msg confirm registration error', true);
			//			$url_tmp = '/';

		}
		$this->set('msg_result', $msg_result);

//		if ($msg_result) {
//			$this->Session->setFlash($msg_result);
//		}

		//$this->redirect($url_tmp);

	}
*/


	function change_language () {

//TODO: verificare utilizzo cookie o variabili di sessione (vedi app_controller -> change_language riga 158)
        if(!empty($this->data)) {

		// lingua layout
			$locale = $this->Session->read('locale');
/*
pr('$locale pre');
pr($locale);
pr($this->localization);
pr($this->localization[$this->data['User']['language_selected']]);
*/

			if ( isset($this->data['User']['language_selected']) && isset($this->localization[$this->data['User']['language_selected']]) && $this->localization[$this->data['User']['language_selected']] ) {
				$locale = $this->data['User']['language_selected'];
//pr('cambio locale');
			}
			$this->Session->write('locale', $locale);

/*
pr('$this->data');
pr($this->data);
pr('$locale post');
pr( $this->Session->read('locale'));

pr($this->referer());

exit();
*/

	        $this->redirect($this->referer());

        }
	}

	function edit_profile() {

		$id = isset($this->user_logged['User']['id']) ? $this->user_logged['User']['id'] : 0;

		if (isset($this->data['User']['confirm_form']) && $this->data['User']['confirm_form']) {

			if ($this->data['User']['new_password']) {
				$this->data['User']['password'] = $this->Auth->password($this->data['User']['new_password']);
			} else {
				unset($this->User->validate['password']);
			}

			if (!$this->data['User']['new_password'] && !$this->data['User']['confirm_password']) {
				unset($this->User->validate['new_password']);
			}

			if (!$this->data['User']['email']) {
				unset($this->User->validate['email']);
			}


			$msg_tmp = '';

			if ($this->User->saveAll($this->data)) {

				$msg_tmp .= __('The User has been saved', true);

				$this->Session->setFlash($msg_tmp);

			} else {
				 //$errors = $this->User->invalidFields();
				 //pr($errors);
				$this->data['User']['new_password'] = '';
				$this->data['User']['confirm_password'] = '';

				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}


		} else {
			$this->data = $this->User->read(null, $id);
		}

	}


	function login() {

//$this->layout = 'admin';
if ($this->user_logged) {
	$this->redirect('/');
}

		$url_redirect = '';

		// login da cookie
		if (empty($this->data['User'])) {
			$cookie = $this->Cookie->read('Auth.User');
			if (!is_null($cookie)) {
				$this->Auth->login($cookie);
			}
		}

		// verifico se generare il cookie
		if (!empty($this->data['User']['remember_me'])) {
			$cookie = array();
			$cookie['username'] = $this->data['User']['username'];
			$cookie['password'] = $this->data['User']['password'];
			$this->Cookie->write('Auth.User', $cookie, true, '+2 weeks');
			unset($this->data['User']['remember_me']);
		}

		// verifico redirect se invio dati
		if (!empty($this->data['User'])) {
			$url_redirect = $this->referer();
$verify_user = true;
		} else {
//			$this->redirect($this->referer());
$verify_user = false;
		}

		$user = $this->Auth->user();
/*
pr($this->data['User']);
pr($user);
exit();
*/
		// x controlli menu navigazione
		$this->Session->write('user_logged', $user);

		$user_id_tmp = isset($user['User']['id']) ? $user['User']['id'] : '0';
		$user_role_tmp = isset($user['User']['userrole_id']) ? $user['User']['userrole_id'] : '0';


		if ($verify_user && $user_id_tmp) {

			// verifica status utente ed eventuale redirect: spostato in app_controller

			// TODO: verificare
			// vedi app_controller->_logUpdate
			//          $this->Session->write('my_session_id', session_id());

			// salvo data ultimo login
			$this->User->id = $user['User']['id'];
			//disabilito trackable per non registrare id utente modifica
			$this->User->Behaviors->disable('Trackable');
			//escludo salvataggio data ultima modifica
			$this->User->_schema['modified'] = null;
			// dipende da behavior date_formatter
			// $this->User->saveField('lastlogin',date('Y-m-d H:i:s'));
			$this->User->saveField('lastlogin',date('d/m/Y H:i:s'));


			// verifico redirect in base a utente loggato
			switch ($user_role_tmp) {

				case ID_USERROLE_SUPERADMIN:
//					$url_redirect = '/admin/users/index/';
					$url_redirect = $this->referer();
					break;

				case ID_USERROLE_ADMIN:
//					$url_redirect = '/admin/users/index/';
					$url_redirect = $this->referer();
					break;

				case ID_USERROLE_USER:
//					$url_redirect = '/admin/users/index/';
					$url_redirect = $this->referer();
					break;

				default:
//					$url_redirect = '/users/no_role/';
					$url_redirect = $this->referer();
			}
/*
			 pr('$user_role_tmp ' . $user_role_tmp);
			 pr('$url_redirect ' . $url_redirect);
			 exit();
*/
		}

		if ($url_redirect) {
			//$url_redirect = '/onlus/users/index/';
			$this->redirect($url_redirect);
		}
	}


	function forgot_password() {

		$this->my_page_title = __('titolo pagina richiedi password', true);
		$this->my_form_title = __('titolo form richiedi password', true);

//TODO: personalizzare su controller / action
		$title_for_layout = __('title_for_layout_richiedi_password', true);
		$this->set('title_for_layout', $title_for_layout);

		$description_for_layout = __('description_for_layout_richiedi_password', true);
		$description_for_layout = htmlspecialchars ($description_for_layout);
		$this->set('description_for_layout', $description_for_layout);

		$keywords_for_layout = __('keywords_for_layout_richiedi_password', true);
		$this->set('keywords_for_layout', $keywords_for_layout);
//TODO: personalizzare su controller / action

		$result_msg = '';

		$confirm_form = false;
		if (isset($this->data['User']['confirm_form']) && $this->data['User']['confirm_form']) {
			$confirm_form = true;
		}


		if (!empty($this->data) && $confirm_form) {

			$this->User->recursive = -1;

			$conditions =	'
								User.userstatus_id = \'' . ID_USERSTATUS_ENABLED . '\'
								and
								User.email = \'' . $this->data['User']['email'] . '\'
								and
								User.activation_date is not null
							';

			$user_logging = $this->User->find($conditions);

			if (!empty($user_logging['User']['email'])) {

				// genero nuova password
				$new_password = $this->_generatePwd();

				$mail_code_tmp = 'user_forgot_password';
				// invio mail richiesta nuova password

				$conditions = array();
				$conditions['code'] = $mail_code_tmp;
				$mail_message_selected = $this->Mailmessage->find('first', array('conditions' => $conditions));
				//pr($mail_message_selected);

				$email_tpl_tmp = $mail_code_tmp;
				$email_subject_tmp = MAILMESSAGE_SUBJECT_PREFIX;
				$email_subject_tmp .= isset($mail_message_selected['Mailmessage']['subject']) ? $mail_message_selected['Mailmessage']['subject'] : '';
				$email_body_tmp = isset($mail_message_selected['Mailmessage']['body']) ? $mail_message_selected['Mailmessage']['body'] : '';
				$email_body_tmp = sprintf($email_body_tmp, $new_password);
				$email_body_tmp .= "\n" . 'Per modificare la password accedi al tuo profilo dopo aver effettuato il login.';

				$email_tpl = $email_tpl_tmp;
				$email_subject = $email_subject_tmp;
				$email_to = $this->data['User']['email'];

				$email_reply_to = '';
				$email_from = '';

				$email_bcc = array();
				$email_attachments = array();

				$email_body = $email_body_tmp;

				$msg_confirm = '';

				$result_mail_send = array();


				$email_params = array(
										'user_data' => $this->data['User'],
										//'new_password' => $new_password,
										'email_body' => $email_body
				);
//pr($email_params);
				if (APP_MAIL_SEND) {
					$result_mail_send = $this->_sendMail($email_to, $email_bcc, $email_subject_tmp, $email_reply_to, $email_from, $email_tpl_tmp, $email_attachments, $email_params);
/*
				} else {
					$msg_confirm .= '<br />';
					$result_mail_send['send'] = true;
					$result_mail_send['smtp_errors'] = array();
*/
				}

				// vincolo registrazione utente a invio positivo email
				if ($result_mail_send['send'] == true) {

					$this->data['User']['id'] = $user_logging['User']['id'];
					$this->data['User']['password'] = $this->Auth->password($new_password);

					$this->User->save($this->data, true, array('password'));

//$errors = $this->User->invalidFields();
//pr($errors);

//exit();

					$msg_result = __('La nuova password è stata inviata', true);
					$this->set('send_form', true);

				} else {

					$msg_result = __('Errore invio mail forgot_password', true) . '<br/>' . __('Registration send mail error', true);
					pr($result['smtp_errors']);
				}

				$this->set('msg_result', $msg_result);

			}

		}

	}


	function logout(){
		// TODO: verificare
		$this->Session->delete('my_session_id');
		//		$this->Cookie->delete('User.language');
		$this->Auth->logout();
		$this->Session->destroy();
		$this->redirect('/');
		//		$this->redirect('/users/login/');

	}


	function backend_not_confirmed() {
		//TODO: implementare vista
		pr('implementare vista user -> backend_not_confirmed');
		exit();
	}


	function status_not_enabled() {
		//TODO: implementare vista
		pr('implementare vista user -> status_not_enabled');
		exit();
	}


	function menu_not_enabled() {
		//TODO: implementare vista
		//pr('implementare vista user -> menu_not_enabled');
		$this->login();
	}

	function not_authorized() {
		//TODO: implementare vista
		pr('implementare vista user -> not_authorized');
		exit();
	}


	function backend_not_authorized() {
		//TODO: implementare vista
		pr('implementare vista user -> backend_not_authorized');
		exit();
	}







	// -- //

	function admin_index($usertype = null) {

		$usertype = $this->_init_view($usertype);
//		pr('$usertype ' . $usertype);

		$conditions = array();

		// verifico pagina selezionata
		if(isset($this->params['named']['page']) && !empty($this->params['named']['page'])) {
			$this->page_selected = $this->params['named']['page'];
			$this->Session->write('Search_User_page_' . $usertype, $this->page_selected); //numero della pagina
		}

		//salvo in sessione la search corrente e la leggo in caso sia già presente.
		if($this->data) {
			$this->Session->write('Search_User_' . $usertype, $this->data);
			$this->Session->write('Search_User_page_' . $usertype, null); //se sto inserendo dei criteri azzero la pagina.
		} else {
			$this->data = $this->Session->read('Search_User_' . $usertype);
			$this->page_selected = $this->Session->read('Search_User_page_' . $usertype);//mi ricordo l'ultima pagina
		}
		//pr($this->data);

		if($this->data) {

			if(isset($this->data['User']['company']) && !empty($this->data['User']['company']))
			$conditions['User.company LIKE '] =  '%' . $this->data['User']['company'] . '%';

			if(isset($this->data['User']['admin_confirmed']) && !($this->data['User']['admin_confirmed'] == ''))
			$conditions['User.admin_confirmed'] = $this->data['User']['admin_confirmed'];

			if(isset($this->data['User']['username']) && !empty($this->data['User']['username']))
			$conditions['User.username LIKE '] =  '%' . $this->data['User']['username'] . '%';
			if(isset($this->data['User']['firstname']) && !empty($this->data['User']['firstname']))
			$conditions['User.firstname LIKE '] =  '%' . $this->data['User']['firstname'] . '%';
			if(isset($this->data['User']['lastname']) && !empty($this->data['User']['lastname']))
			$conditions['User.lastname LIKE '] =  '%' . $this->data['User']['lastname'] . '%';
			if(isset($this->data['User']['email']) && !empty($this->data['User']['email']))
			$conditions['User.email LIKE '] =  '%' . $this->data['User']['email'] . '%';
			if(isset($this->data['User']['address']) && !empty($this->data['User']['address']))
			$conditions['User.address LIKE '] =  '%' . $this->data['User']['address'] . '%';
			if(isset($this->data['User']['city']) && !empty($this->data['User']['city']))
			$conditions['User.city LIKE '] =  '%' . $this->data['User']['city'] . '%';
			if(isset($this->data['User']['zipcode']) && !empty($this->data['User']['zipcode']))
			$conditions['User.zipcode LIKE '] =  '%' . $this->data['User']['zipcode'] . '%';
			if(isset($this->data['User']['phonenumber']) && !empty($this->data['User']['phonenumber']))
			$conditions['User.phonenumber LIKE '] =  '%' . $this->data['User']['phonenumber'] . '%';
			if(isset($this->data['User']['mobilenumber']) && !empty($this->data['User']['mobilenumber']))
			$conditions['User.mobilenumber LIKE '] =  '%' . $this->data['User']['mobilenumber'] . '%';
			if(isset($this->data['User']['faxnumber']) && !empty($this->data['User']['faxnumber']))
			$conditions['User.faxnumber LIKE '] =  '%' . $this->data['User']['faxnumber'] . '%';
			if(isset($this->data['User']['note']) && !empty($this->data['User']['note']))
			$conditions['User.note LIKE '] =  '%' . $this->data['User']['note'] . '%';
			if(isset($this->data['User']['from-lastlogin']) && !empty($this->data['User']['from-lastlogin']))
			$conditions['User.lastlogin >='] = convertSearchDateForMySQL($this->data['User']['from-lastlogin']);
			if(isset($this->data['User']['to-lastlogin']) && !empty($this->data['User']['to-lastlogin']))
			$conditions['User.lastlogin <='] = convertSearchDateForMySQL($this->data['User']['to-lastlogin']);
			if(isset($this->data['User']['activationcode']) && !empty($this->data['User']['activationcode']))
			$conditions['User.activationcode LIKE '] =  '%' . $this->data['User']['activationcode'] . '%';
			if(isset($this->data['User']['from-created']) && !empty($this->data['User']['from-created']))
			$conditions['User.created >='] = convertSearchDateForMySQL($this->data['User']['from-created']);
			if(isset($this->data['User']['to-created']) && !empty($this->data['User']['to-created']))
			$conditions['User.created <='] = convertSearchDateForMySQL($this->data['User']['to-created']);
			if(isset($this->data['User']['from-modified']) && !empty($this->data['User']['from-modified']))
			$conditions['User.modified >='] = convertSearchDateForMySQL($this->data['User']['from-modified']);
			if(isset($this->data['User']['to-modified']) && !empty($this->data['User']['to-modified']))
			$conditions['User.modified <='] = convertSearchDateForMySQL($this->data['User']['to-modified']);
			if(isset($this->data['User']['userrole_id']) && !empty($this->data['User']['userrole_id']))
			$conditions['User.userrole_id'] = $this->data['User']['userrole_id'];

			if(isset($this->data['User']['userstatus_id']) && !($this->data['User']['userstatus_id'] == ''))
			$conditions['User.userstatus_id'] = $this->data['User']['userstatus_id'];
		}

		if (count($this->_verify_usertype_userrole_selected($usertype))) {
			$conditions['Userrole.id'] = $this->_verify_usertype_userrole_selected($usertype);
		}
		//pr($conditions);

		$this->User->recursive = 0;
		$this->paginate= array(
			'conditions' => $conditions,
			'page' => $this->page_selected,
            'limit' => MAX_RECORD_LIST_RECORD
		);
		$this->set('users', $this->paginate());

		// verifico tipi utente da visualizzare
		$conditions = array();
		if (count($this->_verify_usertype_userrole_selected($usertype))) {
			$conditions['Userrole.id'] = $this->_verify_usertype_userrole_selected($usertype);
		}
		$userroles = $this->User->Userrole->find('list', array('conditions' => $conditions));
		$this->set(compact('userroles'));

		// verifico stuatus utente da visualizzare
		$conditions = array();
		if (count($this->_verify_usertype_userstatus_selected($usertype))) {
			$conditions['Userstatus.id'] = $this->_verify_usertype_userstatus_selected($usertype);
		}
		$userstatuses = $this->User->Userstatus->find('list', array('conditions' => $conditions));
		$this->set(compact('userstatuses'));

		if($this->RequestHandler->isAjax()) {
			Configure::write('debug', 0);
			$this->layout = 'ajax';
			$this->render('admin_paginate');
		}

	}


	function admin_export($usertype = 'frontend') {

		$conditions = array();

		if (count($this->_verify_usertype_userrole_selected($usertype))) {
			$conditions['User.userrole_id'] = $this->_verify_usertype_userrole_selected($usertype);
		}
		//pr($conditions);

		$this->User->recursive = 0;
		$users = $this->User->find('all', array('fields' => 'User.firstname, User.lastname, User.email, User.professione, Userstatus.name', 'conditions' => $conditions));

		$row_counter = 0;
		$export_results = array();

		$export_results[$row_counter]['firstname'] = 'Nome';
		$export_results[$row_counter]['lastname'] = 'Cognome';
		$export_results[$row_counter]['email'] = 'Email';
		$export_results[$row_counter]['professione'] = 'Professione';
		$export_results[$row_counter]['status'] = 'Status';

		foreach($users as $key => $value) {
			$row_counter ++;

			$export_results[$row_counter]['firstname'] = $value['User']['firstname'];
			$export_results[$row_counter]['lastname'] = $value['User']['lastname'];
			$export_results[$row_counter]['email'] = $value['User']['email'];
			$export_results[$row_counter]['professione'] = $value['User']['professione'];
			$export_results[$row_counter]['status'] = $value['Userstatus']['name'];
		}

		$this->_export_csv($export_results, 'provera_export_utenti_registrati');

//		exit();

	}


	function admin_add() {

		$usertype = $this->Session->read('Search_usertype');
		$usertype = $this->_init_view($usertype);

		if ($usertype != 'backend') {
			$this->Session->setFlash(__('Invalid add User (only backend user)', true));
			$this->redirect('/admin/users/index/'.$usertype);
		}

		$this->User->create();
		$this->User->validate['new_password'];

		if (!empty($this->data)) {

			// TODO: verificare controlli x salvataggio password e definizione regole in model

			unset($this->User->validate['old_password']);
			unset($this->User->validate['new_password']);

			unset($this->User->validate['company_code']);
			unset($this->User->validate['company']);
			unset($this->User->validate['company_representative']);
			unset($this->User->validate['company_reference']);
			unset($this->User->validate['address']);
			unset($this->User->validate['city']);
			unset($this->User->validate['zipcode']);
			unset($this->User->validate['cf']);
			unset($this->User->validate['piva']);
			unset($this->User->validate['privacy']);

			if ($this->data['User']['new_password_add']) {
				$this->data['User']['password'] = $this->Auth->password($this->data['User']['new_password_add']);
			}

			/*
			 if (!$this->data['User']['email']) {
			 unset($this->User->validate['email']);
			 }
			 */

			$this->data['User']['admin_confirmed'] = '1';
			$this->data['User']['privacy'] = '1';

			//pr($this->data);
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect('/admin/users/index/');
			} else {

				/*
				 $errors = $this->User->invalidFields();
				 pr($errors);
				 */
				$this->data['User']['new_password_add'] = '';
				$this->data['User']['confirm_password'] = '';

				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}

		// verifico tipi utente da visualizzare
		$conditions = array();
		if (count($this->_verify_usertype_userrole_selected($usertype))) {
			$conditions['Userrole.id'] = $this->_verify_usertype_userrole_selected($usertype);
		}
		$userroles = $this->User->Userrole->find('list', array('conditions' => $conditions));
		$this->set(compact('userroles'));

		// verifico status utente da visualizzare
		$conditions = array();
		if (count($this->_verify_usertype_userstatus_selected($usertype))) {
			$conditions['Userstatus.id'] = $this->_verify_usertype_userstatus_selected($usertype);
		}
		$userstatuses = $this->User->Userstatus->find('list', array('conditions' => $conditions));
		$this->set(compact('userstatuses'));

	}


	function admin_edit($id = null) {

		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect('/admin/users/index/');
		}

		$usertype = $this->Session->read('Search_usertype');
		$usertype = $this->_init_view($usertype);

		unset($this->User->validate['old_password']);
		//unset($this->User->validate['new_password']);
		unset($this->User->validate['new_password_add']);

		unset($this->User->validate['privacy']);



		if (!empty($this->data)) {

			// TODO: verificare controlli x salvataggio password e definizione regole in model
/*
			$usertype_selected = false;
			if (isset($this->data['User']['usertype_id']) && $this->data['User']['usertype_id']) {
				$usertype_selected = $this->data['User']['usertype_id'];
			}
*/
			if ($usertype == 'backend') {
				$usertype_selected = ID_USERTYPE_BACKEND;
			}

			if ($usertype == 'frontend') {
				$usertype_selected = ID_USERTYPE_FRONTEND;
			}

/*
			if ($usertype_selected == ID_USERTYPE_BACKEND) {
				unset($this->User->validate['company_code']);
				unset($this->User->validate['company']);
				unset($this->User->validate['company_representative']);
				unset($this->User->validate['company_reference']);
				unset($this->User->validate['address']);
				unset($this->User->validate['city']);
				unset($this->User->validate['zipcode']);
				unset($this->User->validate['cf']);
				unset($this->User->validate['piva']);
			}

			if ($usertype_selected == ID_USERTYPE_PRIVATO) {
				unset($this->User->validate['userrole_id']);
				unset($this->User->validate['company_code']);
				unset($this->User->validate['company']);
				unset($this->User->validate['company_representative']);
				unset($this->User->validate['company_reference']);
				unset($this->User->validate['address']);
				unset($this->User->validate['city']);
				unset($this->User->validate['zipcode']);
				unset($this->User->validate['cf']);
				unset($this->User->validate['piva']);
			}

			if ($usertype_selected == ID_USERTYPE_AZIENDA) {
				unset($this->User->validate['userrole_id']);
				unset($this->User->validate['company_code']);
				unset($this->User->validate['firstname']);
				unset($this->User->validate['lastname']);
			}

			if ($usertype_selected == ID_USERTYPE_ONLUS) {
				unset($this->User->validate['userrole_id']);
				unset($this->User->validate['company_reference']);
				unset($this->User->validate['firstname']);
				unset($this->User->validate['lastname']);
			}
*/

			// verifico se eliminare file esistente
			if (isset($this->data['OldAttachfile'])) {
				foreach($this->data['OldAttachfile'] as $key => $value) {
					if ($value['remove'] != 0) {
						$this->User->Attachfile->delete($value['remove']);
					}
				}
				unset($this->data['OldAttachfile']);
			}

			// verifico se esistono info x salvare file
			if (isset($this->data['Attachfile'])) {
				foreach($this->data['Attachfile'] as $key => $value) {
					if ($value['file_name']['error'] == 4) {
						unset($this->data['Attachfile'][$key]);
					}
				}

				if (count($this->data['Attachfile']) == 0) {
					unset($this->data['Attachfile']);
				}
			}



			if ($this->data['User']['new_password']) {
				$this->data['User']['password'] = $this->Auth->password($this->data['User']['new_password']);
			} else {
				unset($this->User->validate['password']);
			}

			if (!$this->data['User']['new_password'] && !$this->data['User']['confirm_password']) {
				unset($this->User->validate['new_password']);
			}

			if (!$this->data['User']['email']) {
				unset($this->User->validate['email']);
			}

			if ($this->data['User']['id'] == ID_USERADMIN_DEFAULT) {
				unset($this->data['User']['userrole_description']);
				unset($this->User->validate['userrole_id']);
				unset($this->User->validate['userstatus_id']);
			}


			$msg_tmp = '';
			/*
			 */
			if ($this->User->saveAll($this->data)) {

				$msg_tmp .= __('The User has been saved', true);

				// verifico cambio status utente e invio email notifica - solo per fundraiser (privato / azienda) o onlus
				if ($usertype_selected != ID_USERTYPE_BACKEND) {
					$userstatus_id_pre = isset($this->data['User']['userstatus_id_pre']) ? $this->data['User']['userstatus_id_pre'] : '';
					$userstatus_id_post = isset($this->data['User']['userstatus_id']) ? $this->data['User']['userstatus_id'] : '';

					//$admin_confirmed_ctrl = isset($this->data['User']['admin_confirmed']) ? $this->data['User']['admin_confirmed'] : '0';


					//					if (($userstatus_id_pre != $userstatus_id_post) && $admin_confirmed_ctrl) {
					if ($userstatus_id_pre != $userstatus_id_post) {

						// cambio admin_confirmed solo se $userstatus_id_post = abilitato
						if ($userstatus_id_post == ID_USERSTATUS_ENABLED) {
							$this->data['User']['admin_confirmed'] = '1';
							$this->User->save($this->data, false, array('admin_confirmed'));
							$mail_code_tmp = 'user_change_status_enabled';
						} else {
							$mail_code_tmp = 'user_change_status_disabled';
						}

						$conditions = array();
						$conditions['code'] = $mail_code_tmp;
						$mail_message_selected = $this->Mailmessage->find('first', array('conditions' => $conditions));
						//pr($mail_message_selected);

						$email_tpl_tmp = $mail_code_tmp;
						$email_subject_tmp = MAILMESSAGE_SUBJECT_PREFIX;
						$email_subject_tmp .= isset($mail_message_selected['Mailmessage']['subject']) ? $mail_message_selected['Mailmessage']['subject'] : '';
						$email_body_tmp = isset($mail_message_selected['Mailmessage']['body']) ? $mail_message_selected['Mailmessage']['body'] : '';;

						// invio mail notifica cambio status
						// nome tpl email in elements / email
						$email_tpl = $email_tpl_tmp;
						$email_subject = $email_subject_tmp;
						$email_to = $this->data['User']['email'];

						$email_reply_to = '';
						$email_from = '';

						$email_bcc = array();
						$email_attachments = array();

						$email_body = $email_body_tmp;

						$msg_confirm = '';

						$result_mail_send = array();

						$email_params = array(
												'user_data' => $this->data['User'],
												'email_body' => $email_body
						);

						if (APP_MAIL_SEND) {
							$result_mail_send = $this->_sendMail($email_to, $email_bcc, $email_subject_tmp, $email_reply_to, $email_from, $email_tpl_tmp, $email_attachments, $email_params);
						} else {
							$result_mail_send['send'] = true;
							$result_mail_send['smtp_errors'] = array();
						}

						if ($result_mail_send['send']) {
							$msg_tmp .= '<br />' . __('mail notifica inviata', true);
						} else {
							$msg_tmp .= '<br />' . __('errore: mail notifica non inviata', true);
						}

					}

				}

				$this->Session->setFlash($msg_tmp);

				$this->redirect('/admin/users/index/'.$usertype);

			} else {
				/*
				 $errors = $this->User->invalidFields();
				 pr($errors);
				 */
				$this->data['User']['new_password'] = '';
				$this->data['User']['confirm_password'] = '';

				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}

		} else {

			$this->data = $this->User->read(null, $id);

			$this->data['User']['new_password'] = '';
			$this->data['User']['confirm_password'] = '';

			// admin vede solo utenti 'user, public user'
			$roles_enabled = array(ID_USERROLE_USER, ID_USERROLE_PUBLIC_USER);
			if ($this->user_logged_role_id != ID_USERROLE_SUPERADMIN && !in_array($this->data['User']['userrole_id'], $roles_enabled) ) {
				$this->Session->setFlash(__('Not enabled to admin the selected user', true));
				$this->redirect('/admin/users/index/');
			}

		}


		// verifico tipi utente da visualizzare
		$conditions = array();
		if (count($this->_verify_usertype_userrole_selected($usertype))) {
			$conditions['Userrole.id'] = $this->_verify_usertype_userrole_selected($usertype);
		}
		$userroles = $this->User->Userrole->find('list', array('conditions' => $conditions));
		$this->set(compact('userroles'));

		// verifico status utente da visualizzare
		$conditions = array();
		if (count($this->_verify_usertype_userstatus_selected($usertype))) {
			$conditions['Userstatus.id'] = $this->_verify_usertype_userstatus_selected($usertype);
		}
		$userstatuses = $this->User->Userstatus->find('list', array('conditions' => $conditions));
		$this->set(compact('userstatuses'));
	}


	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for User', true));
			$this->redirect('/admin/users/index/');
		}

		$usertype = $this->Session->read('Search_usertype');
		$usertype = $this->_init_view($usertype);

		// l'utente admin con id 1 non è eliminabile
		if ($id != ID_USERADMIN_DEFAULT)  {

			$user_tmp = $this->User->read(null, $id);

			// admin vede solo utenti 'user, public user'
			$roles_enabled = array(ID_USERROLE_USER, ID_USERROLE_PUBLIC_USER);
			if ($this->user_logged_role_id != ID_USERROLE_SUPERADMIN && !in_array($user_tmp['User']['userrole_id'], $roles_enabled) ) {
				$this->Session->setFlash(__('Not enabled to delete the selected user', true));
				$this->redirect('/admin/users/index/'.$usertype);
			}

			if ($this->User->delete($id)) {
				$this->Session->setFlash(__('User deleted', true));
			} else {
				$this->Session->setFlash(__('User NOT deleted (record not exist)', true));
			}

			$this->redirect('/admin/users/index/'.$usertype);

		} else {

			$this->Session->setFlash(__('Not enabled to delete the selected user', true));
			$this->redirect('/admin/users/index/'.$usertype);

		}

	}


	function admin_change_password() {
		$this->_change_password();
	}

/*
	function onlus_change_password() {
		//pr('onlus_change_password');
		//$this->autoRender = false;
		$this->layout = false;

		// verifico redirect se invio dati
		if (!empty($this->data['User'])) {
			$url_redirect = $this->referer();
		}
		//pr($url_redirect);
		//exit();
		$this->_change_password();
		//$url_redirect = '';
		if ($url_redirect) {
			$this->redirect($url_redirect);
		}
		//exit();
	}
*/

/*
	function fundraiser_change_password() {
		//pr('onlus_change_password');
		//$this->autoRender = false;
		$this->layout = false;

		// verifico redirect se invio dati
		if (!empty($this->data['User'])) {
			$url_redirect = $this->referer();
		}
		//pr($url_redirect);
		//exit();
		$this->_change_password();
		//$url_redirect = '';
		if ($url_redirect) {
			$this->redirect($url_redirect);
		}
		//exit();
	}
*/

	function _change_password() {

		unset($this->User->validate['new_password']);
		unset($this->User->validate['new_password_add']);

		unset($this->User->validate['userrole_id']);
		unset($this->User->validate['userstatus_id']);

		unset($this->User->validate['firstname']);
		unset($this->User->validate['lastname']);
		unset($this->User->validate['address']);
		unset($this->User->validate['city']);
		unset($this->User->validate['zipcode']);
		unset($this->User->validate['pv']);
		unset($this->User->validate['provincia']);
		unset($this->User->validate['nazione']);
		unset($this->User->validate['privacy']);

/*
        'username'
        'email'

        'password'
        'old_password'
        'new_password'
        'new_password_add'

        'userrole_id'
        'userstatus_id'

        'firstname'
        'lastname'
        'address'
        'city'
        'zipcode'
        'pv'
        'nazione'
		//'privacy'
*/
		$error = false;

		if(!empty($this->data)) {

			$user_logged = $this->User->findById($this->Auth->user('id'));

			$user_logged['User']['old_password'] = $this->data['User']['old_password'];
			$user_logged['User']['new_password'] = $this->data['User']['new_password'];
			$user_logged['User']['confirm_password'] = $this->data['User']['confirm_password'];


			if($user_logged['User']['old_password']) {

				if($this->Auth->password($user_logged['User']['old_password']) == $user_logged['User']['password']) {
					$user_logged['User']['password'] = $this->Auth->password($user_logged['User']['new_password']);
				} else {
					$user_logged['User']['password'] = '';
					//TODO: personalizzare messaggio di errore standard ??
					$error = __('old password non corrisponde', true);
				}

			} else {

				$user_logged['User']['password'] = '';

			}

			if ($this->User->save($user_logged, true, array('password'))) {
				$error_msg = __('nuova password salvata', true);
				$this->data = array();
			} else {
				 $errors = $this->User->invalidFields();
				 pr($errors);
				 exit();
				/*
				 */
				$error_msg = __('password non salvata', true);
				if ($error) {
					$error_msg .= ' - ' . $error;
				}
			}

			//            $this->Session->setFlash($error_msg, 'change_password');
			$this->Session->setFlash($error_msg);

		}

	}


	function _init_view($usertype = '') {

/*
		$this->User->Attachfile->Behaviors->attach(
			'MeioUpload.MeioUpload',
		array (
				'file_name' => array(
					'maxSize' => UPLOAD_MAX_FILE_SIZE_BYTE,
					'allowedMime' => array('image/jpeg', 'image/pjpeg', 'image/png'),
					'allowedExt' => array('.jpg', '.jpeg', '.png'),
					'fields' => array(
						'dir' => 'file_dir',
						'filesize' => 'file_size',
						'mimetype' => 'file_mimetype'
						),

						)
						)

						);
*/

						// verifico tipo utente
						switch ($usertype) {
							case 'frontend':
								//pr('frontend');
								break;

							default:
								$usertype = 'backend';
						}
/*
*/
						// inizializzioni relative al tipo utente amministrato
						// sovrascrivo titoli pagina / form con quelli specifici del tipo utente
						$menu_selected = $this->_getMenuByUrl($this->main_menu_items['items'], $this->_verify_url_selected() . $usertype);
//						$menu_selected = $this->_getMenuByUrl($this->main_menu_items['items'], $this->_verify_url_selected());
						$this->my_page_title = isset($menu_selected['page_title']) ? __($menu_selected['page_title'], true) : $this->my_page_title;
						$this->my_form_title = isset($menu_selected['form_title']) ? __($menu_selected['form_title'], true) : $this->my_form_title;
						$this->set('my_page_title', __($this->my_page_title, true));
						$this->set('my_form_title', __($this->my_form_title, true));
						$this->Session->write('Search_usertype', $usertype);
						$this->set('usertype', $usertype);

						$usertypes = unserialize(USERTYPES);
						$this->set('usertypes', $usertypes);
						return $usertype;
/*
*/
	}


	function _verify_usertype_userrole_selected($usertype = '') {
		$roles_selected = array();
		if ($this->user_logged_role_id == ID_USERROLE_SUPERADMIN && $usertype == 'backend') {
			$roles_selected = array(ID_USERROLE_SUPERADMIN, ID_USERROLE_ADMIN, ID_USERROLE_USER);
		}
		if ($this->user_logged_role_id != ID_USERROLE_SUPERADMIN && $usertype == 'backend') {
			$roles_selected = array(ID_USERROLE_USER);
		}
		if ($usertype == 'frontend') {
			$roles_selected = array(ID_USERROLE_PUBLIC_USER);
		}
		return $roles_selected;
	}




	function _verify_usertype_userstatus_selected($usertype = '') {
		$status_selected = array();
		if ($usertype == 'backend') {
			$status_selected = array(ID_USERSTATUS_ENABLED, ID_USERSTATUS_DISABLED);
		}
		if ($usertype == 'frontend') {
			$status_selected = array(ID_USERSTATUS_PENDING, ID_USERSTATUS_ENABLED, ID_USERSTATUS_DISABLED);
		}
		return $status_selected;
	}


	/*
	 function _generatePwd() {
		// genero nuova password x utente
		$length = PASSWORD_RANDOM_MAX_CHAR;
		$possible = PASSWORD_RANDOM_POSSIBLE;
		$pwd_tmp = '';
		while (strlen($pwd_tmp) < $length) {
		$pwd_tmp .= substr($possible, (rand() % strlen($possible)), 1);
		}
		return $pwd_tmp;
		}

		*/


	function _verifyPassword($pwd = null) {
		//TODO: verificare regole generazione pwd
		$check_pwd = false;
		if ($pwd) {
			$check_pwd = true;

			// Lunghezza min / max
			$pwd_len = strlen($pwd);
			if ($pwd_len < PASSWORD_MIN_CHAR || $pwd_len > PASSWORD_MAX_CHAR) {
				$check_pwd = false;
			}
		}
		return $check_pwd;
	}


	function _generatePwd() {
		// genero nuova password x utente
		$length = PASSWORD_RANDOM_MAX_CHAR;
		$possible = PASSWORD_RANDOM_POSSIBLE;
		$pwd_tmp = '';
		while (strlen($pwd_tmp) < $length) {
			$pwd_tmp .= substr($possible, (rand() % strlen($possible)), 1);
		}
		return $pwd_tmp;
	}
}
?>
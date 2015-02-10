<?php
class LogsController extends AppController {

	var $name = 'Logs';
    var $layout = 'admin_2-columns';

    var $page_selected = null;


	function admin_index() {

//TODO: verificare se serve
        $this->_delete_old_record();

//		$this->layout = 'admin_2-columns';
		$conditions = array();

	// verifico pagina selezionata
		if(isset($this->params['named']['page']) && !empty($this->params['named']['page'])) {
			$this->page_selected = $this->params['named']['page'];
			$this->Session->write('Search_Logs_page', $this->page_selected); //numero della pagina
		}

    //salvo in sessione la search corrente e la leggo in caso sia già presente.
		if($this->data) {
			$this->Session->write('Search_Logs', $this->data);
			$this->Session->write('Search_Logs_page', null); //se sto inserendo dei criteri azzero la pagina.
		} else {
			$this->data = $this->Session->read('Search_Logs');
            $this->page_selected = $this->Session->read('Search_Logs_page');//mi ricordo l'ultima pagina
		}
//pr('$this->page_selected ' . $this->page_selected);

		if($this->data) {
			if(isset($this->data['Log']['user_id']) && !empty($this->data['Log']['user_id']))
				$conditions['Log.user_id'] = $this->data['Log']['user_id'];
			if(isset($this->data['Log']['session_code']) && !empty($this->data['Log']['session_code']))
				$conditions['Log.session_code LIKE '] =  '%' . $this->data['Log']['session_code'] . '%';
			if(isset($this->data['Log']['ip_address']) && !empty($this->data['Log']['ip_address']))
				$conditions['Log.ip_address LIKE '] =  '%' . $this->data['Log']['ip_address'] . '%';
			if(isset($this->data['Log']['user_agent']) && !empty($this->data['Log']['user_agent']))
				$conditions['Log.user_agent LIKE '] =  '%' . $this->data['Log']['user_agent'] . '%';
			if(isset($this->data['Log']['action']) && !empty($this->data['Log']['action']))
				$conditions['Log.action LIKE '] =  '%' . $this->data['Log']['action'] . '%';
			if(isset($this->data['Log']['from-created']) && !empty($this->data['Log']['from-created']))
				$conditions['Log.created >='] = convertSearchDateForMySQL($this->data['Log']['from-created']);
			if(isset($this->data['Log']['to-created']) && !empty($this->data['Log']['to-created']))
				$conditions['Log.created <='] = convertSearchDateForMySQL($this->data['Log']['to-created']);
			if(isset($this->data['Log']['from-modified']) && !empty($this->data['Log']['from-modified']))
				$conditions['Log.modified >='] = convertSearchDateForMySQL($this->data['Log']['from-modified']);
			if(isset($this->data['Log']['to-modified']) && !empty($this->data['Log']['to-modified']))
				$conditions['Log.modified <='] = convertSearchDateForMySQL($this->data['Log']['to-modified']);
		}
		$this->Log->recursive = 0;
		$this->paginate= array(
            'conditions' => $conditions,
			'page' => $this->page_selected,
            'limit' => MAX_RECORD_LIST_RECORD
		);
		$this->set('logs', $this->paginate());

		$users = $this->Log->User->find('list', array('fields' => 'username'));
		$this->set(compact('users'));

		if($this->RequestHandler->isAjax()) {
			Configure::write('debug', 0);
			$this->layout = 'ajax';
			$this->render('admin_paginate');
		}
	}


	function admin_view($id = null) {
		$this->layout = 'admin_2-columns';
		if (!$id) {
			$this->Session->setFlash(__('Invalid Log.', true), 'default', array(), 'error');
			$this->redirect('/admin/logs/index/');
		}
		$log = $this->Log->read(null, $id);
		$this->set('log', $log);
	}


    function _delete_old_record () {
        $temptime = dateAdd('d', - LOG_DURATION_DAY, time());
        $date_ctrl = timestamp2mysql($temptime);
        $query_tmp = "delete from logs where created < '$date_ctrl'";
        $this->Log->query($query_tmp);
/*
pr('$date_now ' . timestamp2mysql(time()));
pr('$date_ctrl ' . $date_ctrl);
pr('$query_tmp ' . $query_tmp);
*/
    }

}
?>
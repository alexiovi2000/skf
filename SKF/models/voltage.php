<?php
class Voltage extends AppModel {

    var $primaryKey = 'voltage';
    
	var $name = 'Voltage';

	var $useTable = 'voltage';

    var $actsAs = array('Trackable', 'DateFormatter');
/*
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'userstatus_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
*/
}
?>
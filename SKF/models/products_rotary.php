<?php
class ProductsRotary extends AppModel {

	var $name = 'ProductsRotary';

	var $useTable = 'products_rotary';

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
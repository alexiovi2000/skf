<?php
class ProductsPillar extends AppModel {

	var $name = 'ProductsPillar';

	var $useTable = 'products_pillar';

    var $actsAs = array('Trackable', 'DateFormatter');
    

    var $belongsTo = array(
        'Voltage' => array(
            'className' => 'Voltage',
            'foreignKey' => 'voltage'
        )
    );   
    
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
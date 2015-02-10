<?php
class ProductsLinearsvil extends AppModel {

	var $name = 'ProductsLinearSvil';

	var $useTable = 'products_linearsvil';

    var $actsAs = array('Trackable', 'DateFormatter');
    
    var $belongsTo = array(
        'Voltage' => array(
            'className' => 'Voltage',
            'foreignKey' => 'voltage'
        )
    );

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	

}
?>
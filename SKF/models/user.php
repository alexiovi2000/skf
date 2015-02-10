<?php
class User extends AppModel {

	var $name = 'User';
	var $displayField = 'username';

    var $actsAs = array('Trackable', 'DateFormatter');



//	var $virtualFields = array('fundraiser_name' => 'CONCAT(User.password, User.username)');

/*
	public function __construct($id=false,$table=null,$ds=null){
		parent::__construct($id,$table,$ds);
		$this->virtualFields = array(
			'fundraiser_name' => "CONCAT(`{$this->alias}`.`company`,' ',`{$this->alias}`.`username`)"
		);
	}
*/


	var $validate = array(


//TODO
/*
verificare validazione pwd e relative regole
min 6 char, lettere numeri
*/
        'username' => array(

            'notempty' => array(
                'rule' => 'notempty',
                // 'required' => true,
                'message' => 'Campo obbligatorio',
                'last' => true
            ),

            'between' => array(
                'rule' => array('between', 5, 40),
                'message' => 'La lunghezza deve essere fra 5 e 40 caratteri',
                'last' => true
            ),

            'isUnique' => array(
                'rule' => array('isUnique'),
                'message' => 'Username già in uso da un altro utente',
                'last' => true
            ),

        ),

        'email' => array(

            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Campo obbligatorio',
                'last' => true
            ),

            'email' => array(
                'rule' => 'email',
                'required' => false,
                'message' => 'Inserisci un indirizzo email valido',
                'last' => true
            ),

            'isUnique' => array(
                'rule' => array('isUnique'),
                'message' => 'Email già in uso da un altro utente',
                'last' => true
            ),

        ),


        'password' => array(

            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Campo obbligatorio',
                'last' => true
            ),

        ),

        'old_password' => array(

            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Campo obbligatorio',
                'last' => true
            ),

        ),

        'new_password' => array(

            'passwordalphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'message' => 'Solo lettere e numeri',
                'last' => true
            ),

            'between' => array(
                'rule' => array('between', 5, 40),
                'message' => 'La lunghezza deve essere fra 5 e 40 caratteri',
                'last' => true
            ),

            'identicalFieldValues' => array(
                'rule' => array('identicalFieldValues', 'confirm_password' ),
                'message' => 'La passord non corrisponde',
                'last' => true
            )

        ),

        'new_password_add' => array(

            'old_passwordalphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'message' => 'Solo lettere e numeri',
                'last' => true
            ),

            'between' => array(
                'rule' => array('between', 5, 40),
                'message' => 'La lunghezza deve essere fra 5 e 40 caratteri',
                'last' => true
            ),

            'identicalFieldValues' => array(
                'rule' => array('identicalFieldValues', 'confirm_password' ),
                'message' => 'La passord non corrisponde',
                'last' => true
            )

        ),


        'userrole_id' => array(

            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Campo obbligatorio',
                'last' => true
            ),

        ),


        'userstatus_id' => array(

            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Campo obbligatorio',
                'last' => true
            ),

        ),



        'firstname' => array(

            'notempty' => array(
                'rule' => 'notempty',
                'message' => 'Campo obbligatorio',
                'last' => true
            ),

		),

        'lastname' => array(

            'notempty' => array(
                'rule' => 'notempty',
                'message' => 'Campo obbligatorio',
                'last' => true
            ),

		),


        'address' => array(

            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Campo obbligatorio',
                'last' => true
            ),

        ),

        'city' => array(

            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Campo obbligatorio',
                'last' => true
            ),

        ),

        'zipcode' => array(

            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Campo obbligatorio',
                'last' => true
            ),

        ),


        'provincia' => array(

            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Campo obbligatorio',
                'last' => true
            ),

        ),

        'nazione' => array(

            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Campo obbligatorio',
                'last' => true
            ),

        ),

        'privacy' => array(

            'notEmpty' => array(
                'rule' => array('inList', array('1')),
                'message' => 'Per registrarti devi accettare le regole della privacy',
                'last' => true
            ),

        ),

	);


	var $belongsTo = array(

		'Userrole' => array(
			'className' => 'Userrole',
			'foreignKey' => 'userrole_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),

		'Userstatus' => array(
			'className' => 'Userstatus',
			'foreignKey' => 'userstatus_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),

	);




	var $hasMany = array(
/*
		'Donation' => array(
			'className' => 'Donation',
			'foreignKey' => 'onlus_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => 'created desc',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
*/
/*
		'Attachfile' => array(
			'className' => 'Attachfile',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => 'created desc',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
*/

	);





    function identicalFieldValues( $field=array(), $compare_field=null ) {
        foreach( $field as $key => $value ){
            $v1 = $value;
            $v2 = $this->data[$this->name][$compare_field];
            if($v1 !== $v2) {
                return false;
            } else {
                continue;
            }
        }
        return true;
    }

}
?>
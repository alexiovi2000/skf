<?php
class PublicController extends AppController {

	var $name = 'Public';
	var $uses = array(
		'ProductsPillar',
		'ProductsLinear',
	    'ProductsLinearsvil',
		'ProductsRotary',
		'ProductsControl',
		'ProductsAccessory',
		'ProductsAssociation'
	);
	var $page_selected = null;
	
	function applications(){
	    
	}
	
	function contact(){
	    
	}

    function home_svil(){
       //TODO: personalizzare su controller / action
        $title_for_layout = __('title_for_layout_home', true);
        $this->set('title_for_layout', $title_for_layout);
        
        $description_for_layout = __('description_for_layout_home', true);
        $description_for_layout = htmlspecialchars ($description_for_layout);
        $this->set('description_for_layout', $description_for_layout);
        
        $keywords_for_layout = __('keywords_for_layout_home', true);
        $this->set('keywords_for_layout', $keywords_for_layout);
        //TODO: personalizzare su controller / action
        
        
    }
	function home() {
//TODO: personalizzare su controller / action
		$title_for_layout = __('title_for_layout_home', true);
		$this->set('title_for_layout', $title_for_layout);

		$description_for_layout = __('description_for_layout_home', true);
		$description_for_layout = htmlspecialchars ($description_for_layout);
		$this->set('description_for_layout', $description_for_layout);

		$keywords_for_layout = __('keywords_for_layout_home', true);
		$this->set('keywords_for_layout', $keywords_for_layout);
//TODO: personalizzare su controller / action

	}


	function products_compare_view () {

		$this->layout = 'ajax';
		Configure::write('debug', 1);

		$conditions = array();
		$option_id_list = array();

		$model_name = !empty($this->data['Compare']['model_name']) ? $this->data['Compare']['model_name'] : '';

		$option_id_list[] = 'option not available';

		if ($model_name) {
			unset($this->data['Compare']['model_name']);
			$option_selected = !empty($this->data['Compare']) ? $this->data['Compare'] : array();
//pr('$option_selected');
//pr($option_selected);
			foreach($option_selected as $key => $value) {
				if ($value) {
					$option_id_list[] = $value;
				}
			}
		}

		$conditions[$model_name.'.code_id'] = $option_id_list;

		$product_list = $this->$model_name->find('all', array('conditions' => $conditions));

		$this->set('product_list', $product_list);
		$this->set('model_name', $model_name);

	}


	function products_compare_select () {

		$this->layout = 'ajax';
		Configure::write('debug', 1);

		$params_tmp = $this->params['pass'];

		$compare_family = isset($params_tmp[0]) && $params_tmp[0] ? $params_tmp[0] : '';
        $compare_family = $this->_my_rawUrlDecode($compare_family);
//pr('compare_family ' . $compare_family);

		$code = isset($params_tmp[1]) && $params_tmp[1] ? $params_tmp[1] : '';
        $code = $this->_my_rawUrlDecode($code);
//pr('code ' . $code);

		$value_selected = isset($params_tmp[2]) && $params_tmp[2] ? $params_tmp[2] : '';
        $value_selected = $this->_my_rawUrlDecode($value_selected);
//pr('$value_selected ' . $value_selected);
//exit();

		$model_name = '';
		$product_list = array();
		$conditions = array();
		if ($compare_family && $code && $value_selected) {
			switch ($compare_family) {
				case CODE_PRODUCT_TYPE_PILLAR:
					$model_name = 'ProductsPillar';
					break;
				case CODE_PRODUCT_TYPE_LINEAR:
					$model_name = 'ProductsLinear';
					break;
				case CODE_PRODUCT_TYPE_CONTROL:
					$model_name = 'ProductsControl';
					break;
				 
				default:
			}

			$conditions = $this->Session->read($model_name.'.conditions');
			$conditions[$model_name.'.code'] = $code;
//pr('$conditions ');
//pr($conditions);

			$product_list = $this->$model_name->find('all', array('conditions' => $conditions));
		} else {
			pr('products_compare_select error');
			exit;
		}

		$this->set('product_list', $product_list);
		$this->set('model_name', $model_name);
		$this->set('value_selected', $value_selected);

	}


	function products_accessories () {
		$this->layout = 'ajax';
		Configure::write('debug', 1);

		$params_tmp = $this->params['pass'];

		$compare_family = isset($params_tmp[0]) && $params_tmp[0] ? $params_tmp[0] : '';
        $compare_family = $this->_my_rawUrlDecode($compare_family);
//pr('compare_family ' . $compare_family);

		$code = isset($params_tmp[1]) && $params_tmp[1] ? $params_tmp[1] : '';
        $code = $this->_my_rawUrlDecode($code);
//pr('code ' . $code);

// elenco associazioni accessori e famiglia prodotto / codice selezionato
		$association_fields = 'ProductsAssociation.product_code_to';
		$association_conditions = array();
		$association_conditions['ProductsAssociation.product_code_from'] = $code;
		$association_conditions['ProductsAssociation.product_line_from'] = $compare_family;
		$association_conditions['ProductsAssociation.product_line_to'] = 'accessories';
		$association_order = 'ProductsAssociation.product_code_to';

		$associations = $this->ProductsAssociation->find('all', array('fields' => 'DISTINCT '.$association_fields, 'conditions' => $association_conditions, 'order' => $association_order));
//pr('ProductsAssociation');
//pr($associations);

		$associations_to = array();
		foreach($associations as $key_a => $value_a) {
			$associations_to[] = $value_a['ProductsAssociation']['product_code_to'];
		}
//pr('$associations_to');
//pr($associations_to);

		$accessory_fields = 'ProductsAccessory.*';
		$accessory_conditions = array();
		$accessory_conditions['ProductsAccessory.code'] = $associations_to;
		$accessory_order = 'ProductsAccessory.code';

		$accessories_list = $this->ProductsAccessory->find('all', array('fields' => $accessory_fields, 'conditions' => $accessory_conditions, 'order' => $accessory_order));
//pr('ProductsAccessory');
//pr($accessories);

		$this->set('accessories_list', $accessories_list);

	}


	function products_pillar() {
//TODO: personalizzare su controller / action
		$title_for_layout = __('title_for_layout_products_pillar', true);
		$this->set('title_for_layout', $title_for_layout);

		$description_for_layout = __('description_for_layout_products_pillar', true);
		$description_for_layout = htmlspecialchars ($description_for_layout);
		$this->set('description_for_layout', $description_for_layout);

		$keywords_for_layout = __('keywords_for_layout_products_pillar', true);
		$this->set('keywords_for_layout', $keywords_for_layout);
//TODO: personalizzare su controller / action


$product_type_id = ID_PRODUCT_TYPE_PILLAR;
$this->set('product_type_id', $product_type_id);

$product_type_slug = SLUG_PRODUCT_TYPE_PILLAR;
$this->set('product_type_slug', $product_type_slug);

$product_type_code = CODE_PRODUCT_TYPE_PILLAR;
$this->set('product_type_code', $product_type_code);

$model_name = 'ProductsPillar';
$this->set('model_name', $model_name);


	// gestione criteri di ricerca
		$application_selected = '';
		$load_selected = '';
		$bending_selected = '';
		$speed_selected = '';
		$stroke_selected = '';
		$voltage_selected = '';
		$optional_selected = '';
		$footprint_selected = '';
		$certificato_selected = '';

		$conditions = array();
		$order = '';

		if(isset($this->data['Product']['application']) && !($this->data['Product']['application'] == '')) {
		//	$conditions[$model_name.'.application_'.$this->data['Product']['application']] = 1;
			$conditions[$model_name.'.application_'.$this->data['Product']['application'] . ' > '] = 0;
			$application_selected = $this->data['Product']['application'];

		// gestione ordinamento
			if ($order) $order .= ',';
			$order .= $model_name.'.application_'.$this->data['Product']['application'].' DESC';
		}
		$this->set('application_selected', $application_selected);

		if(isset($this->data['Product']['load']) && !($this->data['Product']['load'] == '')) {
			$conditions[$model_name.'.load >='] = $this->data['Product']['load'];
			$load_selected = $this->data['Product']['load'];
		}
		$this->set('load_selected', $load_selected);

		if(isset($this->data['Product']['bending']) && !($this->data['Product']['bending'] == '')) {
//			$conditions[$model_name.'.bending'] = $this->data['Product']['bending'];
			$conditions[$model_name.'.bending >='] = $this->data['Product']['bending'];
			$bending_selected = $this->data['Product']['bending'];
		}
		$this->set('bending_selected', $bending_selected);

		if(isset($this->data['Product']['speed']) && !($this->data['Product']['speed'] == '')) {
//TODO: verificare gestione min / max
//pr($this->data['Product']['speed']);
			$speed_ctrl = explode('|', $this->data['Product']['speed']);
			$speed_ctrl_min = isset($speed_ctrl[0]) ? $speed_ctrl[0] : null;
			$speed_ctrl_max = isset($speed_ctrl[1]) ? $speed_ctrl[1] : null;
			if ( $speed_ctrl_min != null ) {
				$conditions[$model_name.'.speed > '] = $speed_ctrl_min;
			}
			if ( $speed_ctrl_max != null ) {
				$conditions[$model_name.'.speed <= '] = $speed_ctrl_max;
			}
			$speed_selected = $this->data['Product']['speed'];
//TODO: verificare gestione min / max
/*
			$conditions[$model_name.'.speed >='] = $this->data['Product']['speed'];
			$speed_selected = $this->data['Product']['speed'];
*/
		}
		$this->set('speed_selected', $speed_selected);

		if(isset($this->data['Product']['stroke']) && !($this->data['Product']['stroke'] == '')) {
/*
//TODO: verificare gestione min / max
			$stroke_ctrl = explode('|', $this->data['Product']['stroke']);
			$stroke_ctrl_min = isset($stroke_ctrl[0]) ? $stroke_ctrl[0] : null;
			$stroke_ctrl_max = isset($stroke_ctrl[1]) ? $stroke_ctrl[1] : null;
			if ( $stroke_ctrl_min != null ) {
				$conditions[$model_name.'.stroke > '] = $stroke_ctrl_min;
			}
			if ( $stroke_ctrl_max != null ) {
				$conditions[$model_name.'.stroke <= '] = $stroke_ctrl_max;
			}
//			$conditions[$model_name.'.stroke'] = $this->data['Product']['stroke'];
//TODO: verificare gestione min / max
*/
			$conditions[$model_name.'.stroke >='] = $this->data['Product']['stroke'];
			$stroke_selected = $this->data['Product']['stroke'];
		}
		$this->set('stroke_selected', $stroke_selected);

		if(isset($this->data['Product']['voltage']) && !($this->data['Product']['voltage'] == '')) {
			$conditions[$model_name.'.voltage'] = $this->data['Product']['voltage'];
			$voltage_selected = $this->data['Product']['voltage'];
		}
		$this->set('voltage_selected', $voltage_selected);

		if(isset($this->data['Product']['optional']) && !($this->data['Product']['optional'] == '')) {
			$conditions[$model_name.'.optional_'.$this->data['Product']['optional']] = 1;
			$optional_selected = $this->data['Product']['optional'];
		}
		$this->set('optional_selected', $optional_selected);

		if(isset($this->data['Product']['footprint']) && !($this->data['Product']['footprint'] == '')) {
			$conditions[$model_name.'.footprint >='] = $this->data['Product']['footprint'];
			$footprint_selected = $this->data['Product']['footprint'];
		}
		$this->set('footprint_selected', $footprint_selected);

		if(isset($this->data['Product']['certificato']) && !($this->data['Product']['certificato'] == '')) {
			$conditions[$model_name.'.certificato'] = $this->data['Product']['certificato'];
			$certificato_selected = $this->data['Product']['certificato'];
		}
		$this->set('certificato_selected', $certificato_selected);

	// gestione ordinamento
		if ($order) $order .= ',';
		$order .= $model_name.'.code ASC';
//pr($order);
	// elenco prodotti
		$products_list_fields = $model_name.'.code, '.$model_name.'.application_auto, '.$model_name.'.application_medi, '.$model_name.'.application_buil, '.$model_name.'.application_offi, '.$model_name.'.application_heal, '.$model_name.'.image, '.$model_name.'.file_pdf, '.$model_name.'.file_drawing, '.$model_name.'.link';
		$products_list = $this->$model_name->find('all', array('fields' => 'DISTINCT '.$products_list_fields, 'conditions' => $conditions, 'order' => $order));
//pr('$products_list');
//pr($products_list);

	// aggiungo dati varianti prodotto
		foreach($products_list as $key => $value) {
			$products_list_fields = $model_name.'.*';
			$products_list_conditions = $conditions;
			$products_list_conditions[$model_name.'.code'] = $value[$model_name]['code'];
			$products_list_order = $model_name.'.code_id';
//pr('$products_list_conditions');
//pr($products_list_conditions);

			$products_list_related = $this->$model_name->find('all', array('fields' => $products_list_fields, 'conditions' => $products_list_conditions, 'order' => $products_list_order));
//pr('$products_list_related');
//pr($products_list_related);
			$products_list[$key]['related_values'] = $products_list_related;


// elenco associazioni pillar / control
			$association_fields = 'ProductsAssociation.product_code_to,ProductsAssociation.product_line_to';
			$association_conditions = array();
			$association_conditions['ProductsAssociation.product_code_from'] = $value[$model_name]['code'];
			$association_conditions['ProductsAssociation.product_line_from'] = 'pillar';
			$association_conditions['ProductsAssociation.product_line_to'] = 'control';
			$association_order = 'ProductsAssociation.product_code_to';

			$associations = $this->ProductsAssociation->find('all', array('fields' => 'DISTINCT '.$association_fields, 'conditions' => $association_conditions, 'order' => $association_order));
//pr('ProductsAssociation');
//pr($associations);

			$products_list[$key]['related_products'] = $associations;


// elenco associazioni accessori e famiglia prodotto / codice selezionato
			$association_fields = 'ProductsAssociation.product_code_to';
			$association_conditions = array();
			$association_conditions['ProductsAssociation.product_code_from'] = $value[$model_name]['code'];
			$association_conditions['ProductsAssociation.product_line_from'] = 'pillar';
			$association_conditions['ProductsAssociation.product_line_to'] = 'accessories';
			$association_order = 'ProductsAssociation.product_code_to';

			$associations = $this->ProductsAssociation->find('all', array('fields' => 'DISTINCT '.$association_fields, 'conditions' => $association_conditions, 'order' => $association_order));
//pr('ProductsAssociation');
//pr($associations);

			$products_list[$key]['related_accessories'] = $associations;
		}

/*
pr('$products_list + related_values');
pr($products_list);
exit();
*/

		$this->set('products_list', $products_list);

	// dati x filtri di ricerca
		$this->_init_search_criteria_pillar($conditions, $order, $model_name);

		if ($this->RequestHandler->isAjax()) {
			Configure::write('debug', 1);
			$this->layout = 'ajax';
			$this->Session->write($model_name.'.conditions', $conditions);
			$this->render('products_pillar_list');
		} else {
			$this->Session->delete($model_name.'.conditions');
		}

	}

    function products_linearsvil(){

        //TODO: personalizzare su controller / action
        $title_for_layout = __('title_for_layout_products_linear', true);
        $this->set('title_for_layout', $title_for_layout);
        
        $description_for_layout = __('description_for_layout_products_linear', true);
        $description_for_layout = htmlspecialchars ($description_for_layout);
        $this->set('description_for_layout', $description_for_layout);
        
        $keywords_for_layout = __('keywords_for_layout_products_linear', true);
        $this->set('keywords_for_layout', $keywords_for_layout);
        //TODO: personalizzare su controller / action
        
        
        $product_type_id = ID_PRODUCT_TYPE_LINEAR;
        $this->set('product_type_id', $product_type_id);
        
        $product_type_slug = SLUG_PRODUCT_TYPE_LINEAR;
        $this->set('product_type_slug', $product_type_slug);
        
        $product_type_code = CODE_PRODUCT_TYPE_LINEAR;
        $this->set('product_type_code', $product_type_code);
        
        $model_name = 'ProductsLinearsvil';
        $this->set('model_name', $model_name);
        
        
        // gestione criteri di ricerca
        $application_selected = '';
        $load_selected = '';
        $speed_selected = '';
        $stroke_selected = '';
        $duty_selected = '';
        $voltage_selected = '';
        $optional_selected = '';
        $certificato_selected = '';
        $self_locking_selected = '';   
        
        $conditions = array();
        $order = '';
        
        if(isset($this->data['Product']['application']) && !($this->data['Product']['application'] == '')) {
            //	$conditions[$model_name.'.application_'.$this->data['Product']['application']] = 1;
            $conditions[$model_name.'.application_'.$this->data['Product']['application'] . ' > '] = 0;
            $application_selected = $this->data['Product']['application'];
        
            // gestione ordinamento
            if ($order) $order .= ',';
            $order .= $model_name.'.application_'.$this->data['Product']['application'].' DESC';
        }
        $this->set('application_selected', $application_selected);
        
        if(isset($this->data['Product']['load']) && !($this->data['Product']['load'] == '')) {
            $conditions[$model_name.'.load >='] = $this->data['Product']['load'];
            $load_selected = $this->data['Product']['load'];
        }
        $this->set('load_selected', $load_selected);
        
        if(isset($this->data['Product']['speed']) && !($this->data['Product']['speed'] == '')) {
            //TODO: verificare gestione min / max
            //pr($this->data['Product']['speed']);
            $speed_ctrl = explode('|', $this->data['Product']['speed']);
            $speed_ctrl_min = isset($speed_ctrl[0]) ? $speed_ctrl[0] : null;
            $speed_ctrl_max = isset($speed_ctrl[1]) ? $speed_ctrl[1] : null;
            if ( $speed_ctrl_min != null ) {
                $conditions[$model_name.'.speed > '] = $speed_ctrl_min;
            }
            if ( $speed_ctrl_max != null ) {
                $conditions[$model_name.'.speed <= '] = $speed_ctrl_max;
            }
            $speed_selected = $this->data['Product']['speed'];
            //TODO: verificare gestione min / max
            /*
            $conditions[$model_name.'.speed >='] = $this->data['Product']['speed'];
            $speed_selected = $this->data['Product']['speed'];
            */
        }
        $this->set('speed_selected', $speed_selected);
        
        if(isset($this->data['Product']['stroke']) && !($this->data['Product']['stroke'] == '')) {
            /*
             //TODO: verificare gestione min / max
            $stroke_ctrl = explode('|', $this->data['Product']['stroke']);
            $stroke_ctrl_min = isset($stroke_ctrl[0]) ? $stroke_ctrl[0] : null;
            $stroke_ctrl_max = isset($stroke_ctrl[1]) ? $stroke_ctrl[1] : null;
            if ( $stroke_ctrl_min != null ) {
            $conditions[$model_name.'.stroke > '] = $stroke_ctrl_min;
            }
            if ( $stroke_ctrl_max != null ) {
            $conditions[$model_name.'.stroke <= '] = $stroke_ctrl_max;
            }
            //			$conditions[$model_name.'.stroke'] = $this->data['Product']['stroke'];
            //TODO: verificare gestione min / max
            */
            $conditions[$model_name.'.stroke >='] = $this->data['Product']['stroke'];
            $stroke_selected = $this->data['Product']['stroke'];
        }
        $this->set('stroke_selected', $stroke_selected);
        
        if(isset($this->data['Product']['duty']) && !($this->data['Product']['duty'] == '')) {
            //TODO: verificare gestione min / max
            $duty_ctrl = explode('|', $this->data['Product']['duty']);
            $duty_ctrl_min = isset($duty_ctrl[0]) ? $duty_ctrl[0] : null;
            $duty_ctrl_max = isset($duty_ctrl[1]) ? $duty_ctrl[1] : null;
            if ( $duty_ctrl_min != null ) {
                $conditions[$model_name.'.duty > '] = $duty_ctrl_min;
            }
            if ( $duty_ctrl_max != null ) {
                $conditions[$model_name.'.duty <= '] = $duty_ctrl_max;
            }
            //			$conditions[$model_name.'.duty'] = $this->data['Product']['duty'];
            //TODO: verificare gestione min / max
            $duty_selected = $this->data['Product']['duty'];
        }
        $this->set('duty_selected', $duty_selected);
        
        if(isset($this->data['Product']['voltage']) && !($this->data['Product']['voltage'] == '')) {
            $conditions[$model_name.'.voltage'] = $this->data['Product']['voltage'];
            $voltage_selected = $this->data['Product']['voltage'];
        }
        $this->set('voltage_selected', $voltage_selected);
        
        if(isset($this->data['Product']['optional']) && !($this->data['Product']['optional'] == '')) {
        
            //pr($this->data['Product']['optional']);
            if (is_array($this->data['Product']['optional']) && count($this->data['Product']['optional'])) {
                //				$conditions['OR'] = array();
                $conditions['AND'] = array();
                foreach($this->data['Product']['optional'] as $key => $value) {
                    //				    $conditions['OR'][$model_name.'.optional_'.$value] = 1;
                    $conditions['AND'][$model_name.'.optional_'.$value] = 1;
                }
            } else {
                $conditions[$model_name.'.optional_'.$this->data['Product']['optional']] = 1;
            }
            //			$conditions[$model_name.'.optional_'.$this->data['Product']['optional']] = 1;
        
            $optional_selected = $this->data['Product']['optional'];
        }
        $this->set('optional_selected', $optional_selected);
        
        if(isset($this->data['Product']['certificato']) && !($this->data['Product']['certificato'] == '')) {
            $conditions[$model_name.'.certificato'] = $this->data['Product']['certificato'];
            $certificato_selected = $this->data['Product']['certificato'];
        }
        $this->set('certificato_selected', $certificato_selected);
        
        
        if(isset($this->data['Product']['self_locking']) && !($this->data['Product']['self_locking'] == '')) {
            $conditions[$model_name.'.self_locking'] = $this->data['Product']['self_locking'];
            $self_locking_selected = $this->data['Product']['self_locking'];
        }
        $this->set('self_locking_selected', $self_locking_selected);
        //pr($conditions);
        
        // gestione ordinamento
        if ($order) $order .= ',';
        $order .= $model_name.'.code ASC';
        //pr($order);
        $conditions[$model_name.'.code NOT LIKE'] = '%CASM%';
        // elenco prodotti
        $products_list_fields = $model_name.'.code, '.$model_name.'.application_auto, '.$model_name.'.application_medi, '.$model_name.'.application_fobe, '.$model_name.'.application_pupa, '.$model_name.'.application_oilg, '.$model_name.'.application_buil, '.$model_name.'.application_offh, '.$model_name.'.application_sola, '.$model_name.'.application_heal, '.$model_name.'.application_stee, '.$model_name.'.application_offi, '.$model_name.'.image, '.$model_name.'.file_pdf, '.$model_name.'.file_drawing, '.$model_name.'.link, '.$model_name.'.verify_performance, '.$model_name.'.self_locking';
        $products_list = $this->$model_name->find('all', array('fields' => 'DISTINCT '.$products_list_fields, 'conditions' => $conditions, 'order' => $order));
        
        /**
         * Gestione CASM
         * 
         */
        $conditions_casm = array("code like "=>'%CASM%');
        $casm_product = $this->$model_name->find('all', array('fields' => "DISTINCT code_description AS code,image,file_pdf,file_drawing,link,verify_performance,self_locking", 'conditions' => $conditions_casm , 'order' => $order));
        $products_list =  array_merge($casm_product,$products_list);
        // aggiungo dati varianti prodotto
        foreach($products_list as $key => $value) {
            $products_list_fields = $model_name.'.*';
          
            if (strstr($value[$model_name]['code'],'CASM')){
                $products_list_conditions = array();
                $products_list_conditions[$model_name.'.code_description'] = $value[$model_name]['code'];
            }else{
                $products_list_conditions = $conditions;
                $products_list_conditions[$model_name.'.code'] = $value[$model_name]['code'];
            }
            $products_list_order = $model_name.'.code_id';
            //pr('$products_list_conditions');
            //pr($products_list_conditions);
            $products_list_related = $this->$model_name->find('all', array('fields' => $products_list_fields, 'conditions' => $products_list_conditions, 'order' => $products_list_order));
            //pr('$products_list_related');
            //pr($products_list_related);
            $products_list[$key]['related_values'] = $products_list_related;
        
        
            // elenco associazioni linear / control
            $association_fields = 'ProductsAssociation.product_code_to,ProductsAssociation.product_line_to';
            $association_conditions = array();
            $association_conditions['ProductsAssociation.product_code_from'] = $value[$model_name]['code'];
            $association_conditions['ProductsAssociation.product_line_from'] = 'linear';
            $association_conditions['ProductsAssociation.product_line_to'] = 'control';
            $association_order = 'ProductsAssociation.product_code_to';
        
            $associations = $this->ProductsAssociation->find('all', array('fields' => 'DISTINCT '.$association_fields, 'conditions' => $association_conditions, 'order' => $association_order));
            //pr('ProductsAssociation');
            //pr($associations);
        
            $products_list[$key]['related_products'] = $associations;
        
        
            // elenco associazioni accessori e famiglia prodotto / codice selezionato
            $association_fields = 'ProductsAssociation.product_code_to';
            $association_conditions = array();
            $association_conditions['ProductsAssociation.product_code_from'] = $value[$model_name]['code'];
            $association_conditions['ProductsAssociation.product_line_from'] = 'linear';
            $association_conditions['ProductsAssociation.product_line_to'] = 'accessories';
            $association_order = 'ProductsAssociation.product_code_to';
        
            $associations = $this->ProductsAssociation->find('all', array('fields' => 'DISTINCT '.$association_fields, 'conditions' => $association_conditions, 'order' => $association_order));
            //pr('ProductsAssociation');
            //pr($associations);
        
            $products_list[$key]['related_accessories'] = $associations;
        
        }
        /*
         pr('$products_list + related_values');
        pr($products_list);
        exit();
        */
        $this->set('products_list', $products_list);
        
        // dati x filtri di ricerca
        $this->_init_search_criteria_linear($conditions, $order, $model_name);
        
        if ($this->RequestHandler->isAjax()) {
            Configure::write('debug', 1);
            $this->layout = 'ajax';
            $this->Session->write($model_name.'.conditions', $conditions);
            $this->render('products_linear_list');
        } else {
            $this->Session->delete($model_name.'.conditions');
        }
        
        
    }
	function products_linear() {
//TODO: personalizzare su controller / action
		$title_for_layout = __('title_for_layout_products_linear', true);
		$this->set('title_for_layout', $title_for_layout);

		$description_for_layout = __('description_for_layout_products_linear', true);
		$description_for_layout = htmlspecialchars ($description_for_layout);
		$this->set('description_for_layout', $description_for_layout);

		$keywords_for_layout = __('keywords_for_layout_products_linear', true);
		$this->set('keywords_for_layout', $keywords_for_layout);
//TODO: personalizzare su controller / action


$product_type_id = ID_PRODUCT_TYPE_LINEAR;
$this->set('product_type_id', $product_type_id);

$product_type_slug = SLUG_PRODUCT_TYPE_LINEAR;
$this->set('product_type_slug', $product_type_slug);

$product_type_code = CODE_PRODUCT_TYPE_LINEAR;
$this->set('product_type_code', $product_type_code);

$model_name = 'ProductsLinear';
$this->set('model_name', $model_name);


	// gestione criteri di ricerca
		$application_selected = '';
		$load_selected = '';
		$speed_selected = '';
		$stroke_selected = '';
		$duty_selected = '';
		$voltage_selected = '';
		$optional_selected = '';
		$certificato_selected = '';
		$self_locking_selected = '';

		$conditions = array();
		$order = '';

		if(isset($this->data['Product']['application']) && !($this->data['Product']['application'] == '')) {
		//	$conditions[$model_name.'.application_'.$this->data['Product']['application']] = 1;
			$conditions[$model_name.'.application_'.$this->data['Product']['application'] . ' > '] = 0;
			$application_selected = $this->data['Product']['application'];

		// gestione ordinamento
			if ($order) $order .= ',';
			$order .= $model_name.'.application_'.$this->data['Product']['application'].' DESC';
		}
		$this->set('application_selected', $application_selected);

		if(isset($this->data['Product']['load']) && !($this->data['Product']['load'] == '')) {
			$conditions[$model_name.'.load >='] = $this->data['Product']['load'];
			$load_selected = $this->data['Product']['load'];
		}
		$this->set('load_selected', $load_selected);

		if(isset($this->data['Product']['speed']) && !($this->data['Product']['speed'] == '')) {
//TODO: verificare gestione min / max
//pr($this->data['Product']['speed']);
			$speed_ctrl = explode('|', $this->data['Product']['speed']);
			$speed_ctrl_min = isset($speed_ctrl[0]) ? $speed_ctrl[0] : null;
			$speed_ctrl_max = isset($speed_ctrl[1]) ? $speed_ctrl[1] : null;
			if ( $speed_ctrl_min != null ) {
				$conditions[$model_name.'.speed > '] = $speed_ctrl_min;
			}
			if ( $speed_ctrl_max != null ) {
				$conditions[$model_name.'.speed <= '] = $speed_ctrl_max;
			}
			$speed_selected = $this->data['Product']['speed'];
//TODO: verificare gestione min / max
/*
			$conditions[$model_name.'.speed >='] = $this->data['Product']['speed'];
			$speed_selected = $this->data['Product']['speed'];
*/
		}
		$this->set('speed_selected', $speed_selected);

		if(isset($this->data['Product']['stroke']) && !($this->data['Product']['stroke'] == '')) {
/*
//TODO: verificare gestione min / max
			$stroke_ctrl = explode('|', $this->data['Product']['stroke']);
			$stroke_ctrl_min = isset($stroke_ctrl[0]) ? $stroke_ctrl[0] : null;
			$stroke_ctrl_max = isset($stroke_ctrl[1]) ? $stroke_ctrl[1] : null;
			if ( $stroke_ctrl_min != null ) {
				$conditions[$model_name.'.stroke > '] = $stroke_ctrl_min;
			}
			if ( $stroke_ctrl_max != null ) {
				$conditions[$model_name.'.stroke <= '] = $stroke_ctrl_max;
			}
//			$conditions[$model_name.'.stroke'] = $this->data['Product']['stroke'];
//TODO: verificare gestione min / max
*/
			$conditions[$model_name.'.stroke >='] = $this->data['Product']['stroke'];
			$stroke_selected = $this->data['Product']['stroke'];
		}
		$this->set('stroke_selected', $stroke_selected);

		if(isset($this->data['Product']['duty']) && !($this->data['Product']['duty'] == '')) {
//TODO: verificare gestione min / max
			$duty_ctrl = explode('|', $this->data['Product']['duty']);
			$duty_ctrl_min = isset($duty_ctrl[0]) ? $duty_ctrl[0] : null;
			$duty_ctrl_max = isset($duty_ctrl[1]) ? $duty_ctrl[1] : null;
			if ( $duty_ctrl_min != null ) {
				$conditions[$model_name.'.duty > '] = $duty_ctrl_min;
			}
			if ( $duty_ctrl_max != null ) {
				$conditions[$model_name.'.duty <= '] = $duty_ctrl_max;
			}
//			$conditions[$model_name.'.duty'] = $this->data['Product']['duty'];
//TODO: verificare gestione min / max
			$duty_selected = $this->data['Product']['duty'];
		}
		$this->set('duty_selected', $duty_selected);

		if(isset($this->data['Product']['voltage']) && !($this->data['Product']['voltage'] == '')) {
			$conditions[$model_name.'.voltage'] = $this->data['Product']['voltage'];
			$voltage_selected = $this->data['Product']['voltage'];
		}
		$this->set('voltage_selected', $voltage_selected);

		if(isset($this->data['Product']['optional']) && !($this->data['Product']['optional'] == '')) {

//pr($this->data['Product']['optional']);
			if (is_array($this->data['Product']['optional']) && count($this->data['Product']['optional'])) {
//				$conditions['OR'] = array();
				$conditions['AND'] = array();
				foreach($this->data['Product']['optional'] as $key => $value) {
//				    $conditions['OR'][$model_name.'.optional_'.$value] = 1;
					$conditions['AND'][$model_name.'.optional_'.$value] = 1;
				}
			} else {
				$conditions[$model_name.'.optional_'.$this->data['Product']['optional']] = 1;
			}
//			$conditions[$model_name.'.optional_'.$this->data['Product']['optional']] = 1;

			$optional_selected = $this->data['Product']['optional'];
		}
		$this->set('optional_selected', $optional_selected);

		if(isset($this->data['Product']['certificato']) && !($this->data['Product']['certificato'] == '')) {
			$conditions[$model_name.'.certificato'] = $this->data['Product']['certificato'];
			$certificato_selected = $this->data['Product']['certificato'];
		}
		$this->set('certificato_selected', $certificato_selected);


		if(isset($this->data['Product']['self_locking']) && !($this->data['Product']['self_locking'] == '')) {
			$conditions[$model_name.'.self_locking'] = $this->data['Product']['self_locking'];
			$self_locking_selected = $this->data['Product']['self_locking'];
		}
		$this->set('self_locking_selected', $self_locking_selected);
//pr($conditions);

	// gestione ordinamento
		if ($order) $order .= ',';
		$order .= $model_name.'.code ASC';
//pr($order);

	// elenco prodotti
		$products_list_fields = $model_name.'.code, '.$model_name.'.application_auto, '.$model_name.'.application_medi, '.$model_name.'.application_fobe, '.$model_name.'.application_pupa, '.$model_name.'.application_oilg, '.$model_name.'.application_buil, '.$model_name.'.application_offh, '.$model_name.'.application_sola, '.$model_name.'.application_heal, '.$model_name.'.application_stee, '.$model_name.'.application_offi, '.$model_name.'.image, '.$model_name.'.file_pdf, '.$model_name.'.file_drawing, '.$model_name.'.link, '.$model_name.'.verify_performance, '.$model_name.'.self_locking';
		$products_list = $this->$model_name->find('all', array('fields' => 'DISTINCT '.$products_list_fields, 'conditions' => $conditions, 'order' => $order));
//pr('$products_list');
//pr($products_list);

	// aggiungo dati varianti prodotto
		foreach($products_list as $key => $value) {
			$products_list_fields = $model_name.'.*';
			$products_list_conditions = $conditions;
			$products_list_conditions[$model_name.'.code'] = $value[$model_name]['code'];
			$products_list_order = $model_name.'.code_id';
//pr('$products_list_conditions');
//pr($products_list_conditions);

			$products_list_related = $this->$model_name->find('all', array('fields' => $products_list_fields, 'conditions' => $products_list_conditions, 'order' => $products_list_order));
//pr('$products_list_related');
//pr($products_list_related);
			$products_list[$key]['related_values'] = $products_list_related;


// elenco associazioni linear / control
			$association_fields = 'ProductsAssociation.product_code_to,ProductsAssociation.product_line_to';
			$association_conditions = array();
			$association_conditions['ProductsAssociation.product_code_from'] = $value[$model_name]['code'];
			$association_conditions['ProductsAssociation.product_line_from'] = 'linear';
			$association_conditions['ProductsAssociation.product_line_to'] = 'control';
			$association_order = 'ProductsAssociation.product_code_to';

			$associations = $this->ProductsAssociation->find('all', array('fields' => 'DISTINCT '.$association_fields, 'conditions' => $association_conditions, 'order' => $association_order));
//pr('ProductsAssociation');
//pr($associations);

			$products_list[$key]['related_products'] = $associations;


// elenco associazioni accessori e famiglia prodotto / codice selezionato
			$association_fields = 'ProductsAssociation.product_code_to';
			$association_conditions = array();
			$association_conditions['ProductsAssociation.product_code_from'] = $value[$model_name]['code'];
			$association_conditions['ProductsAssociation.product_line_from'] = 'linear';
			$association_conditions['ProductsAssociation.product_line_to'] = 'accessories';
			$association_order = 'ProductsAssociation.product_code_to';

			$associations = $this->ProductsAssociation->find('all', array('fields' => 'DISTINCT '.$association_fields, 'conditions' => $association_conditions, 'order' => $association_order));
//pr('ProductsAssociation');
//pr($associations);

			$products_list[$key]['related_accessories'] = $associations;

		}
/*
pr('$products_list + related_values');
pr($products_list);
exit();
*/

		$this->set('products_list', $products_list);

	// dati x filtri di ricerca
		$this->_init_search_criteria_linear($conditions, $order, $model_name);

		if ($this->RequestHandler->isAjax()) {
			Configure::write('debug', 1);
			$this->layout = 'ajax';
			$this->Session->write($model_name.'.conditions', $conditions);
			$this->render('products_linear_list');
		} else {
			$this->Session->delete($model_name.'.conditions');
		}

	}


	function products_rotary() {

//TODO: personalizzare su controller / action
		$title_for_layout = __('title_for_layout_products_rotary', true);
		$this->set('title_for_layout', $title_for_layout);

		$description_for_layout = __('description_for_layout_products_rotary', true);
		$description_for_layout = htmlspecialchars ($description_for_layout);
		$this->set('description_for_layout', $description_for_layout);

		$keywords_for_layout = __('keywords_for_layout_products_rotary', true);
		$this->set('keywords_for_layout', $keywords_for_layout);
//TODO: personalizzare su controller / action


$product_type_id = ID_PRODUCT_TYPE_ROTARY;
$this->set('product_type_id', $product_type_id);

$product_type_slug = SLUG_PRODUCT_TYPE_ROTARY;
$this->set('product_type_slug', $product_type_slug);

$product_type_code = CODE_PRODUCT_TYPE_ROTARY;
$this->set('product_type_code', $product_type_code);

$model_name = 'ProductsRotary';
$this->set('model_name', $model_name);


	// gestione criteri di ricerca
		$application_selected = '';
		$load_selected = '';
		$speed_selected = '';
		$voltage_selected = '';
		$optional_selected = '';
		$conditions = array();
		$order = '';

		if(isset($this->data['Product']['application']) && !($this->data['Product']['application'] == '')) {
		//	$conditions[$model_name.'.application_'.$this->data['Product']['application']] = 1;
			$conditions[$model_name.'.application_'.$this->data['Product']['application'] . ' > '] = 0;
			$application_selected = $this->data['Product']['application'];

		// gestione ordinamento
			if ($order) $order .= ',';
			$order .= $model_name.'.application_'.$this->data['Product']['application'].' DESC';
		}
		$this->set('application_selected', $application_selected);

		if(isset($this->data['Product']['load']) && !($this->data['Product']['load'] == '')) {
//			$conditions[$model_name.'.load'] = $this->data['Product']['load'];
			$conditions[$model_name.'.load >='] = $this->data['Product']['load'];
			$load_selected = $this->data['Product']['load'];
		}
		$this->set('load_selected', $load_selected);

		if(isset($this->data['Product']['speed']) && !($this->data['Product']['speed'] == '')) {
//TODO: verificare gestione min / max
			$speed_ctrl = explode('|', $this->data['Product']['speed']);
			$speed_ctrl_min = isset($speed_ctrl[0]) ? $speed_ctrl[0] : null;
			$speed_ctrl_max = isset($speed_ctrl[1]) ? $speed_ctrl[1] : null;
			if ( $speed_ctrl_min != null ) {
				$conditions[$model_name.'.speed > '] = $speed_ctrl_min;
			}
			if ( $speed_ctrl_max != null ) {
				$conditions[$model_name.'.speed <= '] = $speed_ctrl_max;
			}
			$speed_selected = $this->data['Product']['speed'];
//TODO: verificare gestione min / max
/*
			$conditions[$model_name.'.speed >='] = $this->data['Product']['speed'];
			$speed_selected = $this->data['Product']['speed'];
*/
		}
		$this->set('speed_selected', $speed_selected);

		if(isset($this->data['Product']['voltage']) && !($this->data['Product']['voltage'] == '')) {
			$conditions[$model_name.'.voltage'] = $this->data['Product']['voltage'];
			$voltage_selected = $this->data['Product']['voltage'];
		}
		$this->set('voltage_selected', $voltage_selected);

		if(isset($this->data['Product']['optional']) && !($this->data['Product']['optional'] == '')) {
			$conditions[$model_name.'.optional_'.$this->data['Product']['optional']] = 1;
			$optional_selected = $this->data['Product']['optional'];
		}
		$this->set('optional_selected', $optional_selected);
//pr($conditions);

	// gestione ordinamento
		if ($order) $order .= ',';
		$order .= $model_name.'.code ASC';
//pr($order);

	// elenco prodotti
		$products_list_fields = $model_name.'.code, '.$model_name.'.application_auto, '.$model_name.'.application_oilg, '.$model_name.'.application_cars, '.$model_name.'.application_sola, '.$model_name.'.application_heal, '.$model_name.'.image, '.$model_name.'.file_pdf, '.$model_name.'.file_drawing, '.$model_name.'.link';
		$products_list = $this->$model_name->find('all', array('fields' => 'DISTINCT '.$products_list_fields, 'conditions' => $conditions, 'order' => $order));
//pr('$products_list');
//pr($products_list);

//TODO: verificare se serve
/*
	// aggiungo dati varianti prodotto
		foreach($products_list as $key => $value) {

			$products_list_fields = $model_name.'.*';
//			$products_list_conditions = array();
			$products_list_conditions = $conditions;
			$products_list_conditions[$model_name.'.code'] = $value[$model_name]['code'];
			$products_list_order = $model_name.'.code_id';
//pr('$products_list_conditions');
//pr($products_list_conditions);

			$products_list_related = $this->$model_name->find('all', array('fields' => $products_list_fields, 'conditions' => $products_list_conditions, 'order' => $products_list_order));
//pr('$products_list_related');
//pr($products_list_related);
			$products_list[$key]['related_values'] = $products_list_related;

//pr($products_list + related_values);
//pr($products_list);
//exit();

		}
*/
//TODO: verificare se serve

		$this->set('products_list', $products_list);

	// dati x filtri di ricerca
		$this->_init_search_criteria_rotary($conditions, $order, $model_name);

		if ($this->RequestHandler->isAjax()) {
			Configure::write('debug', 1);
			$this->layout = 'ajax';
			$this->Session->write($model_name.'.conditions', $conditions);
			$this->render('products_rotary_list');
		} else {
			$this->Session->delete($model_name.'.conditions');
		}

	}


	function products_control() {

//TODO: personalizzare su controller / action
		$title_for_layout = __('title_for_layout_products_control', true);
		$this->set('title_for_layout', $title_for_layout);

		$description_for_layout = __('description_for_layout_products_control', true);
		$description_for_layout = htmlspecialchars ($description_for_layout);
		$this->set('description_for_layout', $description_for_layout);

		$keywords_for_layout = __('keywords_for_layout_products_control', true);
		$this->set('keywords_for_layout', $keywords_for_layout);
//TODO: personalizzare su controller / action


$product_type_id = ID_PRODUCT_TYPE_CONTROL;
$this->set('product_type_id', $product_type_id);

$product_type_slug = SLUG_PRODUCT_TYPE_CONTROL;
$this->set('product_type_slug', $product_type_slug);

$product_type_code = CODE_PRODUCT_TYPE_CONTROL;
$this->set('product_type_code', $product_type_code);

$model_name = 'ProductsControl';
$this->set('model_name', $model_name);


	// gestione criteri di ricerca
		$application_selected = '';
		$motor_selected = '';
		$output_selected = '';
		$input_selected = '';
		$functionality_selected = '';

$pillar_selected = '';
$linear_selected = '';

		$conditions = array();
		$order = '';

		if(isset($this->data['Product']['application']) && !($this->data['Product']['application'] == '')) {
		//	$conditions[$model_name.'.application_'.$this->data['Product']['application']] = 1;
			$conditions[$model_name.'.application_'.$this->data['Product']['application'] . ' > '] = 0;
			$application_selected = $this->data['Product']['application'];

		// gestione ordinamento
			if ($order) $order .= ',';
			$order .= $model_name.'.application_'.$this->data['Product']['application'].' DESC';
		}
		$this->set('application_selected', $application_selected);

		if(isset($this->data['Product']['motor']) && !($this->data['Product']['motor'] == '')) {
	//		$conditions[$model_name.'.motor'] = $this->data['Product']['motor'];
			$conditions[$model_name.'.motor >= '] = $this->data['Product']['motor'];
			$motor_selected = $this->data['Product']['motor'];
		}
		$this->set('motor_selected', $motor_selected);

		if(isset($this->data['Product']['output']) && !($this->data['Product']['output'] == '')) {
		//  $conditions[$model_name.'.output'] = $this->data['Product']['output'];
			$conditions[$model_name.'.output >='] = $this->data['Product']['output'];
			$output_selected = $this->data['Product']['output'];
		}
		$this->set('output_selected', $output_selected);

		if(isset($this->data['Product']['input']) && !($this->data['Product']['input'] == '')) {
			$conditions[$model_name.'.input'] = $this->data['Product']['input'];
			$input_selected = $this->data['Product']['input'];
		}
		$this->set('input_selected', $input_selected);

		if(isset($this->data['Product']['functionality']) && !($this->data['Product']['functionality'] == '')) {
			$conditions[$model_name.'.functionality_'.$this->data['Product']['functionality']] = 1;
			$functionality_selected = $this->data['Product']['functionality'];
		}
		$this->set('functionality_selected', $functionality_selected);


/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

// verifico parametri passati da url ...
		$params = isset($this->params['url']['code']) ? $this->params['url']['code'] : null;
//pr('$params ' . $params);
		$params = base64_decode ($params);
//pr('$params ' . $params);
		$params = explode(URL_CODE_SEPARATOR, $params);

		$filter = isset($params[0]) ? $params[0] : null;
		$code = isset($params[1]) ? $params[1] : null;
//pr('$filter ' . $filter);
//pr('$code ' . $code);

		if ($filter && $code) {
			if ($filter == 'pillar') {
				$this->data['Product']['pillar'] = $code;
			}elseif ($filter == 'linear') {
				$this->data['Product']['linear'] = $code;
			}
		}


//TODO: verificare solo uno (pillar/linear)

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

		if(isset($this->data['Product']['pillar']) && !($this->data['Product']['pillar'] == '')) {

// elenco prodotti pillar associati

// elenco associazioni control / pillar
			$association_fields = 'ProductsAssociation.product_code_to';
			$association_conditions = array();
			$association_conditions['ProductsAssociation.product_code_from'] = $this->data['Product']['pillar'];
			$association_conditions['ProductsAssociation.product_line_from'] = 'pillar';
			$association_conditions['ProductsAssociation.product_line_to'] = 'control';
			$association_order = 'ProductsAssociation.product_code_to';

			$associations = $this->ProductsAssociation->find('all', array('fields' => 'DISTINCT '.$association_fields, 'conditions' => $association_conditions, 'order' => $association_order));
//pr('ProductsAssociation');
//pr($associations);

			$code_selected = array();
			foreach ($associations as $key => $value) {
//pr($value);
				$code_selected[] = $value['ProductsAssociation']['product_code_to'];
			}
//pr($code_selected);
			$conditions[$model_name.'.code'] = $code_selected;
			$pillar_selected = $this->data['Product']['pillar'];
		}
		$this->set('pillar_selected', $pillar_selected);
//pr('$pillar_selected ' . $pillar_selected);

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

		if(isset($this->data['Product']['linear']) && !($this->data['Product']['linear'] == '')) {

// elenco prodotti linear associati

// elenco associazioni control / linear
			$association_fields = 'ProductsAssociation.product_code_to';
			$association_conditions = array();
			$association_conditions['ProductsAssociation.product_code_from'] = $this->data['Product']['linear'];
			$association_conditions['ProductsAssociation.product_line_from'] = 'linear';
			$association_conditions['ProductsAssociation.product_line_to'] = 'control';
			$association_order = 'ProductsAssociation.product_code_to';

			$associations = $this->ProductsAssociation->find('all', array('fields' => 'DISTINCT '.$association_fields, 'conditions' => $association_conditions, 'order' => $association_order));
//pr('ProductsAssociation');
//pr($associations);

			$code_selected = array();
			foreach ($associations as $key => $value) {
//pr($value);
				$code_selected[] = $value['ProductsAssociation']['product_code_to'];
			}
//pr($code_selected);
			$conditions[$model_name.'.code'] = $code_selected;
			$linear_selected = $this->data['Product']['linear'];
		}
		$this->set('linear_selected', $linear_selected);
//pr('$linear_selected ' . $linear_selected);

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////



//pr('$conditions');
//pr($conditions);


	// gestione ordinamento
		if ($order) $order .= ',';
		$order .= $model_name.'.code ASC';
//pr($order);

	// elenco prodotti
		$products_list_fields = $model_name.'.code, '.$model_name.'.application_auto, '.$model_name.'.application_hoof, '.$model_name.'.application_medi, '.$model_name.'.application_buil, '.$model_name.'.application_heal, '.$model_name.'.image, '.$model_name.'.file_pdf, '.$model_name.'.file_drawing, '.$model_name.'.link';
		$products_list = $this->$model_name->find('all', array('fields' => 'DISTINCT '.$products_list_fields, 'conditions' => $conditions, 'order' => $order));
//pr('$products_list');
//pr($products_list);

	// aggiungo dati varianti prodotto
		foreach($products_list as $key => $value) {
			$products_list_fields = $model_name.'.*';
			$products_list_conditions = $conditions;
			$products_list_conditions[$model_name.'.code'] = $value[$model_name]['code'];
			$products_list_order = $model_name.'.code_id';
//pr('$products_list_conditions');
//pr($products_list_conditions);

			$products_list_related = $this->$model_name->find('all', array('fields' => $products_list_fields, 'conditions' => $products_list_conditions, 'order' => $products_list_order));
//pr('$products_list_related');
//pr($products_list_related);
			$products_list[$key]['related_values'] = $products_list_related;


// elenco associazioni accessori e famiglia prodotto / codice selezionato
			$association_fields = 'ProductsAssociation.product_code_to';
			$association_conditions = array();
			$association_conditions['ProductsAssociation.product_code_from'] = $value[$model_name]['code'];
			$association_conditions['ProductsAssociation.product_line_from'] = 'control';
			$association_conditions['ProductsAssociation.product_line_to'] = 'accessories';
			$association_order = 'ProductsAssociation.product_code_to';

			$associations = $this->ProductsAssociation->find('all', array('fields' => 'DISTINCT '.$association_fields, 'conditions' => $association_conditions, 'order' => $association_order));
//pr('ProductsAssociation');
//pr($associations);

			$products_list[$key]['related_accessories'] = $associations;


/*
pr($products_list + related_values);
pr($products_list);
exit();
*/
		}


		$this->set('products_list', $products_list);

	// dati x filtri di ricerca
		$this->_init_search_criteria_control($conditions, $order, $model_name);

		if ($this->RequestHandler->isAjax()) {
			Configure::write('debug', 1);
			$this->layout = 'ajax';
			$this->Session->write($model_name.'.conditions', $conditions);
			$this->render('products_control_list');
		} else {
			$this->Session->delete($model_name.'.conditions');
		}

	}


	function products_accessory() {

//TODO: personalizzare su controller / action
		$title_for_layout = __('title_for_layout_products_accessory', true);
		$this->set('title_for_layout', $title_for_layout);

		$description_for_layout = __('description_for_layout_products_accessory', true);
		$description_for_layout = htmlspecialchars ($description_for_layout);
		$this->set('description_for_layout', $description_for_layout);

		$keywords_for_layout = __('keywords_for_layout_products_accessory', true);
		$this->set('keywords_for_layout', $keywords_for_layout);
//TODO: personalizzare su controller / action


$product_type_id = ID_PRODUCT_TYPE_ACCESSORY;
$this->set('product_type_id', $product_type_id);

$product_type_slug = SLUG_PRODUCT_TYPE_ACCESSORY;
$this->set('product_type_slug', $product_type_slug);

$product_type_code = CODE_PRODUCT_TYPE_ACCESSORY;
$this->set('product_type_code', $product_type_code);

$model_name = 'ProductsAccessory';
$this->set('model_name', $model_name);


	// gestione criteri di ricerca
		$power_selected = '';
		$type_of_protection_selected = '';
		$colour_selected = '';
		$channels_selected = '';

$pillar_selected = '';
$linear_selected = '';
$control_selected = '';

		$conditions = array();
		$order = '';

		if(isset($this->data['Product']['power']) && !($this->data['Product']['power'] == '')) {
			$conditions[$model_name.'.power'] = $this->data['Product']['power'];
			$power_selected = $this->data['Product']['power'];
		}
		$this->set('power_selected', $power_selected);

		if(isset($this->data['Product']['type_of_protection']) && !($this->data['Product']['type_of_protection'] == '')) {
			$conditions[$model_name.'.type_of_protection'] = $this->data['Product']['type_of_protection'];
			$type_of_protection_selected = $this->data['Product']['type_of_protection'];
		}
		$this->set('type_of_protection_selected', $type_of_protection_selected);

		if(isset($this->data['Product']['colour']) && !($this->data['Product']['colour'] == '')) {
			$conditions[$model_name.'.colour'] = $this->data['Product']['colour'];
			$colour_selected = $this->data['Product']['colour'];
		}
		$this->set('colour_selected', $colour_selected);

		if(isset($this->data['Product']['channels']) && !($this->data['Product']['channels'] == '')) {
			$conditions[$model_name.'.channels'] = $this->data['Product']['channels'];
			$channels_selected = $this->data['Product']['channels'];
		}
		$this->set('channels_selected', $channels_selected);

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

// verifico parametri passati da url ...
		$params = isset($this->params['url']['code']) ? $this->params['url']['code'] : null;
//pr('$params ' . $params);
		$params = base64_decode ($params);
//pr('$params ' . $params);
		$params = explode(URL_CODE_SEPARATOR, $params);

		$filter = isset($params[0]) ? $params[0] : null;
		$code = isset($params[1]) ? $params[1] : null;
//pr('$filter ' . $filter);
//pr('$code ' . $code);

		if ($filter && $code) {
			if ($filter == 'pillar') {
				$this->data['Product']['pillar'] = $code;
			}elseif ($filter == 'linear') {
				$this->data['Product']['linear'] = $code;
			}
		}


//TODO: verificare solo uno (pillar/linear)

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

		if(isset($this->data['Product']['pillar']) && !($this->data['Product']['pillar'] == '')) {

// elenco prodotti pillar associati

// elenco associazioni accessory / pillar
			$association_fields = 'ProductsAssociation.product_code_to';
			$association_conditions = array();
			$association_conditions['ProductsAssociation.product_code_from'] = $this->data['Product']['pillar'];
			$association_conditions['ProductsAssociation.product_line_from'] = 'pillar';
			$association_conditions['ProductsAssociation.product_line_to'] = 'accessories';
			$association_order = 'ProductsAssociation.product_code_to';

			$associations = $this->ProductsAssociation->find('all', array('fields' => 'DISTINCT '.$association_fields, 'conditions' => $association_conditions, 'order' => $association_order));
//pr('ProductsAssociation');
//pr($associations);

			$code_selected = array();
			foreach ($associations as $key => $value) {
//pr($value);
				$code_selected[] = $value['ProductsAssociation']['product_code_to'];
			}
//pr($code_selected);
			$conditions[$model_name.'.code'] = $code_selected;
			$pillar_selected = $this->data['Product']['pillar'];
		}
		$this->set('pillar_selected', $pillar_selected);
//pr('$pillar_selected ' . $pillar_selected);

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

		if(isset($this->data['Product']['linear']) && !($this->data['Product']['linear'] == '')) {

// elenco prodotti linear associati

// elenco associazioni accessory / linear
			$association_fields = 'ProductsAssociation.product_code_to';
			$association_conditions = array();
			$association_conditions['ProductsAssociation.product_code_from'] = $this->data['Product']['linear'];
			$association_conditions['ProductsAssociation.product_line_from'] = 'linear';
			$association_conditions['ProductsAssociation.product_line_to'] = 'accessories';
			$association_order = 'ProductsAssociation.product_code_to';

			$associations = $this->ProductsAssociation->find('all', array('fields' => 'DISTINCT '.$association_fields, 'conditions' => $association_conditions, 'order' => $association_order));
//pr('ProductsAssociation');
//pr($associations);

			$code_selected = array();
			foreach ($associations as $key => $value) {
//pr($value);
				$code_selected[] = $value['ProductsAssociation']['product_code_to'];
			}
//pr($code_selected);
			$conditions[$model_name.'.code'] = $code_selected;
			$linear_selected = $this->data['Product']['linear'];
		}
		$this->set('linear_selected', $linear_selected);
//pr('$linear_selected ' . $linear_selected);

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

		if(isset($this->data['Product']['control']) && !($this->data['Product']['control'] == '')) {

// elenco prodotti control associati

// elenco associazioni accessory / control
			$association_fields = 'ProductsAssociation.product_code_to';
			$association_conditions = array();
			$association_conditions['ProductsAssociation.product_code_from'] = $this->data['Product']['control'];
			$association_conditions['ProductsAssociation.product_line_from'] = 'control';
			$association_conditions['ProductsAssociation.product_line_to'] = 'accessories';
			$association_order = 'ProductsAssociation.product_code_to';

			$associations = $this->ProductsAssociation->find('all', array('fields' => 'DISTINCT '.$association_fields, 'conditions' => $association_conditions, 'order' => $association_order));
//pr('ProductsAssociation');
//pr($associations);

			$code_selected = array();
			foreach ($associations as $key => $value) {
//pr($value);
				$code_selected[] = $value['ProductsAssociation']['product_code_to'];
			}
//pr($code_selected);
			$conditions[$model_name.'.code'] = $code_selected;
			$control_selected = $this->data['Product']['control'];
		}
		$this->set('control_selected', $control_selected);
//pr('$control_selected ' . $control_selected);

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

//pr('$conditions');
//pr($conditions);


	// gestione ordinamento
		if ($order) $order .= ',';
		$order .= $model_name.'.code ASC';
//pr($order);

	// elenco prodotti
		$products_list_fields = $model_name.'.code, '.$model_name.'.power,'.$model_name.'.channels,'.$model_name.'.type_of_protection,'.$model_name.'.colour,'.$model_name.'.img, '.$model_name.'.file_pdf, '.$model_name.'.file_drawing, '.$model_name.'.link';

		$products_list = $this->$model_name->find('all', array('fields' => 'DISTINCT '.$products_list_fields, 'conditions' => $conditions, 'order' => $order));
//pr('$products_list');
//pr($products_list);

	// aggiungo dati varianti prodotto
//		foreach($products_list as $key => $value) {
/*
			$products_list_fields = $model_name.'.*';
			$products_list_conditions = $conditions;
			$products_list_conditions[$model_name.'.code'] = $value[$model_name]['code'];
			$products_list_order = $model_name.'.code_id';
//pr('$products_list_conditions');
//pr($products_list_conditions);

			$products_list_related = $this->$model_name->find('all', array('fields' => $products_list_fields, 'conditions' => $products_list_conditions, 'order' => $products_list_order));
//pr('$products_list_related');
//pr($products_list_related);
			$products_list[$key]['related_values'] = $products_list_related;
*/
/*
// elenco associazioni accessori e famiglia prodotto / codice selezionato
			$association_fields = 'ProductsAssociation.product_code_to';
			$association_conditions = array();
			$association_conditions['ProductsAssociation.product_code_from'] = $value[$model_name]['code'];
			$association_conditions['ProductsAssociation.product_line_from'] = 'control';
			$association_conditions['ProductsAssociation.product_line_to'] = 'accessories';
			$association_order = 'ProductsAssociation.product_code_to';

			$associations = $this->ProductsAssociation->find('all', array('fields' => 'DISTINCT '.$association_fields, 'conditions' => $association_conditions, 'order' => $association_order));
//pr('ProductsAssociation');
//pr($associations);

			$products_list[$key]['related_accessories'] = $associations;
*/
//		}
/*
pr('$products_list + related_values');
pr($products_list);
exit();
*/


		$this->set('products_list', $products_list);

	// dati x filtri di ricerca
		$this->_init_search_criteria_accessory($conditions, $order, $model_name);

		if ($this->RequestHandler->isAjax()) {
			Configure::write('debug', 1);
			$this->layout = 'ajax';
			$this->Session->write($model_name.'.conditions', $conditions);
			$this->render('products_accessory_list');
		} else {
			$this->Session->delete($model_name.'.conditions');
		}

	}


////////////////////////////////////////////////////////////////////
// CODE_PRODUCT_TYPE_PILLAR
////////////////////////////////////////////////////////////////////
	function _init_search_criteria_pillar($conditions, $order, $model_name) {
/*
pr('$conditions');
pr($conditions);
pr('$order');
pr($order);
pr('$model_name');
pr($model_name);
*/


	// generazione filtri 'application' dinamici ...
		$filter_application_product_type_pillar = unserialize(FILTER_APPLICATION_PRODUCT_TYPE_PILLAR);
		$filter_application_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c application ' . $key_c);
			if (strpos($key_c, 'application') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp application');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_application_product_type_pillar as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['application_'.$key_ctrl]) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_application_product_type_exist[$key_ctrl]) ? $filter_application_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_application_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_application_product_type_pillar_new = array();
		foreach($filter_application_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_application_product_type_pillar_new[$key] = __($filter_application_product_type_pillar[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_application_product_type_pillar = $filter_application_product_type_pillar_new;

		$this->set('filter_application_product_type_pillar', $filter_application_product_type_pillar);


	// generazione filtri 'load' dinamici ...
		$filter_load_product_type_pillar = unserialize(FILTER_LOAD_PRODUCT_TYPE_PILLAR);
		$filter_load_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c load ' . $key_c);
			if (strpos($key_c, 'load') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp load');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_load_product_type_pillar as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['load'] >= $key_ctrl) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_load_product_type_exist[$key_ctrl]) ? $filter_load_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_load_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_load_product_type_pillar_new = array();
		foreach($filter_load_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_load_product_type_pillar_new[$key] = __($filter_load_product_type_pillar[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_load_product_type_pillar = $filter_load_product_type_pillar_new;

		$this->set('filter_load_product_type_pillar', $filter_load_product_type_pillar);


	// generazione filtri 'bending' dinamici ...
		$filter_bending_product_type_pillar = unserialize(FILTER_BENDING_PRODUCT_TYPE_PILLAR);
		$filter_bending_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c bending ' . $key_c);
			if (strpos($key_c, 'bending') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp bending');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_bending_product_type_pillar as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['bending'] >= $key_ctrl) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_bending_product_type_exist[$key_ctrl]) ? $filter_bending_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_bending_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_bending_product_type_pillar_new = array();
		foreach($filter_bending_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_bending_product_type_pillar_new[$key] = __($filter_bending_product_type_pillar[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_bending_product_type_pillar = $filter_bending_product_type_pillar_new;

		$this->set('filter_bending_product_type_pillar', $filter_bending_product_type_pillar);


	// generazione filtri 'speed' dinamici ...
		$filter_speed_product_type_pillar = unserialize(FILTER_SPEED_PRODUCT_TYPE_PILLAR);
		$filter_speed_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c speed ' . $key_c);
			if (strpos($key_c, 'speed') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp speed');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_speed_product_type_pillar as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
//TODO: verificare gestione min / max
				$key_ctrl_tmp = explode('|', $key_ctrl);
				$key_ctrl_min = isset($key_ctrl_tmp[0]) ? $key_ctrl_tmp[0] : null;
				$key_ctrl_max = isset($key_ctrl_tmp[1]) ? $key_ctrl_tmp[1] : null;
//pr('$key_ctrl_min ' . $key_ctrl_min . ' - $key_ctrl_max ' . $key_ctrl_max);
//pr('$value[$model_name][\'speed\'] ' . $value[$model_name]['speed']);
				$ctrl_min = true;
				$ctrl_max = true;
				if ( ($key_ctrl_min != null) && ($value[$model_name]['speed'] <= $key_ctrl_min) ) {
					$ctrl_min = false;
				}
				if ( ($key_ctrl_max != null) && ($value[$model_name]['speed'] > $key_ctrl_max) ) {
					$ctrl_max = false;
				}
//pr('$ctrl_min ' . $ctrl_min);
//pr('$ctrl_max ' . $ctrl_max);
				if ( $ctrl_min && $ctrl_max && ($products_code_ctrl != $products_code) ) {
//TODO: verificare gestione min / max
					$tot_tmp = isset($filter_speed_product_type_exist[$key_ctrl]) ? $filter_speed_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_speed_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

/*
		foreach($filter_speed_product_type_pillar as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
//				if ( ($this->speed_selected && ($key_ctrl == $this->speed_selected)) || !$this->speed_selected ) {
					if ( ($value[$model_name]['speed'] >= $key_ctrl) && ($products_code_ctrl != $products_code) ) {
						$tot_tmp = isset($filter_speed_product_type_exist[$key_ctrl]) ? $filter_speed_product_type_exist[$key_ctrl] : 0;
						$tot_tmp ++;
						$filter_speed_product_type_exist[$key_ctrl] = $tot_tmp;
						$products_code_ctrl = $products_code;
					}
//				}
			}
		}
*/

		$filter_speed_product_type_pillar_new = array();
		foreach($filter_speed_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_speed_product_type_pillar_new[$key] = __($filter_speed_product_type_pillar[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_speed_product_type_pillar = $filter_speed_product_type_pillar_new;

		$this->set('filter_speed_product_type_pillar', $filter_speed_product_type_pillar);


	// generazione filtri 'stroke' dinamici ...
		$filter_stroke_product_type_pillar = unserialize(FILTER_STROKE_PRODUCT_TYPE_PILLAR);
		$filter_stroke_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c stroke ' . $key_c);
			if (strpos($key_c, 'stroke') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp stroke');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

/*
		foreach($filter_stroke_product_type_pillar as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
//TODO: verificare gestione min / max
				$key_ctrl_tmp = explode('|', $key_ctrl);
				$key_ctrl_min = isset($key_ctrl_tmp[0]) ? $key_ctrl_tmp[0] : null;
				$key_ctrl_max = isset($key_ctrl_tmp[1]) ? $key_ctrl_tmp[1] : null;
//pr('$key_ctrl_min ' . $key_ctrl_min);
//pr('$key_ctrl_max ' . $key_ctrl_max);
				$ctrl_min = true;
				$ctrl_max = true;
				if ( ($key_ctrl_min  != null) && ($value[$model_name]['stroke'] <= $key_ctrl_min) ) {
					$ctrl_min = false;
				}
				if ( ($key_ctrl_max  != null) && ($value[$model_name]['stroke'] > $key_ctrl_max) ) {
					$ctrl_max = false;
				}
				if ( $ctrl_min && $ctrl_max && ($products_code_ctrl != $products_code) ) {
//TODO: verificare gestione min / max
					$tot_tmp = isset($filter_stroke_product_type_exist[$key_ctrl]) ? $filter_stroke_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_stroke_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}
*/

		foreach($filter_stroke_product_type_pillar as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['stroke'] >= $key_ctrl) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_stroke_product_type_exist[$key_ctrl]) ? $filter_stroke_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_stroke_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_stroke_product_type_pillar_new = array();
		foreach($filter_stroke_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_stroke_product_type_pillar_new[$key] = __($filter_stroke_product_type_pillar[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_stroke_product_type_pillar = $filter_stroke_product_type_pillar_new;

		$this->set('filter_stroke_product_type_pillar', $filter_stroke_product_type_pillar);


	// generazione filtri 'voltage' dinamici ...
		$filter_voltage_product_type_pillar = unserialize(FILTER_VOLTAGE_PRODUCT_TYPE_PILLAR);
		$filter_voltage_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c voltage ' . $key_c);
			if (strpos($key_c, 'voltage') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp voltage');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_voltage_product_type_pillar as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['voltage'] == $key_ctrl) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_voltage_product_type_exist[$key_ctrl]) ? $filter_voltage_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_voltage_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_voltage_product_type_pillar_new = array();
		foreach($filter_voltage_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_voltage_product_type_pillar_new[$key] = __($filter_voltage_product_type_pillar[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_voltage_product_type_pillar = $filter_voltage_product_type_pillar_new;

		$this->set('filter_voltage_product_type_pillar', $filter_voltage_product_type_pillar);


	// generazione filtri 'optional' dinamici ...
		$filter_optional_product_type_pillar = unserialize(FILTER_OPTIONAL_PRODUCT_TYPE_PILLAR);
		$filter_optional_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c optional ' . $key_c);
			if (strpos($key_c, 'optional') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp optional');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_optional_product_type_pillar as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['optional_'.$key_ctrl]) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_optional_product_type_exist[$key_ctrl]) ? $filter_optional_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_optional_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_optional_product_type_pillar_new = array();
		foreach($filter_optional_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_optional_product_type_pillar_new[$key] = __($filter_optional_product_type_pillar[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_optional_product_type_pillar = $filter_optional_product_type_pillar_new;

		$this->set('filter_optional_product_type_pillar', $filter_optional_product_type_pillar);


	// generazione filtri 'footprint' dinamici ...
		$filter_footprint_product_type_pillar = unserialize(FILTER_FOOTPRINT_PRODUCT_TYPE_PILLAR);
		$filter_footprint_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c footprint ' . $key_c);
			if (strpos($key_c, 'footprint') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp footprint');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_footprint_product_type_pillar as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['footprint'] >= $key_ctrl) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_footprint_product_type_exist[$key_ctrl]) ? $filter_footprint_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_footprint_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_footprint_product_type_pillar_new = array();
		foreach($filter_footprint_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_footprint_product_type_pillar_new[$key] = __($filter_footprint_product_type_pillar[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_footprint_product_type_pillar = $filter_footprint_product_type_pillar_new;

		$this->set('filter_footprint_product_type_pillar', $filter_footprint_product_type_pillar);


	// generazione filtri 'certificato' dinamici ...
		$filter_certificato_product_type_pillar = unserialize(FILTER_CERTIFICATO_PRODUCT_TYPE_PILLAR);
		$filter_certificato_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c certificato ' . $key_c);
			if (strpos($key_c, 'certificato') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp certificato');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_certificato_product_type_pillar as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['certificato'] == $key_ctrl) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_certificato_product_type_exist[$key_ctrl]) ? $filter_certificato_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_certificato_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_certificato_product_type_pillar_new = array();
		foreach($filter_certificato_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_certificato_product_type_pillar_new[$key] = __($filter_certificato_product_type_pillar[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_certificato_product_type_pillar = $filter_certificato_product_type_pillar_new;

		$this->set('filter_certificato_product_type_pillar', $filter_certificato_product_type_pillar);

	}


////////////////////////////////////////////////////////////////////
// CODE_PRODUCT_TYPE_LINEAR
////////////////////////////////////////////////////////////////////
	function _init_search_criteria_linear($conditions, $order, $model_name) {
/*
pr('$conditions');
pr($conditions);
pr('$order');
pr($order);
pr('$model_name');
pr($model_name);
*/


	// generazione filtri 'application' dinamici ...
		$filter_application_product_type_linear = unserialize(FILTER_APPLICATION_PRODUCT_TYPE_LINEAR);
		$filter_application_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c application ' . $key_c);
			if (strpos($key_c, 'application') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp application');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_application_product_type_linear as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['application_'.$key_ctrl]) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_application_product_type_exist[$key_ctrl]) ? $filter_application_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_application_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_application_product_type_linear_new = array();
		foreach($filter_application_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_application_product_type_linear_new[$key] = __($filter_application_product_type_linear[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_application_product_type_linear = $filter_application_product_type_linear_new;

		$this->set('filter_application_product_type_linear', $filter_application_product_type_linear);


	// generazione filtri 'load' dinamici ...
		$filter_load_product_type_linear = unserialize(FILTER_LOAD_PRODUCT_TYPE_LINEAR);
		$filter_load_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c load ' . $key_c);
			if (strpos($key_c, 'load') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp load');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_load_product_type_linear as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['load'] >= $key_ctrl) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_load_product_type_exist[$key_ctrl]) ? $filter_load_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_load_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_load_product_type_linear_new = array();
		foreach($filter_load_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_load_product_type_linear_new[$key] = __($filter_load_product_type_linear[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_load_product_type_linear = $filter_load_product_type_linear_new;

		$this->set('filter_load_product_type_linear', $filter_load_product_type_linear);


	// generazione filtri 'speed' dinamici ...
		$filter_speed_product_type_linear = unserialize(FILTER_SPEED_PRODUCT_TYPE_LINEAR);
		$filter_speed_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c speed ' . $key_c);
			if (strpos($key_c, 'speed') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp speed');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_speed_product_type_linear as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
//TODO: verificare gestione min / max
				$key_ctrl_tmp = explode('|', $key_ctrl);
				$key_ctrl_min = isset($key_ctrl_tmp[0]) ? $key_ctrl_tmp[0] : null;
				$key_ctrl_max = isset($key_ctrl_tmp[1]) ? $key_ctrl_tmp[1] : null;
//pr('$key_ctrl_min ' . $key_ctrl_min . ' - $key_ctrl_max ' . $key_ctrl_max);
//pr('$value[$model_name][\'speed\'] ' . $value[$model_name]['speed']);
				$ctrl_min = true;
				$ctrl_max = true;
				if ( ($key_ctrl_min != null) && ($value[$model_name]['speed'] <= $key_ctrl_min) ) {
					$ctrl_min = false;
				}
				if ( ($key_ctrl_max != null) && ($value[$model_name]['speed'] > $key_ctrl_max) ) {
					$ctrl_max = false;
				}
//pr('$ctrl_min ' . $ctrl_min);
//pr('$ctrl_max ' . $ctrl_max);
	//			if ( ($value[$model_name]['speed'] == $key_ctrl) && ($products_code_ctrl != $products_code) ) {
	//			if ( ($value[$model_name]['speed'] >= $key_ctrl) && ($products_code_ctrl != $products_code) ) {
				if ( $ctrl_min && $ctrl_max && ($products_code_ctrl != $products_code) ) {
//TODO: verificare gestione min / max

					$tot_tmp = isset($filter_speed_product_type_exist[$key_ctrl]) ? $filter_speed_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_speed_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}
/*
		foreach($filter_speed_product_type_linear as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
//				if ( ($this->speed_selected && ($key_ctrl == $this->speed_selected)) || !$this->speed_selected ) {
					if ( ($value[$model_name]['speed'] >= $key_ctrl) && ($products_code_ctrl != $products_code) ) {
						$tot_tmp = isset($filter_speed_product_type_exist[$key_ctrl]) ? $filter_speed_product_type_exist[$key_ctrl] : 0;
						$tot_tmp ++;
						$filter_speed_product_type_exist[$key_ctrl] = $tot_tmp;
						$products_code_ctrl = $products_code;
					}
//				}
			}
		}
*/

		$filter_speed_product_type_linear_new = array();
		foreach($filter_speed_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_speed_product_type_linear_new[$key] = __($filter_speed_product_type_linear[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_speed_product_type_linear = $filter_speed_product_type_linear_new;

		$this->set('filter_speed_product_type_linear', $filter_speed_product_type_linear);


	// generazione filtri 'stroke' dinamici ...
		$filter_stroke_product_type_linear = unserialize(FILTER_STROKE_PRODUCT_TYPE_LINEAR);
		$filter_stroke_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c stroke ' . $key_c);
			if (strpos($key_c, 'stroke') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp stroke');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

/*
		foreach($filter_stroke_product_type_linear as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
//TODO: verificare gestione min / max
				$key_ctrl_tmp = explode('|', $key_ctrl);
				$key_ctrl_min = isset($key_ctrl_tmp[0]) ? $key_ctrl_tmp[0] : null;
				$key_ctrl_max = isset($key_ctrl_tmp[1]) ? $key_ctrl_tmp[1] : null;
//pr('$key_ctrl_min ' . $key_ctrl_min);
//pr('$key_ctrl_max ' . $key_ctrl_max);
				$ctrl_min = true;
				$ctrl_max = true;
				if ( ($key_ctrl_min != null) && ($value[$model_name]['stroke'] <= $key_ctrl_min) ) {
					$ctrl_min = false;
				}
				if ( ($key_ctrl_max != null) && ($value[$model_name]['stroke'] > $key_ctrl_max) ) {
					$ctrl_max = false;
				}
				if ( $ctrl_min && $ctrl_max && ($products_code_ctrl != $products_code) ) {
//TODO: verificare gestione min / max

					$tot_tmp = isset($filter_stroke_product_type_exist[$key_ctrl]) ? $filter_stroke_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_stroke_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}
*/

		foreach($filter_stroke_product_type_linear as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['stroke'] >= $key_ctrl) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_stroke_product_type_exist[$key_ctrl]) ? $filter_stroke_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_stroke_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_stroke_product_type_linear_new = array();
		foreach($filter_stroke_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_stroke_product_type_linear_new[$key] = __($filter_stroke_product_type_linear[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_stroke_product_type_linear = $filter_stroke_product_type_linear_new;

		$this->set('filter_stroke_product_type_linear', $filter_stroke_product_type_linear);


	// generazione filtri 'duty' dinamici ...
		$filter_duty_product_type_linear = unserialize(FILTER_DUTY_PRODUCT_TYPE_LINEAR);
		$filter_duty_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c duty ' . $key_c);
			if (strpos($key_c, 'duty') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp duty');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_duty_product_type_linear as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
//TODO: verificare gestione min / max
				$key_ctrl_tmp = explode('|', $key_ctrl);
				$key_ctrl_min = isset($key_ctrl_tmp[0]) ? $key_ctrl_tmp[0] : null;
				$key_ctrl_max = isset($key_ctrl_tmp[1]) ? $key_ctrl_tmp[1] : null;
//pr('$key_ctrl_min ' . $key_ctrl_min);
//pr('$key_ctrl_max ' . $key_ctrl_max);
				$ctrl_min = true;
				$ctrl_max = true;
				if ( ($key_ctrl_min != null) && ($value[$model_name]['duty'] <= $key_ctrl_min) ) {
					$ctrl_min = false;
				}
				if ( ($key_ctrl_max != null) && ($value[$model_name]['duty'] > $key_ctrl_max) ) {
					$ctrl_max = false;
				}
				if ( $ctrl_min && $ctrl_max && ($products_code_ctrl != $products_code) ) {
//TODO: verificare gestione min / max

					$tot_tmp = isset($filter_duty_product_type_exist[$key_ctrl]) ? $filter_duty_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_duty_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_duty_product_type_linear_new = array();
		foreach($filter_duty_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_duty_product_type_linear_new[$key] = __($filter_duty_product_type_linear[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_duty_product_type_linear = $filter_duty_product_type_linear_new;

		$this->set('filter_duty_product_type_linear', $filter_duty_product_type_linear);


	// generazione filtri 'voltage' dinamici ...
		$filter_voltage_product_type_linear = unserialize(FILTER_VOLTAGE_PRODUCT_TYPE_LINEAR);
		$filter_voltage_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c voltage ' . $key_c);
			if (strpos($key_c, 'voltage') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp voltage');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_voltage_product_type_linear as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['voltage'] == $key_ctrl) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_voltage_product_type_exist[$key_ctrl]) ? $filter_voltage_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_voltage_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_voltage_product_type_linear_new = array();
		foreach($filter_voltage_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_voltage_product_type_linear_new[$key] = __($filter_voltage_product_type_linear[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_voltage_product_type_linear = $filter_voltage_product_type_linear_new;

		$this->set('filter_voltage_product_type_linear', $filter_voltage_product_type_linear);


	// generazione filtri 'optional' dinamici ...
		$filter_optional_product_type_linear = unserialize(FILTER_OPTIONAL_PRODUCT_TYPE_LINEAR);
		$filter_optional_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
//TODO: verificare come gestire
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c optional ' . $key_c);
			if (strpos($key_c, 'optional') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp optional');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_optional_product_type_linear as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['optional_'.$key_ctrl]) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_optional_product_type_exist[$key_ctrl]) ? $filter_optional_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_optional_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_optional_product_type_linear_new = array();
		foreach($filter_optional_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_optional_product_type_linear_new[$key] = __($filter_optional_product_type_linear[$key], true); // . ' (' . $value . ')';
			}
		}
		$filter_optional_product_type_linear = $filter_optional_product_type_linear_new;

		$this->set('filter_optional_product_type_linear', $filter_optional_product_type_linear);


	// generazione filtri 'certificato' dinamici ...
		$filter_certificato_product_type_linear = unserialize(FILTER_CERTIFICATO_PRODUCT_TYPE_LINEAR);
		$filter_certificato_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c certificato ' . $key_c);
			if (strpos($key_c, 'certificato') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp certificato');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_certificato_product_type_linear as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['certificato'] == $key_ctrl) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_certificato_product_type_exist[$key_ctrl]) ? $filter_certificato_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_certificato_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_certificato_product_type_linear_new = array();
		foreach($filter_certificato_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_certificato_product_type_linear_new[$key] = __($filter_certificato_product_type_linear[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_certificato_product_type_linear = $filter_certificato_product_type_linear_new;

		$this->set('filter_certificato_product_type_linear', $filter_certificato_product_type_linear);






	// generazione filtri 'self_locking' dinamici ...
		$filter_self_locking_product_type_linear = unserialize(FILTER_SELF_LOCKING_PRODUCT_TYPE_LINEAR);
		$filter_self_locking_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c self_locking ' . $key_c);
			if (strpos($key_c, 'self_locking') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp self_locking');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_self_locking_product_type_linear as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['self_locking'] == $key_ctrl) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_self_locking_product_type_exist[$key_ctrl]) ? $filter_self_locking_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_self_locking_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_self_locking_product_type_linear_new = array();
		foreach($filter_self_locking_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_self_locking_product_type_linear_new[$key] = __($filter_self_locking_product_type_linear[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_self_locking_product_type_linear = $filter_self_locking_product_type_linear_new;

		$this->set('filter_self_locking_product_type_linear', $filter_self_locking_product_type_linear);

	}


////////////////////////////////////////////////////////////////////
// CODE_PRODUCT_TYPE_ROTARY
////////////////////////////////////////////////////////////////////
	function _init_search_criteria_rotary($conditions, $order, $model_name) {
/*
pr('$conditions');
pr($conditions);
pr('$order');
pr($order);
pr('$model_name');
pr($model_name);
*/


	// generazione filtri 'application' dinamici ...
		$filter_application_product_type_rotary = unserialize(FILTER_APPLICATION_PRODUCT_TYPE_ROTARY);
		$filter_application_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c application ' . $key_c);
			if (strpos($key_c, 'application') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp application');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_application_product_type_rotary as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['application_'.$key_ctrl]) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_application_product_type_exist[$key_ctrl]) ? $filter_application_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_application_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_application_product_type_rotary_new = array();
		foreach($filter_application_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_application_product_type_rotary_new[$key] = __($filter_application_product_type_rotary[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_application_product_type_rotary = $filter_application_product_type_rotary_new;

		$this->set('filter_application_product_type_rotary', $filter_application_product_type_rotary);


	// generazione filtri 'load' dinamici ...
		$filter_load_product_type_rotary = unserialize(FILTER_LOAD_PRODUCT_TYPE_ROTARY);
		$filter_load_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c load ' . $key_c);
			if (strpos($key_c, 'load') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp load');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_load_product_type_rotary as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
//				if ( ($value[$model_name]['load'] == $key_ctrl) && ($products_code_ctrl != $products_code) ) {
				if ( ($value[$model_name]['load'] >= $key_ctrl) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_load_product_type_exist[$key_ctrl]) ? $filter_load_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_load_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_load_product_type_rotary_new = array();
		foreach($filter_load_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_load_product_type_rotary_new[$key] = __($filter_load_product_type_rotary[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_load_product_type_rotary = $filter_load_product_type_rotary_new;

		$this->set('filter_load_product_type_rotary', $filter_load_product_type_rotary);


	// generazione filtri 'speed' dinamici ...
		$filter_speed_product_type_rotary = unserialize(FILTER_SPEED_PRODUCT_TYPE_ROTARY);
		$filter_speed_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c speed ' . $key_c);
			if (strpos($key_c, 'speed') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp speed');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_speed_product_type_rotary as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
//TODO: verificare gestione min / max
				$key_ctrl_tmp = explode('|', $key_ctrl);
				$key_ctrl_min = isset($key_ctrl_tmp[0]) ? $key_ctrl_tmp[0] : null;
				$key_ctrl_max = isset($key_ctrl_tmp[1]) ? $key_ctrl_tmp[1] : null;
//pr('$key_ctrl_min ' . $key_ctrl_min);
//pr('$key_ctrl_max ' . $key_ctrl_max);
				$ctrl_min = true;
				$ctrl_max = true;
				if ( ($key_ctrl_min != null) && ($value[$model_name]['speed'] <= $key_ctrl_min) ) {
					$ctrl_min = false;
				}
				if ( ($key_ctrl_max != null) && ($value[$model_name]['speed'] > $key_ctrl_max) ) {
					$ctrl_max = false;
				}
				if ( $ctrl_min && $ctrl_max && ($products_code_ctrl != $products_code) ) {
//TODO: verificare gestione min / max

					$tot_tmp = isset($filter_speed_product_type_exist[$key_ctrl]) ? $filter_speed_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_speed_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}
/*
		foreach($filter_speed_product_type_rotary as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['speed'] >= $key_ctrl) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_speed_product_type_exist[$key_ctrl]) ? $filter_speed_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_speed_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}
*/

		$filter_speed_product_type_rotary_new = array();
		foreach($filter_speed_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_speed_product_type_rotary_new[$key] = __($filter_speed_product_type_rotary[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_speed_product_type_rotary = $filter_speed_product_type_rotary_new;

		$this->set('filter_speed_product_type_rotary', $filter_speed_product_type_rotary);


	// generazione filtri 'voltage' dinamici ...
		$filter_voltage_product_type_rotary = unserialize(FILTER_VOLTAGE_PRODUCT_TYPE_ROTARY);
		$filter_voltage_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c voltage ' . $key_c);
			if (strpos($key_c, 'voltage') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp voltage');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_voltage_product_type_rotary as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['voltage'] == $key_ctrl) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_voltage_product_type_exist[$key_ctrl]) ? $filter_voltage_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_voltage_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_voltage_product_type_rotary_new = array();
		foreach($filter_voltage_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_voltage_product_type_rotary_new[$key] = __($filter_voltage_product_type_rotary[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_voltage_product_type_rotary = $filter_voltage_product_type_rotary_new;

		$this->set('filter_voltage_product_type_rotary', $filter_voltage_product_type_rotary);


	// generazione filtri 'optional' dinamici ...
		$filter_optional_product_type_rotary = unserialize(FILTER_OPTIONAL_PRODUCT_TYPE_ROTARY);
		$filter_optional_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c optional ' . $key_c);
			if (strpos($key_c, 'optional') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp optional');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_optional_product_type_rotary as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
/*
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['optional_'.$key_ctrl]) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_optional_product_type_exist[$key_ctrl]) ? $filter_optional_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_optional_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
*/
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['optional_'.$key_ctrl]) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_optional_product_type_exist[$key_ctrl]) ? $filter_optional_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_optional_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_optional_product_type_rotary_new = array();
		foreach($filter_optional_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_optional_product_type_rotary_new[$key] = __($filter_optional_product_type_rotary[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_optional_product_type_rotary = $filter_optional_product_type_rotary_new;

		$this->set('filter_optional_product_type_rotary', $filter_optional_product_type_rotary);

	}


////////////////////////////////////////////////////////////////////
// CODE_PRODUCT_TYPE_CONTROL
////////////////////////////////////////////////////////////////////
	function _init_search_criteria_control($conditions, $order, $model_name) {
/*
pr('$conditions');
pr($conditions);
pr('$order');
pr($order);
pr('$model_name');
pr($model_name);
*/


	// generazione filtri 'application' dinamici ...
		$filter_application_product_type_control = unserialize(FILTER_APPLICATION_PRODUCT_TYPE_CONTROL);
		$filter_application_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c application ' . $key_c);
			if (strpos($key_c, 'application') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp application');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_application_product_type_control as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['application_'.$key_ctrl]) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_application_product_type_exist[$key_ctrl]) ? $filter_application_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_application_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_application_product_type_control_new = array();
		foreach($filter_application_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_application_product_type_control_new[$key] = __($filter_application_product_type_control[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_application_product_type_control = $filter_application_product_type_control_new;

		$this->set('filter_application_product_type_control', $filter_application_product_type_control);


	// generazione filtri 'motor' dinamici ...
		$filter_motor_product_type_control = unserialize(FILTER_MOTOR_PRODUCT_TYPE_CONTROL);
		$filter_motor_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c motor ' . $key_c);
			if (strpos($key_c, 'motor') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp motor');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_motor_product_type_control as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['motor'] >= $key_ctrl) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_motor_product_type_exist[$key_ctrl]) ? $filter_motor_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_motor_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_motor_product_type_control_new = array();
		foreach($filter_motor_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_motor_product_type_control_new[$key] = __($filter_motor_product_type_control[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_motor_product_type_control = $filter_motor_product_type_control_new;

		$this->set('filter_motor_product_type_control', $filter_motor_product_type_control);


	// generazione filtri 'output' dinamici ...
		$filter_output_product_type_control = unserialize(FILTER_OUTPUT_PRODUCT_TYPE_CONTROL);
		$filter_output_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c output ' . $key_c);
			if (strpos($key_c, 'output') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp output');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_output_product_type_control as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['output'] >= $key_ctrl) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_output_product_type_exist[$key_ctrl]) ? $filter_output_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_output_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_output_product_type_control_new = array();
		foreach($filter_output_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_output_product_type_control_new[$key] = __($filter_output_product_type_control[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_output_product_type_control = $filter_output_product_type_control_new;

		$this->set('filter_output_product_type_control', $filter_output_product_type_control);


	// generazione filtri 'input' dinamici ...
		$filter_input_product_type_control = unserialize(FILTER_INPUT_PRODUCT_TYPE_CONTROL);
		$filter_input_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c input ' . $key_c);
			if (strpos($key_c, 'input') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp input');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_input_product_type_control as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['input'] == $key_ctrl) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_input_product_type_exist[$key_ctrl]) ? $filter_input_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_input_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_input_product_type_control_new = array();
		foreach($filter_input_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_input_product_type_control_new[$key] = __($filter_input_product_type_control[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_input_product_type_control = $filter_input_product_type_control_new;

		$this->set('filter_input_product_type_control', $filter_input_product_type_control);


	// generazione filtri 'functionality' dinamici ...
		$filter_functionality_product_type_control = unserialize(FILTER_FUNCTIONALITY_PRODUCT_TYPE_CONTROL);
		$filter_functionality_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c functionality ' . $key_c);
			if (strpos($key_c, 'functionality') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp functionality');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_functionality_product_type_control as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
				if ( ($value[$model_name]['functionality_'.$key_ctrl]) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_functionality_product_type_exist[$key_ctrl]) ? $filter_functionality_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_functionality_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_functionality_product_type_control_new = array();
		foreach($filter_functionality_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_functionality_product_type_control_new[$key] = __($filter_functionality_product_type_control[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_functionality_product_type_control = $filter_functionality_product_type_control_new;

		$this->set('filter_functionality_product_type_control', $filter_functionality_product_type_control);


/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

// generazione filtri 'pillar' dinamici ...
		$filter_pillar_product_type_control = array();

// elenco associazioni control / pillar
		$association_fields = 'ProductsAssociation.product_code_from';
		$association_conditions = array();
		$association_conditions['ProductsAssociation.product_line_from'] = 'pillar';
		$association_conditions['ProductsAssociation.product_line_to'] = 'control';
		$association_order = 'ProductsAssociation.product_code_from';

		$associations = $this->ProductsAssociation->find('all', array('fields' => 'DISTINCT '.$association_fields, 'conditions' => $association_conditions, 'order' => $association_order));
//pr('ProductsAssociation');
//pr($associations);

			foreach ($associations as $key => $value) {
//pr($value);
				$filter_pillar_product_type_control[$value['ProductsAssociation']['product_code_from']] = $value['ProductsAssociation']['product_code_from'];
			}

//pr('// generazione filtri \'pillar\' dinamici ...');
//pr($filter_pillar_product_type_control);


		$filter_pillar_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
//pr($conditions);
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c input ' . $key_c);
			if (strpos($key_c, 'pillar') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp input');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_pillar_product_type_control as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];

//				if ( ($value[$model_name]['code'] == $key_ctrl) && ($products_code_ctrl != $products_code) ) {
//pr('$key_ctrl ' . $key_ctrl);

					$tot_tmp = isset($filter_pillar_product_type_exist[$key_ctrl]) ? $filter_pillar_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_pillar_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
//				}
			}
		}
// pr($filter_pillar_product_type_exist);

		$filter_pillar_product_type_control_new = array();
		foreach($filter_pillar_product_type_exist as $key => $value) {
/*
			if ( $value ) {
				$filter_pillar_product_type_control_new[$key] = __($filter_pillar_product_type_control[$key], true) . ' (' . $value . ')';
			}
*/
			if ( $value ) {
				$filter_pillar_product_type_control_new[$key] = __($filter_pillar_product_type_control[$key], true);
			}

		}
		$filter_pillar_product_type_control = $filter_pillar_product_type_control_new;

		$this->set('filter_pillar_product_type_control', $filter_pillar_product_type_control);

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

// generazione filtri 'linear' dinamici ...
		$filter_linear_product_type_control = array();

// elenco associazioni control / linear
		$association_fields = 'ProductsAssociation.product_code_from';
		$association_conditions = array();
		$association_conditions['ProductsAssociation.product_line_from'] = 'linear';
		$association_conditions['ProductsAssociation.product_line_to'] = 'control';
		$association_order = 'ProductsAssociation.product_code_from';

		$associations = $this->ProductsAssociation->find('all', array('fields' => 'DISTINCT '.$association_fields, 'conditions' => $association_conditions, 'order' => $association_order));
//pr('ProductsAssociation');
//pr($associations);

			foreach ($associations as $key => $value) {
//pr($value);
				$filter_linear_product_type_control[$value['ProductsAssociation']['product_code_from']] = $value['ProductsAssociation']['product_code_from'];
			}

//pr('// generazione filtri \'linear\' dinamici ...');
//pr($filter_linear_product_type_control);


		$filter_linear_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
//pr($conditions);
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c input ' . $key_c);
			if (strpos($key_c, 'linear') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp input');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_linear_product_type_control as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];

//				if ( ($value[$model_name]['code'] == $key_ctrl) && ($products_code_ctrl != $products_code) ) {
//pr('$key_ctrl ' . $key_ctrl);

					$tot_tmp = isset($filter_linear_product_type_exist[$key_ctrl]) ? $filter_linear_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_linear_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
//				}
			}
		}
// pr($filter_linear_product_type_exist);

		$filter_linear_product_type_control_new = array();
		foreach($filter_linear_product_type_exist as $key => $value) {
/*
			if ( $value ) {
				$filter_linear_product_type_control_new[$key] = __($filter_linear_product_type_control[$key], true) . ' (' . $value . ')';
			}
*/
			if ( $value ) {
				$filter_linear_product_type_control_new[$key] = __($filter_linear_product_type_control[$key], true);
			}

		}
		$filter_linear_product_type_control = $filter_linear_product_type_control_new;

		$this->set('filter_linear_product_type_control', $filter_linear_product_type_control);

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

	}


////////////////////////////////////////////////////////////////////
// CODE_PRODUCT_TYPE_ACCESSORY
////////////////////////////////////////////////////////////////////
	function _init_search_criteria_accessory($conditions, $order, $model_name) {
/*
pr('$conditions');
pr($conditions);
pr('$order');
pr($order);
pr('$model_name');
pr($model_name);
exit();
*/


	// generazione filtri 'power' dinamici ...
		$filter_power_product_type_accessory = array();
		$filter_power_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c power ' . $key_c);
			if (strpos($key_c, 'power') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp power');
//pr($conditions_tmp);

		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));
//pr($products_list_for_search);

		foreach($products_list_for_search as $key_ctrl => $value_ctrl) {
			if (empty($filter_power_product_type_accessory[$value_ctrl['ProductsAccessory']['power']])) {
				$filter_power_product_type_accessory[$value_ctrl['ProductsAccessory']['power']] = $value_ctrl['ProductsAccessory']['power'];
			}
		}
		ksort($filter_power_product_type_accessory, SORT_STRING);
		reset($filter_power_product_type_accessory);

		foreach($filter_power_product_type_accessory as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
//				if ( ($value[$model_name]['power'] >= $key_ctrl) && ($products_code_ctrl != $products_code) ) {
				if ( ($value[$model_name]['power'] == $key_ctrl) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_power_product_type_exist[$key_ctrl]) ? $filter_power_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_power_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_power_product_type_accessory_new = array();
		foreach($filter_power_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_power_product_type_accessory_new[$key] = __($filter_power_product_type_accessory[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_power_product_type_accessory = $filter_power_product_type_accessory_new;

		$this->set('filter_power_product_type_accessory', $filter_power_product_type_accessory);


	// generazione filtri 'channels' dinamici ...
		$filter_channels_product_type_accessory = array();
		$filter_channels_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c channels ' . $key_c);
			if (strpos($key_c, 'channels') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp channels');
//pr($conditions_tmp);

		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));
//pr($products_list_for_search);

		foreach($products_list_for_search as $key_ctrl => $value_ctrl) {
			if (empty($filter_channels_product_type_accessory[$value_ctrl['ProductsAccessory']['channels']])) {
				$filter_channels_product_type_accessory[$value_ctrl['ProductsAccessory']['channels']] = $value_ctrl['ProductsAccessory']['channels'];
			}
		}
		ksort($filter_channels_product_type_accessory, SORT_STRING);
		reset($filter_channels_product_type_accessory);

		foreach($filter_channels_product_type_accessory as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
//				if ( ($value[$model_name]['channels'] >= $key_ctrl) && ($products_code_ctrl != $products_code) ) {
				if ( ($value[$model_name]['channels'] == $key_ctrl) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_channels_product_type_exist[$key_ctrl]) ? $filter_channels_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_channels_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_channels_product_type_accessory_new = array();
		foreach($filter_channels_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_channels_product_type_accessory_new[$key] = __($filter_channels_product_type_accessory[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_channels_product_type_accessory = $filter_channels_product_type_accessory_new;

		$this->set('filter_channels_product_type_accessory', $filter_channels_product_type_accessory);


	// generazione filtri 'type_of_protection' dinamici ...
		$filter_type_of_protection_product_type_accessory = array();
		$filter_type_of_protection_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c type_of_protection ' . $key_c);
			if (strpos($key_c, 'type_of_protection') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp type_of_protection');
//pr($conditions_tmp);

		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));
//pr($products_list_for_search);

		foreach($products_list_for_search as $key_ctrl => $value_ctrl) {
			if (empty($filter_type_of_protection_product_type_accessory[$value_ctrl['ProductsAccessory']['type_of_protection']])) {
				$filter_type_of_protection_product_type_accessory[$value_ctrl['ProductsAccessory']['type_of_protection']] = $value_ctrl['ProductsAccessory']['type_of_protection'];
			}
		}
		ksort($filter_type_of_protection_product_type_accessory, SORT_STRING);
		reset($filter_type_of_protection_product_type_accessory);

		foreach($filter_type_of_protection_product_type_accessory as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
//				if ( ($value[$model_name]['type_of_protection'] >= $key_ctrl) && ($products_code_ctrl != $products_code) ) {
				if ( ($value[$model_name]['type_of_protection'] == $key_ctrl) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_type_of_protection_product_type_exist[$key_ctrl]) ? $filter_type_of_protection_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_type_of_protection_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_type_of_protection_product_type_accessory_new = array();
		foreach($filter_type_of_protection_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_type_of_protection_product_type_accessory_new[$key] = __($filter_type_of_protection_product_type_accessory[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_type_of_protection_product_type_accessory = $filter_type_of_protection_product_type_accessory_new;

		$this->set('filter_type_of_protection_product_type_accessory', $filter_type_of_protection_product_type_accessory);


	// generazione filtri 'colour' dinamici ...
		$filter_colour_product_type_accessory = array();
		$filter_colour_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c colour ' . $key_c);
			if (strpos($key_c, 'colour') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp colour');
//pr($conditions_tmp);

		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));
//pr($products_list_for_search);

		foreach($products_list_for_search as $key_ctrl => $value_ctrl) {
			if (empty($filter_colour_product_type_accessory[$value_ctrl['ProductsAccessory']['colour']])) {
				$filter_colour_product_type_accessory[$value_ctrl['ProductsAccessory']['colour']] = $value_ctrl['ProductsAccessory']['colour'];
			}
		}
		ksort($filter_colour_product_type_accessory, SORT_STRING);
		reset($filter_colour_product_type_accessory);

		foreach($filter_colour_product_type_accessory as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];
//				if ( ($value[$model_name]['colour'] >= $key_ctrl) && ($products_code_ctrl != $products_code) ) {
				if ( ($value[$model_name]['colour'] == $key_ctrl) && ($products_code_ctrl != $products_code) ) {
					$tot_tmp = isset($filter_colour_product_type_exist[$key_ctrl]) ? $filter_colour_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_colour_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
				}
			}
		}

		$filter_colour_product_type_accessory_new = array();
		foreach($filter_colour_product_type_exist as $key => $value) {
			if ( $value ) {
				$filter_colour_product_type_accessory_new[$key] = __($filter_colour_product_type_accessory[$key], true) . ' (' . $value . ')';
			}
		}
		$filter_colour_product_type_accessory = $filter_colour_product_type_accessory_new;

		$this->set('filter_colour_product_type_accessory', $filter_colour_product_type_accessory);


/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

// generazione filtri 'pillar' dinamici ...
		$filter_pillar_product_type_accessory = array();

// elenco associazioni accessory / pillar
		$association_fields = 'ProductsAssociation.product_code_from';
		$association_conditions = array();
		$association_conditions['ProductsAssociation.product_line_from'] = 'pillar';
		$association_conditions['ProductsAssociation.product_line_to'] = 'accessories';
		$association_order = 'ProductsAssociation.product_code_from';

		$associations = $this->ProductsAssociation->find('all', array('fields' => 'DISTINCT '.$association_fields, 'conditions' => $association_conditions, 'order' => $association_order));
//pr('ProductsAssociation');
//pr($associations);

			foreach ($associations as $key => $value) {
//pr($value);
				$filter_pillar_product_type_accessory[$value['ProductsAssociation']['product_code_from']] = $value['ProductsAssociation']['product_code_from'];
			}

//pr('// generazione filtri \'pillar\' dinamici ...');
//pr($filter_pillar_product_type_accessory);


		$filter_pillar_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
//pr($conditions);
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c input ' . $key_c);
			if (strpos($key_c, 'pillar') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp input');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_pillar_product_type_accessory as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];

//				if ( ($value[$model_name]['code'] == $key_ctrl) && ($products_code_ctrl != $products_code) ) {
//pr('$key_ctrl ' . $key_ctrl);

					$tot_tmp = isset($filter_pillar_product_type_exist[$key_ctrl]) ? $filter_pillar_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_pillar_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
//				}
			}
		}
// pr($filter_pillar_product_type_exist);

		$filter_pillar_product_type_accessory_new = array();
		foreach($filter_pillar_product_type_exist as $key => $value) {
/*
			if ( $value ) {
				$filter_pillar_product_type_accessory_new[$key] = __($filter_pillar_product_type_accessory[$key], true) . ' (' . $value . ')';
			}
*/
			if ( $value ) {
				$filter_pillar_product_type_accessory_new[$key] = __($filter_pillar_product_type_accessory[$key], true);
			}

		}
		$filter_pillar_product_type_accessory = $filter_pillar_product_type_accessory_new;

		$this->set('filter_pillar_product_type_accessory', $filter_pillar_product_type_accessory);

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

// generazione filtri 'linear' dinamici ...
		$filter_linear_product_type_accessory = array();

// elenco associazioni accessory / linear
		$association_fields = 'ProductsAssociation.product_code_from';
		$association_conditions = array();
		$association_conditions['ProductsAssociation.product_line_from'] = 'linear';
		$association_conditions['ProductsAssociation.product_line_to'] = 'accessories';
		$association_order = 'ProductsAssociation.product_code_from';

		$associations = $this->ProductsAssociation->find('all', array('fields' => 'DISTINCT '.$association_fields, 'conditions' => $association_conditions, 'order' => $association_order));
//pr('ProductsAssociation');
//pr($associations);

			foreach ($associations as $key => $value) {
//pr($value);
				$filter_linear_product_type_accessory[$value['ProductsAssociation']['product_code_from']] = $value['ProductsAssociation']['product_code_from'];
			}

//pr('// generazione filtri \'linear\' dinamici ...');
//pr($filter_linear_product_type_accessory);


		$filter_linear_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
//pr($conditions);
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c input ' . $key_c);
			if (strpos($key_c, 'linear') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp input');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_linear_product_type_accessory as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];

//				if ( ($value[$model_name]['code'] == $key_ctrl) && ($products_code_ctrl != $products_code) ) {
//pr('$key_ctrl ' . $key_ctrl);

					$tot_tmp = isset($filter_linear_product_type_exist[$key_ctrl]) ? $filter_linear_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_linear_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
//				}
			}
		}
// pr($filter_linear_product_type_exist);

		$filter_linear_product_type_accessory_new = array();
		foreach($filter_linear_product_type_exist as $key => $value) {
/*
			if ( $value ) {
				$filter_linear_product_type_accessory_new[$key] = __($filter_linear_product_type_accessory[$key], true) . ' (' . $value . ')';
			}
*/
			if ( $value ) {
				$filter_linear_product_type_accessory_new[$key] = __($filter_linear_product_type_accessory[$key], true);
			}

		}
		$filter_linear_product_type_accessory = $filter_linear_product_type_accessory_new;

		$this->set('filter_linear_product_type_accessory', $filter_linear_product_type_accessory);

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

// generazione filtri 'control' dinamici ...
		$filter_control_product_type_accessory = array();

// elenco associazioni accessory / control
		$association_fields = 'ProductsAssociation.product_code_from';
		$association_conditions = array();
		$association_conditions['ProductsAssociation.product_line_from'] = 'control';
		$association_conditions['ProductsAssociation.product_line_to'] = 'accessories';
		$association_order = 'ProductsAssociation.product_code_from';

		$associations = $this->ProductsAssociation->find('all', array('fields' => 'DISTINCT '.$association_fields, 'conditions' => $association_conditions, 'order' => $association_order));
//pr('ProductsAssociation');
//pr($associations);

			foreach ($associations as $key => $value) {
//pr($value);
				$filter_control_product_type_accessory[$value['ProductsAssociation']['product_code_from']] = $value['ProductsAssociation']['product_code_from'];
			}

//pr('// generazione filtri \'control\' dinamici ...');
//pr($filter_control_product_type_accessory);


		$filter_control_product_type_exist = array();

	// escludo dai criteri di ricerca il filtro selezionato
		$conditions_tmp = $conditions;
//pr($conditions);
		foreach($conditions_tmp as $key_c => $value_c) {
//pr('$key_c input ' . $key_c);
			if (strpos($key_c, 'control') !== false) {
				unset($conditions_tmp[$key_c]);
			}
		}
//pr('$conditions_tmp input');
//pr($conditions_tmp);
		$products_list_for_search = $this->$model_name->find('all', array('conditions' => $conditions_tmp, 'order' => $order));

		foreach($filter_control_product_type_accessory as $key_ctrl => $value_ctrl) {
			$products_code_ctrl = '';
			foreach($products_list_for_search as $key => $value) {
				$products_code = $value[$model_name]['code'];

//				if ( ($value[$model_name]['code'] == $key_ctrl) && ($products_code_ctrl != $products_code) ) {
//pr('$key_ctrl ' . $key_ctrl);

					$tot_tmp = isset($filter_control_product_type_exist[$key_ctrl]) ? $filter_control_product_type_exist[$key_ctrl] : 0;
					$tot_tmp ++;
					$filter_control_product_type_exist[$key_ctrl] = $tot_tmp;
					$products_code_ctrl = $products_code;
//				}
			}
		}
// pr($filter_control_product_type_exist);

		$filter_control_product_type_accessory_new = array();
		foreach($filter_control_product_type_exist as $key => $value) {
/*
			if ( $value ) {
				$filter_control_product_type_accessory_new[$key] = __($filter_control_product_type_accessory[$key], true) . ' (' . $value . ')';
			}
*/
			if ( $value ) {
				$filter_control_product_type_accessory_new[$key] = __($filter_control_product_type_accessory[$key], true);
			}

		}
		$filter_control_product_type_accessory = $filter_control_product_type_accessory_new;

		$this->set('filter_control_product_type_accessory', $filter_control_product_type_accessory);

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

	}


	function _my_rawUrlDecode ($my_string) {
        $my_string = rawUrlDecode($my_string);
		$my_string = str_replace ('|--|', '/', $my_string);
		$my_string = str_replace ('-||-', '#', $my_string);
		return $my_string;
	}

	function _my_rawUrlEncode ($my_string) {
		$my_string = str_replace ('/', '|--|', $my_string);
		$my_string = str_replace ('#', '-||-', $my_string);
        $my_string = rawUrlEncode($my_string);
		return $my_string;
	}


}

?>
<?php
require_once '/htdocs/public/www/actselector/app/controllers/public_controller.php';

class SvilController extends PublicController {

	var $name = 'Public'; //test commit pippo
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
        //ordinamento
        $indici = array();
        foreach ($products_list as $key=>$value){
           $indici[$value['ProductsLinearsvil']['code']][]=$value;
        }
        ksort($indici);
        
        $products_list = array();
        foreach ($indici as $key=>$value){
            $products_list[] = $value[0];
        }
        
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
    
    public function products_compare_selectsvil()
    {
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
				case CODE_PRODUCT_TYPE_LINEAR:{
					$model_name = 'ProductsLinearsvil';
				}
					break;
				case CODE_PRODUCT_TYPE_CONTROL:
					$model_name = 'ProductsControl';
					break;
				 
				default:
			}
			
			$conditions = $this->Session->read($model_name.'.conditions');
			if ($compare_family==CODE_PRODUCT_TYPE_LINEAR){
			    $conditions[] = array("OR"=>array(
			        $model_name.'.code' => $code,
			        $model_name.'.code_description' => $code
			    ));
			}else{
			    $conditions[$model_name.'.code'] = $code;
			}
			
			
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
  function products_compare_viewsvil () {
  
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
}

?>
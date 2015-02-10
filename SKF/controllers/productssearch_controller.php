<?php
class ProductssearchController extends AppController {

	var $name = 'Public';
	var $uses = array(
		'ProductsPillar',
		'ProductsLinear',
		'ProductsRotary',
		'ProductsControl',
		'ProductsAccessory',
		'ProductsAssociation',
	    'Voltage'
	);
	
	public $arrayModel = array('ProductsPillar',
		'ProductsLinear',
		'ProductsRotary',
		'ProductsControl',
		'ProductsAccessory');
	
	
	
	var $page_selected = null;
    
    function products_search(){
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
    
    private function getFieldsByModelName($modelName){
        $fields = array();
        switch ($modelName){
        	case 'ProductsLinear':{
        	    $fields = array('load','pull_load','speed','stroke','retracted_length','voltage','power_consumption',
        	                    'current_consumption','duty','ambient_temp','type_of_protection','application_medi','weight','image');
        	}
        	break;
        	default:{
        	    $fields = array('*');
        	}
            
        }
        return $fields;
        
    }
    
    public function productDetails(){
        $result = array();
        $res = array();
        $modelName = $this->params['form']['modelName'];
        $folderImage = $this->params['form']['folderImage'];
        $condition = array();
        $codId = $this->params['form']['codId'];
        $fields = $this->getFieldsByModelName($modelName);
        if ($modelName == "ProductsAccessory"){
            $fields[] = 'code AS code_id';
            $condition['code'] = $codId;
        }else{
            $condition['code_id'] = $codId;
        }
        $result = $this->getResult('all',$modelName, $condition,$fields);
        $res = $this->cleanResult($modelName, $result,$folderImage);
        echo json_encode(array("data"=>$res,"count"=>count($res)));
        die;
        
        
    }
    
    
    
    
    function ajaxCall(){
    $result = array();
    $ret  = array();

        switch ($this->params['form']['modelName']){
            
        	case 'ProductsPillar':{
        	    $modelName = $this->params['form']['modelName'];
        	    $condition['certificato'] = $this->params['form']['medical'];
        	    $condition['type'] = !empty($this->params['form']['voltaggio']) && $this->params['form']['voltaggio']!='nm' ?strtoupper($this->params['form']['voltaggio']):null;
        	    $totalResult = $this->$modelName->find('count', array('conditions' => $condition));
        	    $fields = array('code_id');
        	    $order = array('code_id');
        	    $result = $this->getResult('all',$modelName, $condition,$fields, $order,$this->params['form']['page']);
        	    $folderImage='pillar';
        	    $ret = $this->cleanResult($modelName, $result,$folderImage);
        	}
        	break;
        	case 'ProductsLinear':{
        	    $modelName = $this->params['form']['modelName'];
        	    $condition['certificato'] = $this->params['form']['medical'];
        	    $condition['type'] = !empty($this->params['form']['voltaggio']) && $this->params['form']['voltaggio']!='nm'?strtoupper($this->params['form']['voltaggio']):null;
        	    $condition['optional_'. $this->params['form']['motor_shape']] = 1;
        	    $totalResult = $this->$modelName->find('count', array('conditions' => $condition));
        	    $fields = array('code_id');
        	    $order = array('code_id');
        	    $result = $this->getResult('all',$modelName, $condition,$fields, $order,$this->params['form']['page']);
        	    $folderImage='linear';
        	    $ret = $this->cleanResult($modelName, $result,$folderImage);
        	}
        	break;
        	
        	case 'ProductsControl':{
        	    $modelName = $this->params['form']['modelName'];
        	    $condition['type'] = !empty($this->params['form']['voltaggio']) && $this->params['form']['voltaggio']!='nm'?strtoupper($this->params['form']['voltaggio']):null;
        	    $totalResult = $this->$modelName->find('count', array('conditions' => $condition));
        	    $fields = array('code_id');
        	    $order = array('code_id');
        	    $result = $this->getResult('all',$modelName, $condition,$fields, $order,$this->params['form']['page']);
        	    $folderImage = 'control';
        	    $ret = $this->cleanResult($modelName, $result,$folderImage);
        	    }
           break;
           
           case 'ProductsAccessory':{
               $modelName = $this->params['form']['modelName'];
               $totalResult = $this->$modelName->find('count', array('conditions' => array()));
               $fields = array('code AS code_id');
               $order = array('code');
               $condition = array();
               $result = $this->getResult('all',$modelName, $condition,$fields, $order,$this->params['form']['page']);
               $folderImage = 'accessory';
               $ret = $this->cleanResult($modelName, $result,$folderImage);
           }
           break;
           case 'ProductsRotary':{
               $modelName = $this->params['form']['modelName'];
               $totalResult = $this->$modelName->find('count', array('conditions' => array()));
               $fields = array('code_id');
               $order = array('code');
               $condition = array();
               $result = $this->getResult('all',$modelName, $condition,$fields, $order,$this->params['form']['page']);
               $folderImage = 'rotary';
               $ret = $this->cleanResult($modelName, $result,$folderImage);
           }
           break;
           
           case 'All':{
               $totalResult = 0;
               $allResult = array();
               foreach ($this->arrayModel as $key=>$modelName){
                   $condition = array();
                   $fields = array('code_id');
                   $order = array('code_id');
                   if ($modelName == "ProductsAccessory"){
                       $fields = array('code AS code_id');
                       $condition['code like'] = '%'.strtoupper($this->params['form']['freeSearch']).'%';
                       $order = array('code');
                   }
                   else{
                       $condition['code_id like'] = '%'.strtoupper($this->params['form']['freeSearch']).'%';
                   }
                   $result = $this->getResult('all',$modelName, $condition,$fields, $order,1,1000);
                   $result = $this->cleanResult($modelName, $result); 
                   if ($result){
                       $allResult = array_merge($allResult,$result);
                   }
                   
               }
              
               $start = ($this->params['form']['page']-1)*10;
               
               for ($i=$start;$i<($start+10);$i++){
                   if (isset($allResult[$i])){
                       $ret[] = $allResult[$i];
                   }
                   else{
                       break;
                   }
               }
               $totalResult = count($allResult);
           }
           break;
           
           
        }
       
       
       echo json_encode(array("data"=>$ret,"count"=>$totalResult));
       die;
    
    }
    
	private function cleanResult($modelName,$result,$folderImage=''){
	    $ret = array();
	    foreach ($result as $key=>$value){
	        $value[$modelName]['modelName'] = $modelName;
	        $value[$modelName]['path_image'] = $folderImage;
	        $ret[] = $value[$modelName];
	    }
	   
	    return $ret;
	}
    private function getResult($type,$modelName,$conditions,$fields = array(),$order = array(),$page=1,$limit = 10){
        
        $res = array();
        if(is_object($this->$modelName) && method_exists($this->$modelName, 'find')){
            $res = $this->$modelName->find($type, array('conditions' => $conditions,'fields'=>$fields,'order'=>$order,'limit'=>$limit,'page'=>$page));
        }        
        return $res;
    }
}

?>
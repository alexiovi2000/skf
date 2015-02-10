<?php
/*
pr('$model_name');
pr($model_name);
*/
/*
pr('$product_list');
pr($product_list);
exit();
*/

$AR_PRODUCTS_FIELS = array();
$cont=0;

switch ($model_name) {
    case 'ProductsPillar':
        //Path immagine
        $product_path_image = 'pillar';
        //Array Campi
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'code_id';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.code_id', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'load';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.load', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'pull_load';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.pull_load', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'bending';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.bending', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'speed';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.speed', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'section';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.section', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'stroke';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.stroke', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'retracted_length_push';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.retracted_length_push', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'retracted_length_pull';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.retracted_length_pull', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'voltage';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.voltage', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'power';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.power', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'current';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.current', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'duty_cycle_intermittent';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.duty_cycle_intermittent', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'duty_cycle_short';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.duty_cycle_short', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'ambient_temp';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.ambient_temp', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'type_of_protection';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.type_of_protection', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'type_of_control';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.type_of_control', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'weight';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.weight', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'footprint';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.footprint', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'certificato';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.certificato', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'file_drawing';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('view product drawing', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'file_pdf';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('view product pdf', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'link';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('view product detail', true);
        break;
    case 'ProductsLinear':
        //Path immagine
        $product_path_image = 'linear';
        //Array Campi
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'code_id';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.code_id', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'load';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.load', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'pull_load';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.pull_load', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'speed';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.speed', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'stroke';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.stroke', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'retracted_length';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.retracted_length', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'voltage';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.voltage', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'power_consumption';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.power_consumption', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'current_consumption';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.current_consumption', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'duty';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.duty', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'ambient_temp';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.ambient_temp', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'type_of_protection';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.type_of_protection', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'certificato';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.certificato', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'weight';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.weight', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'file_drawing';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('view product drawing', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'file_pdf';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('view product pdf', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'link';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('view product detail', true);
        break;
    case 'ProductsControl':
        //Path immagine
        $product_path_image = 'control';
        //Array Campi
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'code_id';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.code_id', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'motor';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.motor', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'operating_device_ports';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.operating_device_ports', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'battery_ports';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.battery_ports', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'limit_switch_ports';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.limit_switch_ports', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'single_fault_safety';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.single_fault_safety', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'encoder_processing';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.encoder_processing', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'input';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.input', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'frequency';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.frequency', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'input_current_max';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.input_current_max', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'standby_power';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.standby_power', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'output_voltage';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.output_voltage', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'output';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.output', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'duty_cycle_intermittent';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.duty_cycle_intermittent', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'duty_cycle_short_time';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.duty_cycle_short_time', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'ambient_temperature';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.ambient_temperature', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'humidity';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.humidity', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'type_of_protection';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.type_of_protection', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'approvals';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.approvals', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'weight_without_battery';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.weight_without_battery', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'file_drawing';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('view product drawing', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'file_pdf';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('view product pdf', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'link';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('view product detail', true);
        break;
        
        case 'ProductsLinearsvil':{
          //Path immagine
        $product_path_image = 'linear';
        //Array Campi
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'code_id';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.code_id', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'load';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.load', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'pull_load';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.pull_load', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'speed';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.speed', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'stroke';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.stroke', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'retracted_length';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.retracted_length', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'voltage';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.voltage', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'power_consumption';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.power_consumption', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'current_consumption';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.current_consumption', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'duty';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.duty', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'ambient_temp';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.ambient_temp', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'type_of_protection';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.type_of_protection', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'certificato';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.certificato', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'weight';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.weight', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'file_drawing';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('view product drawing', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'file_pdf';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('view product pdf', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'link';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('view product detail', true);
        break;
        
        
        
        }
   
}

//Contenitore
echo '<div class="container_table_compare_product">';

    //Div con elenco labels
    echo '<div class="columns column-labels">';
        echo '<ul>';
        $righeAlternate=0;
        foreach($AR_PRODUCTS_FIELS as $key_fields => $value_fields) {
            $righeAlternate=1-$righeAlternate; //Righe ALTERNATE
            $str_class = '';
            if ($righeAlternate) $str_class='row-even';
            echo '<li class="row-legacy '.$str_class.'"><p>'.$value_fields['label'].'</p></li>';
        }        
        echo '</ul>';
    echo '</div>';
    
    
    //Div con contenitore prodotti
    echo '<div class="column-products">';
    foreach($product_list as $key => $value) {        
        echo '<div class="columns columns_product clearfix">';
        
            echo '<ul>';
            
                //Intestazione
                echo '<li class="row-header">';
                    
                    //Titolo
                    echo '<div class="row-title">';
                        echo '<h3>'.$value[$model_name]['code'].'</h3>';
                    echo '</div>';
                    
                    //Immagine
                    if ($value[$model_name]['image']) {
                        echo '<div class="row-image">';
        				$img_path = IMAGES . 'skf_products_image' . DS . $product_path_image . DS . $value[$model_name]['image'];
        				$img_url = '/img/skf_products_image/'.$product_path_image.'/'.$value[$model_name]['image'];
        				if ( file_exists($img_path) && is_file($img_path) ) {
        					$img_url = str_replace ( DS , '/' , $img_url );
        					$title = $alt = '';
        					$img = '<img src="' . $html->webroot('image.php') . '?width=' . MAX_WIDTH_IMAGE_PRODUCT_PREVIEW . '&amp;height=' . MAX_HEIGHT_IMAGE_PRODUCT_PREVIEW . '&amp;cropratio=' . MAX_WIDTH_IMAGE_PRODUCT_PREVIEW . ':' . MAX_HEIGHT_IMAGE_PRODUCT_PREVIEW . '&amp;quality=' . IMAGE_RESIZE_QUALITY . '&amp;image=' . $img_url . '" alt="' . $alt . '" title="' . $title . '" border="0" />';
        					echo($img);
        				}
                        echo '</div>';
        			}
                    
                echo '</li>';
                
                //Elenco Altri campi
                $righeAlternate=0;
                foreach($AR_PRODUCTS_FIELS as $key_fields => $value_fields) {
                    $righeAlternate=1-$righeAlternate; //Righe ALTERNATE
                    $str_class = '';
                    if ($righeAlternate) $str_class='row-even';
                    
                    switch ($value_fields['field']) {
                        case 'file_drawing':
                            echo '<li class="row-legacy '.$str_class.'"><p><a href="'.SITE_WEBROOT_URL.'app/webroot/img/skf_products_image_drw/'.$product_path_image.'/'. $value[$model_name]['file_drawing'] . '" target="_blank">'.$html -> image('/img/picture.png', array('width' => 16, 'height' => 16, 'alt' => __('view product drawing', true), 'title' => __('view product drawing', true))).'</a></p></li>';
                        break;
                        case 'file_pdf':
                            echo '<li class="row-legacy '.$str_class.'"><p><a href="'. $value[$model_name]['file_pdf'] . '" target="_blank">'.$html -> image('/img/application_link.png', array('width' => 16, 'height' => 16, 'alt' => __('view product pdf', true), 'title' => __('view product pdf', true))).'</a></p></li>';
                        break;
                        case 'link':
                            echo '<li class="row-legacy '.$str_class.'"><p><a href="'. $value[$model_name]['link'] . '" target="_blank">'.$html -> image('/img/application_link.png', array('width' => 16, 'height' => 16, 'alt' => __('view product detail', true), 'title' => __('view product detail', true))).'</a></p></li>';
                        break;
                        default:
                            echo '<li class="row-legacy '.$str_class.'"><p>'.$value[$model_name][$value_fields['field']].'</p></li>';
                        break;
                    }
                }
                        
            echo '</ul>';
        
        echo '</div>';
    }
    echo '</div>';
    
?>
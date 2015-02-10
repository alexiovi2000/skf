<?php
/*
pr($accessories_list);
*/
$AR_PRODUCTS_FIELS = array();
$cont=0;
//Path immagine
$product_path_image = 'accessory';
$model_name = 'ProductsAccessory';
//Array Campi
$AR_PRODUCTS_FIELS[$cont]['field'] = 'code';
$AR_PRODUCTS_FIELS[$cont]['label'] = __('Accesssory.Product.code', true);
$cont++;
$AR_PRODUCTS_FIELS[$cont]['field'] = 'power';
$AR_PRODUCTS_FIELS[$cont]['label'] = __('Accessory.Product.power', true);
$cont++;
$AR_PRODUCTS_FIELS[$cont]['field'] = 'channels';
$AR_PRODUCTS_FIELS[$cont]['label'] = __('Accessory.Product.channels', true);
$cont++;
$AR_PRODUCTS_FIELS[$cont]['field'] = 'type_of_protection';
$AR_PRODUCTS_FIELS[$cont]['label'] = __('Accessory.Product.type_of_protection', true);
$cont++;
$AR_PRODUCTS_FIELS[$cont]['field'] = 'colour';
$AR_PRODUCTS_FIELS[$cont]['label'] = __('Accessory.Product.colour', true);

//Calcolo dimensioni contenitore in base al numero di prodotti presenti
$maxwidth = 215;
foreach($accessories_list as $key => $value) { 
    $maxwidth += 180;
}

//Contenitore
echo '<div class="container_table_accessories">';
echo '<div class="container_table_accessories2" style="width:'.$maxwidth.'px;">';
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
    foreach($accessories_list as $key => $value) {        
        echo '<div class="columns columns_product clearfix">';
        
            echo '<ul>';
            
                //Intestazione
                echo '<li class="row-header">';
                    
                    //Titolo
                    echo '<div class="row-title">';
                        echo '<h3>'.$value[$model_name]['code'].'</h3>';
                    echo '</div>';
                    
                    //Immagine
                    if ($value[$model_name]['img']) {
                        echo '<div class="row-image">';
        				$img_path = IMAGES . 'skf_products_image' . DS . $product_path_image . DS . $value[$model_name]['img'];
        				$img_url = '/img/skf_products_image/'.$product_path_image.'/'.$value[$model_name]['img'];
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
                    echo '<li class="row-legacy '.$str_class.'"><p>'.$value[$model_name][$value_fields['field']].'</p></li>';
                }
                        
            echo '</ul>';
        
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
?>
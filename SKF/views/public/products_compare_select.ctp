<?php
/*
pr('$model_name');
pr($model_name);

pr('$product_list');
pr($product_list);
exit();
*/

$AR_PRODUCTS_FIELS = array();
$cont=0;

switch ($model_name) {
    case 'ProductsPillar':
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'code_id';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.code_id', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'pull_load';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.pull_load', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'section';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.section', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'retracted_length_push';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.retracted_length_push', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'retracted_length_pull';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Pillar.Product.retracted_length_pull', true);
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
        break;
    case 'ProductsLinear':
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'code_id';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.code_id', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'pull_load';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.pull_load', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'retracted_length';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.retracted_length', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'power_consumption';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.power_consumption', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'current_consumption';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.current_consumption', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'ambient_temp';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.ambient_temp', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'type_of_protection';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.type_of_protection', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'weight';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Linear.Product.weight', true);
        break;
    case 'ProductsControl':
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'code_id';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.code_id', true);
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
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'frequency';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.frequency', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'input_current_max';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.input_current_max', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'standby_power';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.standby_power', true);
        $cont++;
        $AR_PRODUCTS_FIELS[$cont]['field'] = 'code_id';
        $AR_PRODUCTS_FIELS[$cont]['label'] = __('Control.Product.output_voltage', true);
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
        break;
}

//Apertura contenitore tabella
echo '<div class="container_table_product_select">';
if (count($product_list)>0) {

    echo '<table width="100%" class="table_product_select">';

        //Intestazione tabella
        echo '<thead>';
        echo '<tr>';
        echo '<th class="product_checkbox">&nbsp;</th>'; //cella vuota per checkbox
        foreach($AR_PRODUCTS_FIELS as $key_fields => $value_fields) {
            echo '<th>'.$value_fields['label'].'</th>';
        }
        echo '</tr>';
        echo '</thead>';

        //Righe Tabella
        echo '<tbody>';
        foreach($product_list as $key => $value) {

        	$checked = ($value[$model_name]['code_id'] == $value_selected) ? ' checked = "checked"' : '';

        	echo '<tr>';

            echo '<td class="product_checkbox"><input type="radio" name="' . $model_name . '_radio" id="' . $model_name . '_' . $value[$model_name]['code_id'] . '" value="' . $value[$model_name]['code_id'] . '" ' . $checked . '></td>';
        	foreach($AR_PRODUCTS_FIELS as $key_fields => $value_fields) {
        	   if ($value_fields['field']=='code_id'){
        	       echo '<td><label for="' . $model_name . '_' . $value[$model_name][$value_fields['field']] . '" class="product_code_id">'.$value[$model_name][$value_fields['field']].'</label></td>';
        	   }else{
        	       echo '<td>'.$value[$model_name][$value_fields['field']].'</td>';
        	   }
     	    }

        	echo '</tr>';
        }
        echo '</tbody>';

    echo '</table>';

}else{
    echo('<br /><h4>'.__('Record not found', true).'</h4>');
}


//Valore di default (non selezione)
$checked = (-1 == $value_selected) ? ' checked = "checked"' : '';
echo '<div style="display:none;">';
echo '<input type="radio" name="' . $model_name . '_radio" id="' . $model_name . '" value="-1" ' . $checked . '>';
//echo '<label for="' . $model_name . '_' . $value[$model_name]['code_id'] . '">code_id: ' . 'no detail product'. '</label>';
echo '</div>';

echo '</div>';
?>
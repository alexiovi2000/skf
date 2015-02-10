<div class="column_sx">
<div class="box_search">
    <div class="box_search_title"><?php echo __('box search title', true); ?></div>
<?php
    echo $this->MyForm->create('Product',array('id' => 'search_form', 'url' => '/'.$product_type_slug));

    $img_help = $html -> image('/img/info.png', array('width' => 16, 'height' => 16, 'alt' =>__('help',true), 'id' =>'ControlProductMotor', 'class' =>'img_help_inline', 'title' => __('help',true)));
	echo $this->MyForm->input('motor', array('label' => __('Control.Product.motor', true), 'options' => $filter_motor_product_type_control, 'selected' => $motor_selected, 'empty' => __('all', true), 'before' => $img_help));

    $img_help = $html -> image('/img/info.png', array('width' => 16, 'height' => 16, 'alt' =>__('help',true), 'id' =>'ControlProductOutput', 'class' =>'img_help_inline', 'title' => __('help',true)));
    echo $this->MyForm->input('output', array('label' => __('Control.Product.output', true), 'options' => $filter_output_product_type_control, 'selected' => $output_selected, 'empty' => __('all', true), 'before' => $img_help));

    $img_help = $html -> image('/img/info.png', array('width' => 16, 'height' => 16, 'alt' =>__('help',true), 'id' =>'ControlProductInput', 'class' =>'img_help_inline', 'title' => __('help',true)));
	echo $this->MyForm->input('input', array('label' => __('Control.Product.input', true), 'options' => $filter_input_product_type_control, 'selected' => $input_selected, 'empty' => __('all', true), 'before' => $img_help));

    $img_help = $html -> image('/img/info.png', array('width' => 16, 'height' => 16, 'alt' =>__('help',true), 'id' =>'ControlProductFunctionality', 'class' =>'img_help_inline', 'title' => __('help',true)));
	echo $this->MyForm->input('functionality', array('label' => __('Control.Product.functionality', true), 'options' => $filter_functionality_product_type_control, 'selected' => $functionality_selected, 'empty' => __('all', true), 'before' => $img_help));

    echo $this->MyForm->input('application', array('label' => __('Control.Product.application', true), 'options' => $filter_application_product_type_control, 'selected' => $application_selected, 'empty' => __('all', true)));

	echo $this->MyForm->submit(__('Reset form', true), array('type' => 'button', 'class' => 'btn', 'id' => 'reset_button'));

	echo $this->MyForm->end();
?>
</div>

<div class="box_product_association">
    <div class="box_product_association_title"><?php echo __('box product association title', true); ?></div>
<?php
    echo $this->MyForm->create('Product',array('id' => 'product_association_form', 'url' => '/'.$product_type_slug));

$disabled_tmp = '';
if ($linear_selected) {
	$disabled_tmp = 'disabled';
}
echo $this->MyForm->input('pillar', array('label' => __('Control.Product.pillar', true), 'options' => $filter_pillar_product_type_control, 'selected' => $pillar_selected, 'empty' => __('all', true), 'disabled' => $disabled_tmp));

$disabled_tmp = '';
if ($pillar_selected) {
	$disabled_tmp = 'disabled';
}
echo $this->MyForm->input('linear', array('label' => __('Control.Product.linear', true), 'options' => $filter_linear_product_type_control, 'selected' => $linear_selected, 'empty' => __('all', true), 'disabled' => $disabled_tmp));


	echo $this->MyForm->submit(__('Reset form', true), array('type' => 'button', 'class' => 'btn', 'id' => 'reset_button_association'));

	echo $this->MyForm->end();
?>
</div>
</div>
<div class="box_result">
<?php
//pr($products_list);
	$box_content = '';

	if (!empty($products_list)) {

		echo '<h2>' . __('tot products', true) . ' ' . $nav_pills_data[$product_type_id]['name'] . ': ' . count($products_list) . '</h2>';

$box_content .= $this->MyForm->create('Compare',array('id' => 'compare_form', 'url' => '/'.SLUG_PRODUCT_COMPARE_VIEW));
$box_content .= $this->MyForm->submit(__('Compare products selected', true), array('type' => 'submit', 'class' => 'btn btn_compare', 'id' => 'compare_button'));
$box_content .= $this->MyForm->input('model_name', array('type' => 'hidden', 'value' => $model_name));

		foreach($products_list as $product) {

			$box_content .= '<div class="box_product">'; //apro container per bordo img

            $box_content .= '<div class="box_product_border_image">';
			$application_tmp = '';
			if (isset($application_selected) && $application_selected == 'auto' && $product[$model_name]['application_auto']) {
				$application_tmp .= numbers_to_stars ($product[$model_name]['application_auto']);
			}
			if (isset($application_selected) && $application_selected == 'fobe' && $product[$model_name]['application_fobe']) {
				$application_tmp .= numbers_to_stars ($product[$model_name]['application_fobe']);
			}
			if (isset($application_selected) && $application_selected == 'medi' && $product[$model_name]['application_medi']) {
				$application_tmp .= numbers_to_stars ($product[$model_name]['application_medi']);
			}
			if (isset($application_selected) && $application_selected == 'buil' && $product[$model_name]['application_buil']) {
				$application_tmp .= numbers_to_stars ($product[$model_name]['application_buil']);
			}
			if (isset($application_selected) && $application_selected == 'heal' && $product[$model_name]['application_heal']) {
				$application_tmp .= numbers_to_stars ($product[$model_name]['application_heal']);
			}
			$box_content .= '<div class="box_product_application">';
			if ($application_tmp) {
				$box_content .= $application_tmp;;
			}
			$box_content .= '</div>';

			$box_content .= '<div class="box_product_image">';
			if ($product[$model_name]['image']) {
				$img_path = IMAGES . 'skf_products_image' . DS . $product_type_code . DS . $product[$model_name]['image'];
				$img_url = '/img/skf_products_image/'.$product_type_code.'/'.$product[$model_name]['image'];
				if ( file_exists($img_path) && is_file($img_path) ) {
					$img_url = str_replace ( DS , '/' , $img_url );
					$title = $alt = '';
					$img = '<img src="' . $html->webroot('image.php') . '?width=' . MAX_WIDTH_IMAGE_PRODUCT_PREVIEW . '&amp;height=' . MAX_HEIGHT_IMAGE_PRODUCT_PREVIEW . '&amp;cropratio=' . MAX_WIDTH_IMAGE_PRODUCT_PREVIEW . ':' . MAX_HEIGHT_IMAGE_PRODUCT_PREVIEW . '&amp;quality=' . IMAGE_RESIZE_QUALITY . '&amp;image=' . $img_url . '" alt="' . $alt . '" title="' . $title . '" border="0" />';
					$box_content .= $img;
				}
			}

/*------------------------------------------------------------------------------------*/
            /*Implementazione menu a tendina*/
            $box_content .= '<div class="box_up-down">
                                <div class="box_product_name">'.$product[$model_name]['code'].'</div>
                                <div class="box_product_arrow">
                                    '.$html -> image('/img/arrow.png', array('width' => 10, 'height' => 19, 'alt' => '', 'title' => '')).'
                                </div>
                                <div class="box_product_desc">
                                    <ul>';

            //QUOTED DRAWING
            if ($product[$model_name]['file_drawing']) {
				$box_content .= '<li><a href="'.SITE_WEBROOT_URL.'/app/webroot/img/skf_products_image_drw/'.$product_type_code.'/'. $product[$model_name]['file_drawing'] . '" rel="lightbox">' . __('view product drawing', true) . '</a></li>';
			}

            //TECHNICAL DATASHEET
            if ($product[$model_name]['file_pdf']) {
				$box_content .= '<li><a href="'. $product[$model_name]['file_pdf'] . '" target="_blank">' . __('view product pdf', true) . '</a></li>';
			}

            //PRODUCT DETAILS
			if ($product[$model_name]['link']) {
				$box_content .= '<li><a href="'. $product[$model_name]['link'] . '" target="_blank">' . __('view product detail', true) . '</a></li>';
			}

            //TODO: Gestire Associazione con gli accessories nuova famiglia di prodotto
			$counter_accessories = isset($product['related_accessories']) && is_array($product['related_accessories']) ? count($product['related_accessories']) : 0;
            if ($counter_accessories) {
//            	$code_tmp = $product[$model_name]['code'];
//            	$code_tmp = str_replace (' ', '_', $code_tmp);
//				$box_content .= '<li><a href="' . $html->url('/'.SLUG_PRODUCT_ACCESSORIES.'/'.$product_type_code.'/'.$code_tmp) . '" class="related_accessories" target="_blank">' . __('view product accessories', true) . '</a></li>';
				$box_content .= '<li><span class="link_view_accessories" onclick="open_modal_accessories(\'' . $product[$model_name]['code'] . '\'); return false;">' . __('view product accessories', true) . '</span></li>';
			}

			$box_content .= '		</ul>
                                </div>
                            </div>';
/*------------------------------------------------------------------------------------*/

			$box_content .= '</div>';
            $box_content .= '</div>'; //chiudo container per bordo img

/*------------------------------------------------------------------------------------*/
            /*Implementazionecheckbox compare*/
			$box_content .= '<div class="box_product_checkbox">';

			$value_tmp = null;
			$checked_tmp = null;
			$onclick_tmp = null;

			$counter_varianti = isset($product['related_values']) && is_array($product['related_values']) ? count($product['related_values']) : 0;

			if ($counter_varianti == 1) {
				$id_tmp = $product[$model_name]['code'];
				$label_tmp = __('view options detail', true);
				$value_tmp = $product['related_values'][0][$model_name]['code_id'];
				$checked_tmp = '';
				$onclick_tmp = '';
			} elseif ($counter_varianti > 1) {
				$id_tmp = $product[$model_name]['code'];
				$label_tmp = __('view options detail', true);
				$value_tmp = '-1';
				$checked_tmp = '';
				$onclick_tmp = 'select_product_detail(\'' . $product[$model_name]['code'] . '\', $(this));';
			}

			$id_tmp = str_replace (' ', '_', $id_tmp);

			$box_content .= $this->MyForm->input('code_id_'.$id_tmp, array('id' => 'CompareCodeId'.$id_tmp, 'type' => 'checkbox', 'label' => $label_tmp . ' ('.$counter_varianti.')', 'value' => $value_tmp, 'checked' => $checked_tmp, 'onclick' => $onclick_tmp));
			$box_content .= '</div>';
/*------------------------------------------------------------------------------------*/

			$box_content .= '</div>';

		}

$box_content .= $this->MyForm->end();

$box_content .= '<div id="dialog" title="">';
$box_content .= '';
$box_content .= '</div>';

	} else {

		$box_content .= '<h2>'.__('no product available', true).'</h2>';
		$box_content .= '<hr/>';

	}

	echo $box_content;
?>
</div>


<script type="text/javascript">
// <![CDATA[

//////////////////////////////////////
// form ricerca su attributi prodotti
	function init_form () {
		$('#search_form select').each(function() {
			$(this).bind('change', function() { send_form_data(); });
		});
		$('#reset_button').bind('click', function() { reset_form(); });
	}

	function reset_form () {
		$('#search_form select').each(function() {
			$(this).val('');
		});
		send_form_data ();
	}

	function send_form_data () {
		$('#search_form').submit();
		$('#spinner').show();
	}

	$(document).ready(function(){
		$('#search_form').submit( function () {
			$.post(
				$(this).attr('action'),
				$(this).serialize(),
				function(data){
					$('#product_container').html(data);
					$('#spinner').hide();
				}
			);
		return false;
		});
		init_form();
	});
//////////////////////////////////////


//////////////////////////////////////
// form ricerca su associazioni prodotti
	function init_form_association () {
		$('#product_association_form select').each(function() {
			$(this).bind('change', function() { send_form_data_association(); });
		});
		$('#reset_button_association').bind('click', function() { reset_form_association(); });
	}

	function reset_form_association () {
		$('#product_association_form select').each(function() {
			$(this).val('');
		});
		send_form_data_association ();
	}

	function send_form_data_association () {
		$('#product_association_form').submit();
		$('#spinner').show();
	}

	$(document).ready(function(){
		$('#product_association_form').submit( function () {
			$.post(
				$(this).attr('action'),
				$(this).serialize(),
				function(data){
					$('#product_container').html(data);
					$('#spinner').hide();
				}
			);
		return false;
		});
		init_form_association();
	});
//////////////////////////////////////

/*
//TODO: verificare gestione accessories

	function open_modal_accessories (code) {
		var compare_family = '<?php echo $product_type_code ?>';
		var my_dialog = $('<div>').dialog({
			width: 800,
			height: 500,
			autoOpen: false,
			modal: true,
			draggable: true,
			title: '<?php echo __('accessories related for product'); ?>' + ' ' + '<?php echo $nav_pills_data[$product_type_id]['name'] ?>' + ' ' + code,
			close: function (e, ui) { $(this).remove(); },
//		    close: function (e, ui) { $(this).dialog('destroy'); },
			buttons: {
				'<?php echo __('Close', true) ?>': function() {
					$( this ).dialog('close');
				}
			}
		});
		url = '<?php echo $html->url('/'.SLUG_PRODUCT_ACCESSORIES); ?>'+ '/' + rawUrlEncode(compare_family) + '/' + rawUrlEncode(code) + '/<?php echo time(); ?>';
		my_dialog.load(url).dialog('open');
        my_dialog.scrollTop("0");
	}

//TODO: verificare gestione accessories
*/

    $(document).ready(function(){
	//INSERIMENTO HELP IN LINEA
	    $( document ).tooltip({
	        items: "#ControlProductMotor, #ControlProductOutput, #ControlProductInput, #ControlProductFunctionality",
	        position: { my: "left+15 center", at: "right center" },
	        content: function() {
	            var element = $( this );
	            if ( element.is( "#ControlProductMotor" ) ) return "<?php echo __('Control.Product.motor.help', true); ?>";
	            if ( element.is( "#ControlProductOutput" ) ) return "<?php echo __('Control.Product.output.help', true); ?>";
	            if ( element.is( "#ControlProductInput" ) ) return "<?php echo __('Control.Product.input.help', true); ?>";
	            if ( element.is( "#ControlProductFunctionality" ) ) return "<?php echo __('Control.Product.functionality.help', true); ?>";
	        }
	    });
	// MENU A TENDINA
        $('.box_product').hover(function(){
        	$('.box_up-down', this).stop().animate({
        		bottom : '0px'
        	}, 300);
        	$('.box_product_arrow', this).fadeOut(300);
        }, function(){
        	$('.box_up-down', this).stop().animate({
        		bottom : '-67px'
        	}, 600);
        	$('.box_product_arrow', this).fadeIn(300);
        });
	});

// ]]>
</script>

<?php include('_js_product_list.ctp'); ?>
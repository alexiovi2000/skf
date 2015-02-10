<div class="box_search">
    <div class="box_search_title"><?php echo __('box search title', true); ?></div>
<?php
	echo $this->MyForm->create('Product',array('id' => 'search_form', 'url' => '/'.$product_type_slug));

    $img_help = $html -> image('/img/info.png', array('width' => 16, 'height' => 16, 'alt' =>__('help',true), 'id' =>'LinearProductLoad', 'class' =>'img_help_inline', 'title' => __('help',true)));
    echo $this->MyForm->input('load', array('label' => __('Linear.Product.load', true), 'options' => $filter_load_product_type_linear, 'selected' => $load_selected, 'empty' => __('all', true), 'before' => $img_help));

    $img_help = $html -> image('/img/info.png', array('width' => 16, 'height' => 16, 'alt' =>__('help',true), 'id' =>'LinearProductSpeed', 'class' =>'img_help_inline', 'title' => __('help',true)));
    echo $this->MyForm->input('speed', array('label' => __('Linear.Product.speed', true), 'options' => $filter_speed_product_type_linear, 'selected' => $speed_selected, 'empty' => __('all', true), 'before' => $img_help));

    $img_help = $html -> image('/img/info.png', array('width' => 16, 'height' => 16, 'alt' =>__('help',true), 'id' =>'LinearProductStroke', 'class' =>'img_help_inline', 'title' => __('help',true)));
    echo $this->MyForm->input('stroke', array('label' => __('Linear.Product.stroke', true), 'options' => $filter_stroke_product_type_linear, 'selected' => $stroke_selected, 'empty' => __('all', true), 'before' => $img_help));

    $img_help = $html -> image('/img/info.png', array('width' => 16, 'height' => 16, 'alt' =>__('help',true), 'id' =>'LinearProductDuty', 'class' =>'img_help_inline', 'title' => __('help',true)));
	echo $this->MyForm->input('duty', array('label' => __('Linear.Product.duty', true), 'options' => $filter_duty_product_type_linear, 'selected' => $duty_selected, 'empty' => __('all', true), 'before' => $img_help));

    $img_help = $html -> image('/img/info.png', array('width' => 16, 'height' => 16, 'alt' =>__('help',true), 'id' =>'LinearProductVoltage', 'class' =>'img_help_inline', 'title' => __('help',true)));
    echo $this->MyForm->input('voltage', array('label' => __('Linear.Product.voltage', true), 'options' => $filter_voltage_product_type_linear, 'selected' => $voltage_selected, 'empty' => __('all', true), 'before' => $img_help));

    echo $this->MyForm->input('application', array('label' => __('Linear.Product.application', true), 'options' => $filter_application_product_type_linear, 'selected' => $application_selected, 'empty' => __('all', true)));

    $img_help = $html -> image('/img/info.png', array('width' => 16, 'height' => 16, 'alt' =>__('help',true), 'id' =>'LinearProductCertificato', 'class' =>'img_help_inline', 'title' => __('help',true)));
	echo $this->MyForm->input('certificato', array('label' => __('Linear.Product.certificato', true), 'options' => $filter_certificato_product_type_linear, 'selected' => $certificato_selected, 'empty' => __('all', true), 'before' => $img_help));


    $img_help = $html -> image('/img/info.png', array('width' => 16, 'height' => 16, 'alt' =>__('help',true), 'id' =>'LinearProductSelfLocking', 'class' =>'img_help_inline', 'title' => __('help',true)));
	echo $this->MyForm->input('self_locking', array('label' => __('Linear.Product.self_locking', true), 'options' => $filter_self_locking_product_type_linear, 'selected' => $self_locking_selected, 'empty' => __('all', true), 'before' => $img_help, 'onchange' => 'openWindowPopupSelfLocking(this);'));


    $img_help = $html -> image('/img/info.png', array('width' => 16, 'height' => 16, 'alt' =>__('help',true), 'id' =>'LinearProductOptional', 'class' =>'img_help_inline', 'title' => __('help',true)));

//TODO: verificare select / checkbox
//	echo $this->MyForm->input('optional', array('label' => __('Linear.Product.optional', true), 'options' => $filter_optional_product_type_linear, 'selected' => $optional_selected, 'empty' => __('all', true)));
	echo $this->MyForm->input('optional', array('type' => 'select', 'multiple' =>'checkbox', 'label' => __('Linear.Product.optional', true), 'options' => $filter_optional_product_type_linear, 'selected' => $optional_selected, 'before' => $img_help));
//TODO: verificare select / checkbox

	echo $this->MyForm->submit(__('Send options', true), array('type' => 'button', 'class' => 'btn', 'id' => 'submit_button'));


	echo $this->MyForm->submit(__('Reset form', true), array('type' => 'button', 'class' => 'btn', 'id' => 'reset_button'));

	echo $this->MyForm->end();
?>
</div>

<div class="box_result">
<?php
//exit();
	$box_content = '';

	if (!empty($products_list)) {

		echo '<h2>' . __('tot products', true) . ' ' . $nav_pills_data[$product_type_id]['name'] . ': ' . count($products_list) . '</h2>';

$box_content .= $this->MyForm->create('Compare',array('id' => 'compare_form', 'url' => '/'.SLUG_PRODUCT_COMPARE_VIEW.'svil'));
echo '<form method="post" action="">
<input class="contact" type="submit" value="Contact SKF" /></form>';
$box_content .= $this->MyForm->submit(__('Compare products selected', true), array('type' => 'submit', 'class' => 'btn btn_compare', 'id' => 'compare_button'));
$box_content .= $this->MyForm->input('model_name', array('type' => 'hidden', 'value' => $model_name));

		foreach($products_list as $product) {

			$box_content .= '<div class="box_product">';
            $box_content .= '<div class="box_product_border_image">'; //apro container per bordo img

			$application_tmp = '';
			if (isset($application_selected) && $application_selected == 'auto' && $product[$model_name]['application_auto']) {
				$application_tmp .= numbers_to_stars ($product[$model_name]['application_auto']);
			}
			if (isset($application_selected) && $application_selected == 'medi' && $product[$model_name]['application_medi']) {
				$application_tmp .= numbers_to_stars ($product[$model_name]['application_medi']);
			}
			if (isset($application_selected) && $application_selected == 'fobe' && $product[$model_name]['application_fobe']) {
				$application_tmp .= numbers_to_stars ($product[$model_name]['application_fobe']);
			}
			if (isset($application_selected) && $application_selected == 'pupa' && $product[$model_name]['application_pupa']) {
				$application_tmp .= numbers_to_stars ($product[$model_name]['application_pupa']);
			}
			if (isset($application_selected) && $application_selected == 'oilg' && $product[$model_name]['application_oilg']) {
				$application_tmp .= numbers_to_stars ($product[$model_name]['application_oilg']);
			}
			if (isset($application_selected) && $application_selected == 'buil' && $product[$model_name]['application_buil']) {
				$application_tmp .= numbers_to_stars ($product[$model_name]['application_buil']);
			}
			if (isset($application_selected) && $application_selected == 'offh' && $product[$model_name]['application_offh']) {
				$application_tmp .= numbers_to_stars ($product[$model_name]['application_offh']);
			}
			if (isset($application_selected) && $application_selected == 'sola' && $product[$model_name]['application_sola']) {
				$application_tmp .= numbers_to_stars ($product[$model_name]['application_sola']);
			}
			if (isset($application_selected) && $application_selected == 'heal' && $product[$model_name]['application_heal']) {
				$application_tmp .= numbers_to_stars ($product[$model_name]['application_heal']);
			}
			if (isset($application_selected) && $application_selected == 'stee' && $product[$model_name]['application_stee']) {
				$application_tmp .= numbers_to_stars ($product[$model_name]['application_stee']);
			}
			if (isset($application_selected) && $application_selected == 'offi' && $product[$model_name]['application_offi']) {
				$application_tmp .= numbers_to_stars ($product[$model_name]['application_offi']);
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

            //VERIFY PERFORMANCE
			if ($product[$model_name]['verify_performance']) {
				$box_content .= '<li><a href="'. $product[$model_name]['verify_performance'] . '" target="_blank">' . __('view product preformance', true) . '</a></li>';
			}

            // associazione con control units
            if ($product['related_products']) {
				$box_content .= '<li><a href="' . $this->Html->url('/'.SLUG_PRODUCT_TYPE_CONTROL) . '?code=' . base64_encode('linear' . URL_CODE_SEPARATOR . $product[$model_name]['code']) . '">' . __('view product control device', true) . '</a></li>';
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

//DIALOG SELF LOCKING
$box_content .= '<div id="dialog_self_locking" title="'.__('Linear.Product.self_locking', true).'">';
$box_content .= '<p>'.__('<br /><b>WARNING</b><br /><br /><br />Self-locking function can be achieved by  the geometry of the mechanical part or with an optional brake integrated into the actuator.<br /><br />Please carefully check the product datasheet for information on self-locking.<br /><br />When brake option is available, select the proper typekey configuration to make sure that self-locking function is included.', true).'</p>';
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

	function init_form () {
		$('#search_form select').each(function() {
			$(this).bind('change', function() { send_form_data(); });
		});
//TODO: verificare select / checkbox
		$('#ProductOptionalE').click(function() {verify_checkbox ('#ProductOptionalE', '#ProductOptionalP'); } );
		$('#ProductOptionalP').click(function() {verify_checkbox ('#ProductOptionalP', '#ProductOptionalE'); } );
		$('#ProductOptionalI').click(function() {verify_checkbox ('#ProductOptionalI', '#ProductOptionalU,#ProductOptionalL'); } );
		$('#ProductOptionalU').click(function() {verify_checkbox ('#ProductOptionalU', '#ProductOptionalI,#ProductOptionalL'); } );
		$('#ProductOptionalL').click(function() {verify_checkbox ('#ProductOptionalL', '#ProductOptionalI,#ProductOptionalU'); } );
//TODO: verificare select / checkbox
		$('#reset_button').bind('click', function() { reset_form(); });
		$('#submit_button').bind('click', function() { send_form_data(); });
	}

	function reset_form () {
	// resetto i criteri filtro select
		$('#search_form select').each(function() {
			$(this).val('');
		});
	// resetto i criteri filtro checkbox
		$('#search_form input:checkbox').each(function() {
		   $(this).removeAttr('checked');
		});

		send_form_data ();
	}

	function send_form_data () {
		$('#search_form').submit();
		$('#spinner').show();
	}

	function verify_checkbox (detail_tmp, list_tmp) {
		var others = list_tmp.split(',');
//alert('others ' + others);
		var length = others.length;
		for (var i = 0; i < length; i++) {
			if ($(detail_tmp).is(':checked')) {
				$(others[i]).attr('checked', false);
				$(others[i]).attr('disabled', true);
			} else {
				$(others[i]).attr('disabled', false);
			}
		}
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
<?php
//TODO: verificare select / checkbox
// verifico già selezionati ...
if (!empty($optional_selected) && is_array($optional_selected)) {
	foreach($optional_selected as $key => $value) {
		if ($value == 'e') {
			echo "verify_checkbox ('#ProductOptionalE', '#ProductOptionalP');";
		}
		if ($value == 'p') {
			echo "verify_checkbox ('#ProductOptionalP', '#ProductOptionalE');";
		}
		if ($value == 'i') {
			echo "verify_checkbox ('#ProductOptionalI', '#ProductOptionalU,#ProductOptionalL');";
		}
		if ($value == 'u') {
			echo "verify_checkbox ('#ProductOptionalU', '#ProductOptionalI,#ProductOptionalL');";
		}
		if ($value == 'l') {
			echo "verify_checkbox ('#ProductOptionalL', '#ProductOptionalI,#ProductOptionalU');";
		}
	}
}
//TODO: verificare select / checkbox
?>
	});

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
	        items: "#LinearProductLoad, #LinearProductSpeed, #LinearProductStroke, #LinearProductDuty, #LinearProductVoltage, #LinearProductOptional, #LinearProductCertificato, #LinearProductSelfLocking",
	        position: { my: "left+15 center", at: "right center" },
	        content: function() {
	            var element = $( this );
	            if ( element.is( "#LinearProductLoad" ) ) return "<?php echo __('Linear.Product.load.help', true); ?>";
	            if ( element.is( "#LinearProductSpeed" ) ) return "<?php echo __('Linear.Product.speed.help', true); ?>";
	            if ( element.is( "#LinearProductStroke" ) ) return "<?php echo __('Linear.Product.stroke.help', true); ?>";
	            if ( element.is( "#LinearProductDuty" ) ) return "<?php echo __('Linear.Product.duty.help', true); ?>";
	            if ( element.is( "#LinearProductVoltage" ) ) return "<?php echo __('Linear.Product.voltage.help', true); ?>";
	            if ( element.is( "#LinearProductOptional" ) ) return "<?php echo __('Linear.Product.optional.help', true); ?>";
                if ( element.is( "#LinearProductCertificato" ) ) return "<?php echo __('Linear.Product.certificato.help', true); ?>";
                if ( element.is( "#LinearProductSelfLocking" ) ) return "<?php echo __('Linear.Product.selflocking.help', true); ?>";
	        }
	    });
     //MENU A TENDINA
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
     //
     //ALERT SELF LOCKING
     $('#dialog_self_locking').dialog({autoOpen: false});   
     
    });
    
    function openWindowPopupSelfLocking(pObj){
        valueSelect = pObj.options[pObj.selectedIndex].value;
        if (valueSelect=='1'){
            $('#dialog_self_locking').css('zIndex',999);
            var my_dialog = $('#dialog_self_locking').dialog({
    			width: 500,
    			height: 400,
    			autoOpen: false,
    			modal: true,
    			draggable: true,
    			title: '<?php echo __('Linear.Product.self_locking', true); ?>',
    			close: function (e, ui) { $(this).remove(); },
    //		    close: function (e, ui) { $(this).dialog('destroy'); },
    			buttons: {
    				'<?php echo __('Close', true) ?>': function() {
    					$( this ).dialog('close');
    				}
    			}
    		});
    		my_dialog.dialog('open');
            my_dialog.scrollTop("0");
        }
    }

// ]]>
</script>

<?php include('_js_product_listsvil.ctp'); ?>
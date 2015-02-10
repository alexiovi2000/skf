<div class="box_search">
    <div class="box_search_title"><?php echo __('box search title', true); ?></div>
<?php
	echo $this->MyForm->create('Product',array('id' => 'search_form', 'url' => '/'.$product_type_slug));

    $img_help = $html -> image('/img/info.png', array('width' => 16, 'height' => 16, 'alt' =>__('help',true), 'id' =>'RotaryProductLoad', 'class' =>'img_help_inline', 'title' => __('help',true)));
    echo $this->MyForm->input('load', array('label' => __('Rotary.Product.load', true), 'options' => $filter_load_product_type_rotary, 'selected' => $load_selected, 'empty' => __('all', true), 'before' => $img_help));

    $img_help = $html -> image('/img/info.png', array('width' => 16, 'height' => 16, 'alt' =>__('help',true), 'id' =>'RotaryProductSpeed', 'class' =>'img_help_inline', 'title' => __('help',true)));
	echo $this->MyForm->input('speed', array('label' => __('Rotary.Product.speed', true), 'options' => $filter_speed_product_type_rotary, 'selected' => $speed_selected, 'empty' => __('all', true), 'before' => $img_help));

    $img_help = $html -> image('/img/info.png', array('width' => 16, 'height' => 16, 'alt' =>__('help',true), 'id' =>'RotaryProductVoltage', 'class' =>'img_help_inline', 'title' => __('help',true)));
	echo $this->MyForm->input('voltage', array('label' => __('Rotary.Product.voltage', true), 'options' => $filter_voltage_product_type_rotary, 'selected' => $voltage_selected, 'empty' => __('all', true), 'before' => $img_help));

    echo $this->MyForm->input('application', array('label' => __('Rotary.Product.application', true), 'options' => $filter_application_product_type_rotary, 'selected' => $application_selected, 'empty' => __('all', true)));

//TODO: verificare select / checkbox
    $img_help = $html -> image('/img/info.png', array('width' => 16, 'height' => 16, 'alt' =>__('help',true), 'id' =>'RotaryProductOptional', 'class' =>'img_help_inline', 'title' => __('help',true)));
	echo $this->MyForm->input('optional', array('label' => __('Rotary.Product.optional', true), 'options' => $filter_optional_product_type_rotary, 'selected' => $optional_selected, 'empty' => __('all', true), 'before' => $img_help));




	echo $this->MyForm->submit(__('Reset form', true), array('type' => 'button', 'class' => 'btn', 'id' => 'reset_button'));

	echo $this->MyForm->end();
?>
</div>

<div class="box_result">
<?php
//pr($products_list);
//exit();
	$box_content = '';

	if (!empty($products_list)) {

		echo '<h2>' . __('tot products', true) . ' ' . $nav_pills_data[$product_type_id]['name'] . ': ' . count($products_list) . '</h2>';
		
		echo '<form method="post" action="mailto:actuators@skf.com?subject=Information request about Actuation Systems" >
<div class="box_contact"><input class="contact" type="submit" value="Contact SKF" /></div></form>';

		foreach($products_list as $product) {

			$box_content .= '<div class="box_product">';
            $box_content .= '<div class="box_product_border_image">'; //apro container per bordo img

			$application_tmp = '';
			if (isset($application_selected) && $application_selected == 'auto' && $product[$model_name]['application_auto']) {
//				$application_tmp .= $filter_application_product_type_control['auto'] . ': ' . numbers_to_stars ($product[$model_name]['application_auto']);
				$application_tmp .= numbers_to_stars ($product[$model_name]['application_auto']);
			}
			if (isset($application_selected) && $application_selected == 'oilg' && $product[$model_name]['application_oilg']) {
//				$application_tmp .= $filter_application_product_type_control['oilg'] . ': ' . numbers_to_stars ($product[$model_name]['application_oilg']);
				$application_tmp .= numbers_to_stars ($product[$model_name]['application_oilg']);
			}
			if (isset($application_selected) && $application_selected == 'cars' && $product[$model_name]['application_cars']) {
//				$application_tmp .= $filter_application_product_type_control['cars'] . ': ' . numbers_to_stars ($product[$model_name]['application_cars']);
				$application_tmp .= numbers_to_stars ($product[$model_name]['application_cars']);
			}
			if (isset($application_selected) && $application_selected == 'sola' && $product[$model_name]['application_sola']) {
//				$application_tmp .= $filter_application_product_type_control['sola'] . ': ' . numbers_to_stars ($product[$model_name]['application_sola']);
				$application_tmp .= numbers_to_stars ($product[$model_name]['application_sola']);
			}
			if (isset($application_selected) && $application_selected == 'heal' && $product[$model_name]['application_heal']) {
//				$application_tmp .= $filter_application_product_type_control['heal'] . ': ' . numbers_to_stars ($product[$model_name]['application_heal']);
				$application_tmp .= numbers_to_stars ($product[$model_name]['application_heal']);
			}
			$box_content .= '<div class="box_product_application">';
			if ($application_tmp) {
//				$box_content .= __('Product.application', true). ': ' . $application_tmp;
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

/*
            //TODO: Gestire Associazione - Compatible control device
            //if ($product[$model_name]['link']) {
				$box_content .= '<li><a href="#TODO">' . __('view product control device', true) . '</a></li>';
			//}
*/

			$box_content .= '		</ul>
                                </div>
                            </div>';
/*------------------------------------------------------------------------------------*/

			$box_content .= '</div>';
            $box_content .= '</div>'; //chiudo container per bordo img

			$box_content .= '</div>';

		}

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
/*
		$('#search_form input[type=checkbox]').each(function() {
			$(this).bind('click', function() { send_form_data(); });
		});
*/
//TODO: verificare select / checkbox
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

	$(function() {
	//INSERIMENTO HELP IN LINEA
	    $( document ).tooltip({
	        items: "#RotaryProductLoad, #RotaryProductSpeed, #RotaryProductVoltage, #RotaryProductOptional",
	        position: { my: "left+15 center", at: "right center" },
	        content: function() {
	            var element = $( this );
	            if ( element.is( "#RotaryProductLoad" ) ) return "<?php echo __('Rotary.Product.load.help', true); ?>";
	            if ( element.is( "#RotaryProductSpeed" ) ) return "<?php echo __('Rotary.Product.speed.help', true); ?>";
	            if ( element.is( "#RotaryProductVoltage" ) ) return "<?php echo __('Rotary.Product.voltage.help', true); ?>";
	            if ( element.is( "#RotaryProductOptional" ) ) return "<?php echo __('Rotary.Product.optional.help', true); ?>";
	        }
	    });
	//MENU A TENDINA
        $('.box_product_image').hover(function(){
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

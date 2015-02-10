
<script type="text/javascript">
// <![CDATA[


//TODO: verificare gestione accessories

	function open_modal_accessories (code) {
		var compare_family = '<?php echo $product_type_code ?>';
		var my_dialog = $('<div>').dialog({
			width: 800,
			height: 540,
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


// gestione comparazione prodotti

	var compare_selected_max = '<?php echo MAX_PRODUCT_COMPARE ?>';
	var compare_family = '<?php echo $product_type_code ?>';

	$(document).ready(function(){
		$('#compare_form').submit( function () {
		// verifico quante checkbox sono già selezionate
			var compare_selected = $('#compare_form input[type=checkbox]:checked').length;
			if (compare_selected > 0) {
				$.post(
					$(this).attr('action'),
					$(this).serialize(),
					function(data){
						var my_dialog = $('<div>').dialog({
							width: 800,
							height: 600,
							autoOpen: false,
							modal: true,
							draggable: true,
							title: '<?php echo __('option selected for product'); ?>' + ' ' + '<?php echo $nav_pills_data[$product_type_id]['name'] ?>',
					    	close: function (e, ui) { $(this).remove(); },
//						    close: function (e, ui) { $(this).dialog('destroy'); },
							buttons: {
								'<?php echo __('Close', true) ?>': function() {
									$( this ).dialog('close');
								}
							}

						});
						my_dialog.html(data);
						my_dialog.dialog('open');
                        my_dialog.scrollTop("0");
					}
				);
			} else {
				alert('<?php echo __('you must select at least one product', true)?>');
			}
			return false;
		});
		init_compare();
    });

	function init_compare () {
		$('#compare_form input[type=checkbox]').each(function() {
			$(this).bind('click', function() { verify_max_checkbox( $(this)); });
		});
	}

	function verify_max_checkbox (obj) {
		var compare_selected = $('#compare_form input[type=checkbox]:checked').length;
		var checked = (obj.attr('checked') && obj.attr('checked') != 'undefined') ? 'checked' : false;
		if (compare_selected > compare_selected_max) {
			alert('<?php echo __('you have reached max elements comparable', true)?>');
			checked = false;
		}
		obj.attr('checked', checked);
	}

	function select_product_detail (code, obj) {
// verifico quante checkbox sono già selezionate
		var compare_selected = $('#compare_form input[type=checkbox]:checked').length;
		var checked = (obj.attr('checked') && obj.attr('checked') != 'undefined') ? 'checked' : false;
		var value = obj.val();

		if (checked) {
			if (compare_selected <= compare_selected_max) {
				var my_dialog = $('<div>').dialog({
					width: 800,
					height: 450,
					autoOpen: false,
					modal: true,
					draggable: true,
					title: '<?php echo __('select option for product'); ?>' + ' ' + code,
				    close: function (e, ui) { $(this).remove(); },
//				    close: function (e, ui) { $(this).dialog('destroy'); },
					beforeClose: function( event, ui ) {
						if (!verify_product_detail_selected(space_to_underscore(code))) {
							if (!confirm('<?php echo __('close without selection (Ok) or return to selection (Cancel)'); ?>')) {
									return false;
							}
						}
					},
					buttons: {
						'<?php echo __('Confirm', true) ?>': function() {
							$( this ).dialog('close');
						}
					}
				});
				url = '<?php echo $html->url('/'.SLUG_PRODUCT_COMPARE_SELECT.'svil'); ?>' + '/' + rawUrlEncode(compare_family) + '/' + rawUrlEncode(code) + '/' + rawUrlEncode(value) + '/<?php echo time(); ?>';
				my_dialog.load(url).dialog('open');
                my_dialog.scrollTop("0");
			}
		} else {
			obj.val('-1');
		}
	}

// verifico se c'è almeno un'opzione selezionata e valorizzo la checkbox corrispondente del form principale
	function verify_product_detail_selected (code) {
		var checked_tmp = false;
		var detail_selected = $('input[type=radio]:checked').val();
		detail_selected = (detail_selected && detail_selected != 'undefined') ? detail_selected : false;
		if (detail_selected && detail_selected != -1) {
			checked_tmp = 'checked';
		}
		$('#CompareCodeId'+code).val(detail_selected);
		$('#CompareCodeId'+code).attr('checked', checked_tmp);
//alert('code ' + code);
//alert('detail_selected ' + detail_selected);
//alert('checked_tmp ' + checked_tmp);
		return detail_selected;
	}

	function rawUrlEncode(my_string) {
	// sostituisco '/' e '#' per evitare problemi con lettura parametri di cake da url
		if (my_string) {
			my_string = my_string.replace(/\//g,"|--|");
			my_string = my_string.replace(/#/g,"-||-");
			my_string = encodeURIComponent(my_string);
		}
	   return my_string;
	}

	function space_to_underscore(my_string) {
	// sostituisco ' ' con  '_'
		if (my_string) {
			my_string = my_string.replace(' ',"_");
		}
	   return my_string;
	}

// gestione comparazione prodotti

// ]]>
</script>
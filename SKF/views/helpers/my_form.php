<?php
/**
 * MyForm Helper class file.
 *
 * Extend form helper

 */
/**
 *
 * MyFormHelper encloses all methods to extend Form Helper class
 *
 */
class MyFormHelper extends FormHelper {

	var $helpers = array('Html','Javascript');
 // Check if the tiny_mce.js file has been added or not
	var $_script = false;


/**
 * Generates a form input element complete with label and wrapper div
 *
 * Options - See each field type method for more information. Any options that are part of
 * $attributes or $options for the different type methods can be included in $options for input().
 *
 * - 'type' - Force the type of widget you want. e.g. ```type => 'select'```
 * - 'label' - control the label
 * - 'div' - control the wrapping div element
 * - 'options' - for widgets that take options e.g. radio, select
 * - 'error' - control the error message that is produced
 *
 * @param string $fieldName This should be "Modelname.fieldname"
 * @param array $options Each type of input takes different options.
 * @return string Completed form widget
 */

 /*
 function input($fieldName, $options = array()) {
		$view =& ClassRegistry::getObject('view');
		$this->setEntity($fieldName);
		$entity = join('.', $view->entity());

		$defaults = array('before' => null, 'between' => null, 'after' => null);
		$options = array_merge($defaults, $options);

		if (!isset($options['type'])) {
			$options['type'] = 'text';

			if (isset($options['options'])) {
				$options['type'] = 'select';
			} elseif (in_array($this->field(), array('psword', 'passwd', 'password'))) {
				$options['type'] = 'password';
			} elseif (isset($this->fieldset['fields'][$entity])) {
				$fieldDef = $this->fieldset['fields'][$entity];
				$type = $fieldDef['type'];
				$primaryKey = $this->fieldset['key'];
			} elseif (ClassRegistry::isKeySet($this->model())) {
				$model =& ClassRegistry::getObject($this->model());
				$type = $model->getColumnType($this->field());
				$fieldDef = $model->schema();

				if (isset($fieldDef[$this->field()])) {
					$fieldDef = $fieldDef[$this->field()];
				} else {
					$fieldDef = array();
				}
				$primaryKey = $model->primaryKey;
			}

			if (isset($type)) {
				$map = array(
					'string'  => 'text',     'datetime'  => 'datetime',
					'boolean' => 'checkbox', 'timestamp' => 'datetime',
					'text'    => 'textarea', 'time'      => 'time',
					'date'    => 'date',     'float'     => 'text'
				);

				if (isset($this->map[$type])) {
					$options['type'] = $this->map[$type];
				} elseif (isset($map[$type])) {
					$options['type'] = $map[$type];
				}
				if ($this->field() == $primaryKey) {
					$options['type'] = 'hidden';
				}
			}

			if ($this->model() === $this->field()) {
				$options['type'] = 'select';
				if (!isset($options['multiple'])) {
					$options['multiple'] = 'multiple';
				}
			}
		}
		$types = array('text', 'checkbox', 'radio', 'select');

		if (!isset($options['options']) && in_array($options['type'], $types)) {
			$view =& ClassRegistry::getObject('view');
			$varName = Inflector::variable(
				Inflector::pluralize(preg_replace('/_id$/', '', $this->field()))
			);
			$varOptions = $view->getVar($varName);
			if (is_array($varOptions)) {
				if ($options['type'] !== 'radio') {
					$options['type'] = 'select';
				}
				$options['options'] = $varOptions;
			}
		}

		$autoLength = (!array_key_exists('maxlength', $options) && isset($fieldDef['length']));
		if ($autoLength && $options['type'] == 'text') {
			$options['maxlength'] = $fieldDef['length'];
		}
		if ($autoLength && $fieldDef['type'] == 'float') {
			$options['maxlength'] = array_sum(explode(',', $fieldDef['length']))+1;
		}

		$out = '';
		$div = true;
		$divOptions = array();

		if (array_key_exists('div', $options)) {
			$div = $options['div'];
			unset($options['div']);
		}

		if (!empty($div)) {
			$divOptions['class'] = 'input';
			$divOptions = $this->addClass($divOptions, $options['type']);
			if (is_string($div)) {
				$divOptions['class'] = $div;
			} elseif (is_array($div)) {
				$divOptions = array_merge($divOptions, $div);
			}

			if (in_array($this->field(), $this->fieldset['validates'])) {
				$divOptions = $this->addClass($divOptions, 'required');
			}
			if (!isset($divOptions['tag'])) {
				$divOptions['tag'] = 'div';
			}
		}

		$label = null;
		if (isset($options['label']) && $options['type'] !== 'radio') {
			$label = $options['label'];
			unset($options['label']);
		}

		if ($options['type'] === 'radio') {
			$label = false;
			if (isset($options['options'])) {
				if (is_array($options['options'])) {
					$radioOptions = $options['options'];
				} else {
					$radioOptions = array($options['options']);
				}
				unset($options['options']);
			}
		}

		if ($label !== false) {
			$labelAttributes = $this->domId(array(), 'for');
			if (in_array($options['type'], array('date', 'datetime'))) {
				$labelAttributes['for'] .= 'Month';
			} else if ($options['type'] === 'time') {
				$labelAttributes['for'] .= 'Hour';
			}

			if (is_array($label)) {
				$labelText = null;
				if (isset($label['text'])) {
					$labelText = $label['text'];
					unset($label['text']);
				}
				$labelAttributes = array_merge($labelAttributes, $label);
			} else {
				$labelText = $label;
			}

			if (isset($options['id'])) {
				$labelAttributes = array_merge($labelAttributes, array('for' => $options['id']));
			}
			$out = $this->label($fieldName, $labelText, $labelAttributes);
		}

		$error = null;
		if (isset($options['error'])) {
			$error = $options['error'];
			unset($options['error']);
		}

		$selected = null;
		if (array_key_exists('selected', $options)) {
			$selected = $options['selected'];
			unset($options['selected']);
		}
		if (isset($options['rows']) || isset($options['cols'])) {
			$options['type'] = 'textarea';
		}

		$empty = false;
		if (isset($options['empty'])) {
			$empty = $options['empty'];
			unset($options['empty']);
		}

		$timeFormat = 12;
		if (isset($options['timeFormat'])) {
			$timeFormat = $options['timeFormat'];
			unset($options['timeFormat']);
		}

		$dateFormat = 'MDY';
		if (isset($options['dateFormat'])) {
			$dateFormat = $options['dateFormat'];
			unset($options['dateFormat']);
		}

		$type	 = $options['type'];
		$before	 = $options['before'];
		$between = $options['between'];
		$after	 = $options['after'];
		unset($options['type'], $options['before'], $options['between'], $options['after']);
//pr('$type ' . $type);
		switch ($type) {
            case 'hidden':
				$out = $this->hidden($fieldName, $options);
				unset($divOptions);
			break;
			case 'checkbox':
				$out = $before . $this->checkbox($fieldName, $options) . $between . $out;
			break;
			case 'radio':
				$out = $before . $out . $this->radio($fieldName, $radioOptions, $options) . $between;
			break;
			case 'text':
                if(empty($options['class']))
                    $options['class'] = 'txtbox-middle';
            	$out = $before . $out . $between . $this->{$type}($fieldName, $options);
            break;
			case 'password':
                if(empty($options['class']))
                    $options['class'] = 'txtbox-middle';
            	$out = $before . $out . $between . $this->{$type}($fieldName, $options);
			break;
			case 'file':
				$out = $before . $out . $between . $this->file($fieldName, $options);
			break;
			case 'select':
				$options = array_merge(array('options' => array()), $options);
				$list = $options['options'];
				unset($options['options']);
				$out = $before . $out . $between . $this->select(
					$fieldName, $list, $selected, $options, $empty
				);
			break;
			case 'time':
			case 'date':
			case 'datetime':
				$out = $before . $out . $between . $this->dateTime(
					$fieldName, $dateFormat, $timeFormat, $selected, $options, $empty
				);
			break;
			case 'textarea':
                if(empty($options['class']))
                    $options['class'] = 'tinyMce';
                $out = $before . $out . $between . $this->textarea($fieldName, array_merge(
					array('cols' => '30', 'rows' => '6'), $options
				));
            break;
			default:
                $out = $before . $out . $between . $this->text($fieldName);
			break;
		}

		if ($type != 'hidden') {
			$out .= $after;
			if ($error !== false) {
				$errMsg = $this->error($fieldName, $error);
				if ($errMsg) {
					$out .= $errMsg;
					$divOptions = $this->addClass($divOptions, 'error');
				}
			}
		}
		if (isset($divOptions) && isset($divOptions['tag'])) {
			$tag = $divOptions['tag'];
			unset($divOptions['tag']);
			$out = $this->Html->tag($tag, $out, $divOptions);
		}
		return $out;
	}
*/

	function dateTime($fieldName, $options = array()) {

//[GDA]
		$options_default = array('type' => 'text', 'class' => 'datepicker', 'readonly' => 'readonly', 'style' => 'width:25%; clear: none;');
        if (is_array($options) && count ($options))	{
            $options = array_merge($options_default,$options);
/*
pr('$options is array ');
pr($options);
*/
        } else {
            $options = $options_default;
/*
pr('$options not is array ');
pr($options);
*/
        }
//		$options = array_merge(array('type' => 'text','class' => 'datepicker'),$options);
//		$options = $this->_initInputField($fieldName, $options);

		$options = $this->_initInputField($fieldName, $options);

		$options_reset = array('after' => ' <a href="#" onclick="$(\'#'. $options['id'] . '\').val(\'\'); return false;">reset data</a>');
		$options_new = array_merge($options,$options_reset);

		$options = $options_new;

//[GDA]


		$code = $this->input($fieldName, $options);
//		$code .= $this->Javascript->codeBlock('$(function(){$(\'#'. $options['id'] . '\').datepicker($.datepicker.regional[\'it\']);});');
		$code .= $this->Javascript->codeBlock('$(function(){$(\'#'. $options['id'] . '\').datepicker();});');
		return $code;
	}


	function anyDateTime($fieldName, $options = array()) {

        if (is_array($options) && count ($options))	{
            $options = array_merge(array('type' => 'text','class' => 'datepicker'),$options);
        } else {
            $options = array('type' => 'text','class' => 'datepicker');
        }

		$options = $this->_initInputField($fieldName, $options);
		$options['after'] = "<a class='clear_anydate' href='#' onclick=\"$('#".$options['id']."').val('');return false;\">X</a>";
		$code = $this->input($fieldName, $options);
		$code .= $this->Javascript->codeBlock(' AnyTime.picker( \'' . $options['id'] .'\', ' .
      		' { ' .
      		' format: "%d/%m/%Y %H:%i", ' .
      		' dayNames: ["Domenica","Lunedì","Martedì","Mercoledì","Giovedì","Venerdì","Sabato"] , ' .
      		' dayAbbreviations:  ["Dom","Lun","Mar","Mer","Gio","Ven","Sab"] , ' .
			' labelHour: "Ora", labelMinute: "Minuto" , ' .
			' labelYear: "Anno", labelMonth: "Mese" , ' .
			' labelDayOfMonth: "Giorno", ' .
			' labelTitle: "Sceglere Data e Ora", ' .
			' firstDOW: 1 ' .
			' } ); ');
		return $code;
	}


	function searchDateTime($fieldName) {

		$code = '<div class="calfilter date_from_to">';

        $code .= '<table class="date_from_to_table"><tr><td style="padding-top: 0; padding-bottom:0;">';

        $code .= $this->label('from-'. $fieldName,__('From:',true));
        $code .= $this->text('from-' . $fieldName, array('class' => 'datepicker'));

//TODO: verificare azzeramento blocco data inizio
        $code .= $this->Javascript->codeBlock('	$(function(){
                                                    $(\'#'. $this->model() . 'From-' . $fieldName . '\').datepicker({
														beforeShow: function(input, inst) {
        													myMaxDate = $("#'. $this->model() . 'To-' . $fieldName . '").datepicker("getDate");
                                                            jQuery(\'#'. $this->model() .'From-' . $fieldName . '\').datepicker(\'option\', \'maxDate\', myMaxDate);
														}

                                                    });
                                                });'
                                            );

/*
    onSelect: function(dateText, inst) {
        var selDate = new Date(dateText.substring(6,10),(dateText.substring(3,5))-1,parseInt(dateText.substring(0,2)));
        selDate.setDate(selDate.getDate()+1);
        if (!selDate) selDate = null;
        jQuery(\'#'. $this->model() .'To-' . $fieldName . '\').datepicker(\'option\', \'minDate\' , selDate);
 	}
*/

        $code .= '</td><td style="padding-top: 0; padding-bottom:0;">';

        $code .= $this->label('to-'. $fieldName,__('To:',true));
        $code .= $this->text('to-' . $fieldName, array('class' => 'datepicker'));

//TODO: verificare azzeramento blocco data inizio
        $code .= $this->Javascript->codeBlock('	$(function(){
        											$(\'#'. $this->model() . 'To-' . $fieldName . '\').datepicker({
														beforeShow: function(input, inst) {
        													myMinDate = $("#'. $this->model() . 'From-' . $fieldName . '").datepicker("getDate");
                                                            jQuery(\'#'. $this->model() .'To-' . $fieldName . '\').datepicker(\'option\', \'minDate\', myMinDate);
														}
        											});
                                                });'
                                            );

        $code .= '</td></tr></table>';

        $code .= '</div>';
		return $code;
	}


/*
	function searchDateTime($fieldName) {
		$code = '<div class="calfilter date_from_to">';

                $code .= '<table class="date_from_to_table"><tr><td style="padding-top: 0; padding-bottom:0;">';

                $code .= $this->label('from-'. $fieldName,__('From:',true));
                $code .= $this->text('from-' . $fieldName, array('class' => 'datepicker'));
                $code .= $this->Javascript->codeBlock('$(function(){
                                                                    $(\'#'. $this->model() . 'From-' . $fieldName . '\').datepicker({
                                                                    onSelect: function(dateText, inst) {
                                                                        var selDate = new Date(dateText.substring(6,10),(dateText.substring(3,5))-1,parseInt(dateText.substring(0,2)));
                                                                        selDate.setDate(selDate.getDate()+1);
                                                                        jQuery(\'#'. $this->model() .'To-' . $fieldName . '\').datepicker(\'option\', \'minDate\' , selDate);
                                                                        }
                                                                    });
                                                        });'
                                                    );
//                $code .= '<br /><br />';
                $code .= '</td><td style="padding-top: 0; padding-bottom:0;">';
                $code .= $this->label('to-'. $fieldName,__('To:',true));
                $code .= $this->text('to-' . $fieldName, array('class' => 'datepicker'));
                $code .= $this->Javascript->codeBlock('$(function(){$(\'#'. $this->model() .'To-' . $fieldName . '\').datepicker($.datepicker.regional[\'it\']);});');
                $code .= '</td></tr></table>';

                $code .= '</div>';
		return $code;
	}
*/



        /**
 * Generates an input element for search filters showed into index view
 *
 * Options - See each field type method for more information. Any options that are part of
 * $attributes or $options for the different type methods can be included in $options for input().
 *
 * @param string $fieldName This should be "Modelname.fieldname"
 * @return string Completed search widget
 */

//[GDA]
//    function searchInput($fieldName) {
    function searchInput($fieldName, $options = array()) {
//[GDA]

        $view =& ClassRegistry::getObject('view');
        $this->setEntity($fieldName);
        $entity = join('.', $view->entity());

//[GDA]
//        $options = array();
//        $options['type'] = '';
/*
if (!isset($options['type'])) {
        $options['type'] = '';
}
*/
//[GDA]

//[GDA]
$option_tmp = isset($options['type']) ? $options['type'] : '';
//        if (in_array($this->field(), array('psword', 'passwd', 'password'))) {
        if (in_array($this->field(), array('psword', 'passwd', 'password')) && !$option_tmp) {
//[GDA]
                $options['type'] = 'password';
        } elseif (isset($this->fieldset['fields'][$entity])) {
                $fieldDef = $this->fieldset['fields'][$entity];
                $type = $fieldDef['type'];
                $primaryKey = $this->fieldset['key'];
        } elseif (ClassRegistry::isKeySet($this->model())) {

                $model =& ClassRegistry::getObject($this->model());
                $type = $model->getColumnType($this->field());
                $fieldDef = $model->schema();

                if (isset($fieldDef[$this->field()])) {
                        $fieldDef = $fieldDef[$this->field()];
                } else {
                        $fieldDef = array();
                }
                $primaryKey = $model->primaryKey;
        }

        if (isset($type)) {
                $map = array(
                        'string'  => 'text',     'datetime'  => 'datetime',
                        'boolean' => 'boolean', 'timestamp' => 'datetime',
                        'text'    => 'textarea', 'time'      => 'time',
                        'date'    => 'date',     'float'     => 'text',
                        'integer' => 'select'
                );
//[GDA]
//                if (isset($this->map[$type])) {
//                        $options['type'] = $this->map[$type];
                if (isset($options['type']) && $options['type']) {
                        //$options['type'] = $this->map[$type];
//[GDA]
                } elseif (isset($map[$type])) {
                        $options['type'] = $map[$type];
                }
                if ($this->field() == $primaryKey) {
                        $options['type'] = 'hidden';
                }
        }

        if ($this->model() === $this->field()) {
                $options['type'] = 'select';
                if (!isset($options['multiple'])) {
                        $options['multiple'] = 'multiple';
                }
        }
        $types = array('text', 'radio', 'select');

        if (in_array($options['type'], $types)) {
                $view =& ClassRegistry::getObject('view');
                $varName = Inflector::variable(
                        Inflector::pluralize(preg_replace('/_id$/', '', $this->field()))
                );

                $varOptions = $view->getVar($varName);

                if (is_array($varOptions)) {
                        if ($options['type'] !== 'radio') {
                                $options['type'] = 'select';
                        }
// [GDA]
                        if (empty($options['options'])) {
	                        $options['options'] = $varOptions;
                        }
//                        $options['options'] = $varOptions;
// [GDA]
                }
        }

        if ($options['type'] == 'text' && isset($fieldDef['length'])) {
                $options['maxlength'] = $fieldDef['length'];
        }

        $out = '';


        $type	 = $options['type'];
//pr('$type ' . $type);
        switch ($type) {
                case 'hidden':
                        $out = $this->hidden($fieldName, $options);
                break;
                case 'boolean':
                        $optionlist = array(1 =>__('Yes',true), 0 =>__('No',true));
                        $out = $out . $this->select($fieldName, $optionlist,null,array('empty' => ''));
                break;
                case 'text':
                        $options['class'] = 'txtbox-short';
                        $out = $out . $this->{$type}($fieldName, $options);
                break;
                case 'password':
                        $out = null;
                break;
                case 'select':
                        $options = array_merge(array('options' => array(),'empty' => ''), $options);
                        $list = $options['options'];
                        unset($options['options']);
/*
pr('$options');
pr($options);
pr('$list');
pr($list);

*/
                        $out = $out . $this->select(
                                $fieldName, $list, $options
                        );
                break;
                case 'time':
                case 'date':
                case 'datetime':
                        $out = $out . $this->searchDateTime(
                                $fieldName
                        );
                break;
                default:
                         $out = $this->hidden($fieldName, $options);
                break;
        }

        return $out;
    }

        /**
	 * Adds the TinyMCE WYSIWYG editor to all textarea fields
         *
         * TinyMCE files must be into /js/admin/tiny_mce folder.
	 *
	 * @param string $className textarea class to transform
	 * @param array $tinyoptions Array of TinyMCE attributes for this textarea
	 * @return string JavaScript code to initialise the TinyMCE area
	 */
	function add_to_textareas($className = null, $tinyoptions = array()) {
		if (!$this->_script) {
			// We don't want to add this every time, it's only needed once
			$this->_script = true;
			$this->Javascript->link('/js/tiny_mce/tiny_mce.js', false);
		}

		// Ties the options to the field
		if($className == null) {
			$tinyoptions['mode'] = 'textareas';
            $tinyoptions['editor_deselector'] = 'mceNoEditor';
		} else {
			$tinyoptions['mode'] = 'specific_textareas';
			$tinyoptions['editor_selector'] = $className;
		}


		return $this->Javascript->codeBlock('tinyMCE.init(' . $this->Javascript->object($tinyoptions) . ');');
	}

        /**
	 * Creates file input widget.
	 *
	 * @param string $fieldName Name of a field, like this "Modelname.fieldname", "Modelname/fieldname" is deprecated
	 * @param array $options Array of HTML attributes.
	 * @return string
	 * @access public
	 *
	function file($fieldName, $options = array()) {
		$options = $this->_initInputField($fieldName, array_merge(array('type' => 'text'), $options));
		$code = $this->text($fieldName, $options);
		$fieldType = $fieldName;
		$pos = strrpos($fieldType, '.');
		if(!($pos === false)) $fieldType = substr($fieldType, $pos + 1);
		switch($fieldType){
			case 'image':
			case 'thumbnail':
			case 'thumb':
			case "logo":
			case "afbeelding":
			case "foto":
			case "photo":
				$type = 'Images';
				$typedir = 'images';
				break;
			case 'movie':
				$type = 'Flash';
				$typedir = 'flash';
				break;
			default:
				$type = 'Files';
				$typedir = 'files';
				break;
		}
		$id = $options['id'];
		$code .= '<script type="text/javascript">';
		$code .= "//<![CDATA[\n";
		$code .= "function openFileBrowser{$id}(){\n";
		$code .= "var url = '{$this->webroot}js/ckfinder/ckfinder.html?type={$type}&action=js&func=SetFileField{$id}';\n";
		$code .= "var sOptions = 'toolbar=no,status=no,resizable=yes,dependent=yes,scrollbars=yes,width=640,height=480';\n";
		$code .= "var oWindow = window.open(url, 'ckfinder', sOptions);\n";
		$code .= "}\n";
		$code .= "function SetFileField{$id}(fileUrl){\n";
		$code .= "var pos = fileUrl.toLowerCase().indexOf('webroot/files/{$typedir}');\n";
		$len = 1 + strlen("webroot/files/{$typedir}");
		$code .= "fileUrl = fileUrl.substr(pos + {$len});\n";
		$code .= "document.getElementById('{$id}').value = fileUrl;\n";
		$code .= "}\n";
		$code .= "//]]>\n";
		$code .= '</script>';
		$code .= '<a href="#" onclick="openFileBrowser'.$id.'(); return false;">selecteer...</a>';
		return $code;
	}*/

        /*function select($fieldName, $options = array(), $selected = null, $attributes = array(), $showEmpty = '') {
		$attributes = $this->_initInputField($fieldName, $attributes);
		$code = parent::select($fieldName, $options, $selected, $attributes, $showEmpty);
		if(!empty($attributes['autocomplete']) && $attributes['autocomplete'] == true)
		{
			$code .= "<script type=\"text/javascript\">\n";
			$code .= "var {$attributes['id']}Data = new Array();\n";
			$code .= "\$('#{$attributes['id']}').before('<input type=\"text\" id=\"{$attributes['id']}Text\" />');\n";
			$code .= "\$('#{$attributes['id']}').css('display', 'none');\n";
			$code .= "\$('#{$attributes['id']} option').each(function(i){\n";
			$code .= "{$attributes['id']}Data.push({label: this.innerHTML, value: this.value});\n";
			$code .= "if(\$('#{$attributes['id']}').val() == this.value) \$('#{$attributes['id']}Text').val(this.innerHTML);\n";
			$code .= "});\n";
			$code .= "\$('#{$attributes['id']}Text').autocomplete({$attributes['id']}Data, {\n";
			$code .= "max: 20,\n";
			$code .= "matchContains: true,\n";
			$code .= "formatItem: function(item) {\n";
			$code .= "return item.label;\n";
			$code .= "}\n";
			$code .= "}).result(function(event, item) {\n";
			$code .= "\$('#{$attributes['id']}').val(item.value);\n";
			$code .= "\$('#{$attributes['id']}').change();\n";
			$code .= "});\n";
			$code .= "</script>\n";
		}
		return $code;
	}*/

}
?>

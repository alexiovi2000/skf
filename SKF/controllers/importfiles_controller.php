<?php
class ImportfilesController extends AppController {

	var $name = 'Importfiles';

	var $uses = array(
		'Importfile',
	 	'ProductsPillar',
	 	'ProductsLinear',
	 	'ProductsRotary',
	 	'ProductsControl',
	 	'ProductsAccessory',
	 	'ProductsAssociation',
	 );


// importazione file ProductsPillar
	function admin_pillar() {

		$msg_result_import = array();
		$errors = null;

		$str_si = 'si';
		$model_name = 'ProductsPillar';
		$product_type_id = ID_PRODUCT_TYPE_PILLAR;
		$row_start = 2;

		$this->set('product_type_selected', $product_type_id);

		$results = array();
		$result_counter = 0;
		$results[$model_name][$result_counter] = array();

		if ($this->data) {
/*
pr('$this->data');
pr($this->data);
exit();
*/
			if ($this->Importfile->save($this->data)) {
				$msg_result_import[] = __('Upload file complete', true);
				$this->data = $this->Importfile->read(null, $this->Importfile->id);
			} else {
				$errors = $this->Importfile->invalidFields();
/*
pr('Upload file error: $errors');
pr($errors);
exit();
*/
				$msg_result_import[] = __('Upload file error, please try again', true);
			}

			if (!$errors) {

		    // carico file PHPExcel
				$this->_initPHPExcel();
				$objReader = PHPExcel_IOFactory::createReader('Excel5');
				$objReader->setReadDataOnly(true);

			// leggo file xls uplodato
				$file_import_name = $this->data['Importfile']['file_name'];
				$file_import_url = WWW_ROOT . $this->data['Importfile']['file_dir']. DS . $file_import_name;
				$objPHPExcel = PHPExcel_IOFactory::load($file_import_url);

			// verifico composizione file xls e validità formale dei dati ...
				$file_import_valid = $this->_verify_file_import_format($objPHPExcel, $product_type_id);

				if ($file_import_valid) {

					$msg_result_import[] = __('Uploaded data is valid', true);

				// elimino i record esistenti
					$conditions_delete = '1 = 1';
					$this->$model_name->deleteAll($conditions_delete);

				// leggo dati dell'xls da inserire a db
					$sheetIndex = 0;
					$objWorksheet = $objPHPExcel->setActiveSheetIndex($sheetIndex);
					$highestRow = $objWorksheet->getHighestRow(); // e.g. 10
					$highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
					$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5

					for ($row = $row_start; $row <= $highestRow; ++$row) {
						for ($col = 0; $col < $highestColumnIndex; ++$col) {
							$val_tmp = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
							$val_tmp = trim($val_tmp);
//pr('$col ' . $col . ' - $row ' . $row . ' - $val_tmp ' . $val_tmp);

							switch ($col) {
								case '0':
									$results[$model_name][$result_counter]['code'] = $val_tmp;
									break;
								case '1':
									$results[$model_name][$result_counter]['code_id'] = $val_tmp;
									break;
								case '2':
									$results[$model_name][$result_counter]['load'] = $val_tmp;
									break;
								case '3':
									$results[$model_name][$result_counter]['pull_load'] = $val_tmp;
									break;
								case '4':
									$results[$model_name][$result_counter]['bending'] = $val_tmp;
									break;
								case '5':
									$results[$model_name][$result_counter]['speed'] = $val_tmp;
									break;
								case '6':
									$results[$model_name][$result_counter]['section'] = $val_tmp;
									break;
								case '7':
									$results[$model_name][$result_counter]['stroke'] = $val_tmp;
									break;
								case '8':
									$results[$model_name][$result_counter]['retracted_length_push'] = $val_tmp;
									break;
								case '9':
									$results[$model_name][$result_counter]['retracted_length_pull'] = $val_tmp;
									break;
								case '10':
									$results[$model_name][$result_counter]['voltage'] = $val_tmp;
									break;
								case '11':
									$results[$model_name][$result_counter]['power'] = $val_tmp;
									break;
								case '12':
									$results[$model_name][$result_counter]['current'] = $val_tmp;
									break;
								case '13':
									$results[$model_name][$result_counter]['duty_cycle_intermittent'] = $val_tmp;
									break;
								case '14':
									$results[$model_name][$result_counter]['duty_cycle_short'] = $val_tmp;
									break;
								case '15':
									$results[$model_name][$result_counter]['ambient_temp'] = $val_tmp;
									break;
								case '16':
									$results[$model_name][$result_counter]['type_of_protection'] = $val_tmp;
									break;
								case '17':
									$results[$model_name][$result_counter]['type_of_control'] = $val_tmp;
									break;
								case '18':
									$results[$model_name][$result_counter]['weight'] = $val_tmp;
									break;
								case '19':
									$results[$model_name][$result_counter]['footprint'] = $val_tmp;
									break;
								case '20':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['certificato'] = $val_tmp;
									break;
								case '21':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['optional_e'] = $val_tmp;
									break;
								case '22':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['optional_p'] = $val_tmp;
									break;
								case '23':
									//$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['application_medi'] = $val_tmp;
									break;
								case '24':
									//$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['application_auto'] = $val_tmp;
									break;
								case '25':
									//$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['application_buil'] = $val_tmp;
									break;
								case '26':
									//$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['application_offi'] = $val_tmp;
									break;
								case '27':
									//$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['application_heal'] = $val_tmp;
									break;
								case '28':
//todo: gestione immagini
									$results[$model_name][$result_counter]['image'] = $val_tmp;
									break;
								case '29':
//todo: gestione link
									$results[$model_name][$result_counter]['file_pdf'] = $val_tmp;
									break;
								case '30':
//todo: gestione link
									$results[$model_name][$result_counter]['file_drawing'] = $val_tmp;
									break;
								case '31':
//todo: gestione link
									$results[$model_name][$result_counter]['link'] = $val_tmp;
									break;

								default:
							}

						}
						$result_counter ++;
					}
/*
pr('$results');
pr($results);
pr('$result_counter #' . $result_counter);
exit();
*/

				// salvo i dati importati
					if (is_array($results[$model_name]) && !empty($results[$model_name])) {
						if ($this->$model_name->saveAll($results[$model_name])) {
							$msg_result_import[] = __('Uploaded data saved', true);
							$msg_result_import[] = sprintf(__('Record saved: %s', true), $result_counter);
						} else {
							$msg_result_import[] = __('Uploaded data NOT saved', true);
// TODO: elimino eventuali dati salvati??
						}
					} else {
						$msg_result_import[] = __('Uploaded data saved', true);
					}
				} else {
					$msg_result_import[] = __('Uploaded data is NOT valid', true);
				}

			}

		}

		if (!empty($msg_result_import)) {
			$this->Session->write('admin_import_result', implode('<br />', $msg_result_import));
			$this->redirect(array('action' => 'admin_import_result'));
		}

	}


// importazione file ProductsLinear
	function admin_linear() {

		$msg_result_import = array();
		$errors = null;

		$str_si = 'si';
		$model_name = 'ProductsLinear';
		$product_type_id = ID_PRODUCT_TYPE_LINEAR;
		$row_start = 2;

		$this->set('product_type_selected', $product_type_id);

		$results = array();
		$result_counter = 0;
		$results[$model_name][$result_counter] = array();

		if ($this->data) {
/*
pr('$this->data');
pr($this->data);
exit();
*/
			if ($this->Importfile->save($this->data)) {
				$msg_result_import[] = __('Upload file complete', true);
				$this->data = $this->Importfile->read(null, $this->Importfile->id);
			} else {
				$errors = $this->Importfile->invalidFields();
/*
pr('Upload file error: $errors');
pr($errors);
exit();
*/
				$msg_result_import[] = __('Upload file error, please try again', true);
			}

			if (!$errors) {

		    // carico file PHPExcel
				$this->_initPHPExcel();
				$objReader = PHPExcel_IOFactory::createReader('Excel5');
				$objReader->setReadDataOnly(true);

			// leggo file xls uplodato
				$file_import_name = $this->data['Importfile']['file_name'];
				$file_import_url = WWW_ROOT . $this->data['Importfile']['file_dir']. DS . $file_import_name;
				$objPHPExcel = PHPExcel_IOFactory::load($file_import_url);

			// verifico composizione file xls e validità formale dei dati ...
				$file_import_valid = $this->_verify_file_import_format($objPHPExcel, $product_type_id);

				if ($file_import_valid) {

					$msg_result_import[] = __('Uploaded data is valid', true);

				// elimino i record esistenti
					$conditions_delete = '1 = 1';
					$this->$model_name->deleteAll($conditions_delete);

				// leggo dati dell'xls da inserire a db
					$sheetIndex = 0;
					$objWorksheet = $objPHPExcel->setActiveSheetIndex($sheetIndex);
					$highestRow = $objWorksheet->getHighestRow(); // e.g. 10
					$highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
					$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5

					for ($row = $row_start; $row <= $highestRow; ++$row) {
						for ($col = 0; $col < $highestColumnIndex; ++$col) {
							$val_tmp = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
							$val_tmp = trim($val_tmp);
//pr('$col ' . $col . ' - $row ' . $row . ' - $val_tmp ' . $val_tmp);

							switch ($col) {
								case '0':
									$results[$model_name][$result_counter]['code'] = $val_tmp;
									break;
								case '1':
									$results[$model_name][$result_counter]['code_id'] = $val_tmp;
									break;
								case '2':
									$results[$model_name][$result_counter]['load'] = $val_tmp;
									break;
								case '3':
									$results[$model_name][$result_counter]['pull_load'] = $val_tmp;
									break;
								case '4':
									$results[$model_name][$result_counter]['speed'] = $val_tmp;
									break;
								case '5':
									$results[$model_name][$result_counter]['stroke'] = $val_tmp;
									break;
								case '6':
									$results[$model_name][$result_counter]['retracted_length'] = $val_tmp;
									break;
								case '7':
									$results[$model_name][$result_counter]['voltage'] = $val_tmp;
									break;
								case '8':
									$results[$model_name][$result_counter]['power_consumption'] = $val_tmp;
									break;
								case '9':
									$results[$model_name][$result_counter]['current_consumption'] = $val_tmp;
									break;
								case '10':
									$results[$model_name][$result_counter]['duty'] = $val_tmp;
									break;
								case '11':
									$results[$model_name][$result_counter]['ambient_temp'] = $val_tmp;
									break;
								case '12':
									$results[$model_name][$result_counter]['type_of_protection'] = $val_tmp;
									break;
								case '13':
									$results[$model_name][$result_counter]['weight'] = $val_tmp;
									break;
								case '14':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['certificato'] = $val_tmp;
									break;
								case '15':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['optional_e'] = $val_tmp;
									break;
								case '16':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['optional_p'] = $val_tmp;
									break;
								case '17':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['optional_t'] = $val_tmp;
									break;
								case '18':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['optional_w'] = $val_tmp;
									break;
								case '19':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['optional_l'] = $val_tmp;
									break;
								case '20':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['optional_u'] = $val_tmp;
									break;
								case '21':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['optional_i'] = $val_tmp;
									break;
								case '22':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['optional_s'] = $val_tmp;
									break;
								case '23':
									$results[$model_name][$result_counter]['application_auto'] = $val_tmp;
									break;
								case '24':
									$results[$model_name][$result_counter]['application_medi'] = $val_tmp;
									break;
								case '25':
									$results[$model_name][$result_counter]['application_fobe'] = $val_tmp;
									break;
								case '26':
									$results[$model_name][$result_counter]['application_pupa'] = $val_tmp;
									break;
								case '27':
									$results[$model_name][$result_counter]['application_oilg'] = $val_tmp;
									break;
								case '28':
									$results[$model_name][$result_counter]['application_buil'] = $val_tmp;
									break;
								case '29':
									$results[$model_name][$result_counter]['application_offh'] = $val_tmp;
									break;
								case '30':
									$results[$model_name][$result_counter]['application_sola'] = $val_tmp;
									break;
								case '31':
									$results[$model_name][$result_counter]['application_heal'] = $val_tmp;
									break;
								case '32':
									$results[$model_name][$result_counter]['application_stee'] = $val_tmp;
									break;
								case '33':
									$results[$model_name][$result_counter]['application_offi'] = $val_tmp;
									break;
								case '34':
//todo: gestione immagini
									$results[$model_name][$result_counter]['image'] = $val_tmp;
									break;
								case '35':
//todo: gestione link
									$results[$model_name][$result_counter]['file_pdf'] = $val_tmp;
									break;
								case '36':
//todo: gestione link
									$results[$model_name][$result_counter]['file_drawing'] = $val_tmp;
									break;
								case '37':
//todo: gestione link
									$results[$model_name][$result_counter]['link'] = $val_tmp;
									break;
								case '38':
//todo: gestione link
									$results[$model_name][$result_counter]['verify_performance'] = $val_tmp;
									break;
								case '39':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['self_locking'] = $val_tmp;
									break;

								default:
							}
						}
						$result_counter ++;
					}
/*
pr('$results');
pr($results);
pr('$result_counter' . $result_counter);
exit();
*/

				// salvo i dati importati
					if (is_array($results[$model_name]) && !empty($results[$model_name])) {
						if ($this->$model_name->saveAll($results[$model_name])) {
							$msg_result_import[] = __('Uploaded data saved', true);
							$msg_result_import[] = sprintf(__('Record saved: %s', true), $result_counter);
						} else {
							$msg_result_import[] = __('Uploaded data NOT saved', true);
// TODO: elimino eventuali dati salvati??
						}
					} else {
						$msg_result_import[] = __('Uploaded data saved', true);
					}
				} else {
					$msg_result_import[] = __('Uploaded data is NOT valid', true);
				}

			}

		}

		if (!empty($msg_result_import)) {
			$this->Session->write('admin_import_result', implode('<br />', $msg_result_import));
			$this->redirect(array('action' => 'admin_import_result'));
		}

	}


// importazione file ProductsRotary
	function admin_rotary() {

		$msg_result_import = array();
		$errors = null;

		$str_si = 'si';
		$model_name = 'ProductsRotary';
		$product_type_id = ID_PRODUCT_TYPE_ROTARY;
		$row_start = 2;

		$this->set('product_type_selected', $product_type_id);

		$results = array();
		$result_counter = 0;
		$results[$model_name][$result_counter] = array();

		if ($this->data) {
/*
pr('$this->data');
pr($this->data);
exit();
*/
			if ($this->Importfile->save($this->data)) {
				$msg_result_import[] = __('Upload file complete', true);
				$this->data = $this->Importfile->read(null, $this->Importfile->id);
			} else {
				$errors = $this->Importfile->invalidFields();
/*
pr('Upload file error: $errors');
pr($errors);
exit();
*/
				$msg_result_import[] = __('Upload file error, please try again', true);
			}

			if (!$errors) {

		    // carico file PHPExcel
				$this->_initPHPExcel();
				$objReader = PHPExcel_IOFactory::createReader('Excel5');
				$objReader->setReadDataOnly(true);

			// leggo file xls uplodato
				$file_import_name = $this->data['Importfile']['file_name'];
				$file_import_url = WWW_ROOT . $this->data['Importfile']['file_dir']. DS . $file_import_name;
				$objPHPExcel = PHPExcel_IOFactory::load($file_import_url);

			// verifico composizione file xls e validità formale dei dati ...
				$file_import_valid = $this->_verify_file_import_format($objPHPExcel, $product_type_id);

				if ($file_import_valid) {

					$msg_result_import[] = __('Uploaded data is valid', true);

				// elimino i record esistenti
					$conditions_delete = '1 = 1';
					$this->$model_name->deleteAll($conditions_delete);

				// leggo dati dell'xls da inserire a db
					$sheetIndex = 0;
					$objWorksheet = $objPHPExcel->setActiveSheetIndex($sheetIndex);
					$highestRow = $objWorksheet->getHighestRow(); // e.g. 10
					$highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
					$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5

					for ($row = $row_start; $row <= $highestRow; ++$row) {
						for ($col = 0; $col < $highestColumnIndex; ++$col) {
							$val_tmp = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
							$val_tmp = trim($val_tmp);
//pr('$col ' . $col . ' - $row ' . $row . ' - $val_tmp ' . $val_tmp);

							switch ($col) {
								case '0':
									$results[$model_name][$result_counter]['code'] = $val_tmp;
									break;
								case '1':
									$results[$model_name][$result_counter]['code_id'] = $val_tmp;
									break;
								case '2':
									$results[$model_name][$result_counter]['load'] = $val_tmp;
									break;
								case '3':
									$results[$model_name][$result_counter]['speed'] = $val_tmp;
									break;
								case '4':
									$results[$model_name][$result_counter]['size'] = $val_tmp;
									break;
								case '5':
									$results[$model_name][$result_counter]['voltage'] = $val_tmp;
									break;
								case '6':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['optional_e'] = $val_tmp;
									break;
								case '7':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['optional_m'] = $val_tmp;
									break;
								case '8':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['optional_x'] = $val_tmp;
									break;
								case '9':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['optional_t'] = $val_tmp;
									break;
								case '10':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['optional_o'] = $val_tmp;
									break;
								case '11':
									//$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['application_auto'] = $val_tmp;
									break;
								case '12':
									//$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['application_oilg'] = $val_tmp;
									break;
								case '13':
									//$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['application_cars'] = $val_tmp;
									break;
								case '14':
									//$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['application_sola'] = $val_tmp;
									break;
								case '15':
									//$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['application_heal'] = $val_tmp;
									break;
								case '16':
//todo: gestione immagini
									$results[$model_name][$result_counter]['image'] = $val_tmp;
									break;
								case '17':
//todo: gestione link
									$results[$model_name][$result_counter]['file_pdf'] = $val_tmp;
									break;
								case '18':
//todo: gestione link
									$results[$model_name][$result_counter]['file_drawing'] = $val_tmp;
									break;
								case '19':
//todo: gestione link
									$results[$model_name][$result_counter]['link'] = $val_tmp;
									break;
								default:
							}
						}
						$result_counter ++;
					}
/*
pr('$results');
pr($results);
pr('$result_counter' . $result_counter);
exit();
*/

				// salvo i dati importati
					if (is_array($results[$model_name]) && !empty($results[$model_name])) {
						if ($this->$model_name->saveAll($results[$model_name])) {
							$msg_result_import[] = __('Uploaded data saved', true);
							$msg_result_import[] = sprintf(__('Record saved: %s', true), $result_counter);
						} else {
							$msg_result_import[] = __('Uploaded data NOT saved', true);
// TODO: elimino eventuali dati salvati??
						}
					} else {
						$msg_result_import[] = __('Uploaded data saved', true);
					}
				} else {
					$msg_result_import[] = __('Uploaded data is NOT valid', true);
				}

			}

		}

		if (!empty($msg_result_import)) {
			$this->Session->write('admin_import_result', implode('<br />', $msg_result_import));
			$this->redirect(array('action' => 'admin_import_result'));
		}

	}


// importazione file ProductsControl
	function admin_control() {

		$msg_result_import = array();
		$errors = null;

		$str_si = 'si';
		$model_name = 'ProductsControl';
		$product_type_id = ID_PRODUCT_TYPE_CONTROL;
		$row_start = 2;

		$this->set('product_type_selected', $product_type_id);

		$results = array();
		$result_counter = 0;
		$results[$model_name][$result_counter] = array();

		if ($this->data) {
/*
pr('$this->data');
pr($this->data);
exit();
*/
			if ($this->Importfile->save($this->data)) {
				$msg_result_import[] = __('Upload file complete', true);
				$this->data = $this->Importfile->read(null, $this->Importfile->id);
			} else {
				$errors = $this->Importfile->invalidFields();
/*
pr('Upload file error: $errors');
pr($errors);
exit();
*/
				$msg_result_import[] = __('Upload file error, please try again', true);
			}

			if (!$errors) {

		    // carico file PHPExcel
				$this->_initPHPExcel();
				$objReader = PHPExcel_IOFactory::createReader('Excel5');
				$objReader->setReadDataOnly(true);

			// leggo file xls uplodato
				$file_import_name = $this->data['Importfile']['file_name'];
				$file_import_url = WWW_ROOT . $this->data['Importfile']['file_dir']. DS . $file_import_name;
				$objPHPExcel = PHPExcel_IOFactory::load($file_import_url);

			// verifico composizione file xls e validità formale dei dati ...
				$file_import_valid = $this->_verify_file_import_format($objPHPExcel, $product_type_id);

				if ($file_import_valid) {

					$msg_result_import[] = __('Uploaded data is valid', true);

				// elimino i record esistenti
					$conditions_delete = '1 = 1';
					$this->$model_name->deleteAll($conditions_delete);

				// leggo dati dell'xls da inserire a db
					$sheetIndex = 0;
					$objWorksheet = $objPHPExcel->setActiveSheetIndex($sheetIndex);
					$highestRow = $objWorksheet->getHighestRow(); // e.g. 10
					$highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
					$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5

					for ($row = $row_start; $row <= $highestRow; ++$row) {
						for ($col = 0; $col < $highestColumnIndex; ++$col) {
							$val_tmp = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
							$val_tmp = trim($val_tmp);
//pr('$col ' . $col . ' - $row ' . $row . ' - $val_tmp ' . $val_tmp);

							switch ($col) {
								case '0':
									$results[$model_name][$result_counter]['code'] = $val_tmp;
									break;
								case '1':
									$results[$model_name][$result_counter]['code_id'] = $val_tmp;
									break;
								case '2':
									$results[$model_name][$result_counter]['motor'] = $val_tmp;
									break;
								case '3':
									$results[$model_name][$result_counter]['operating_device_ports'] = $val_tmp;
									break;
								case '4':
									$results[$model_name][$result_counter]['battery_ports'] = $val_tmp;
									break;
								case '5':
									$results[$model_name][$result_counter]['limit_switch_ports'] = $val_tmp;
									break;
								case '6':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['single_fault_safety'] = $val_tmp;
									break;
								case '7':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['encoder_processing'] = $val_tmp;
									break;
								case '8':
									$results[$model_name][$result_counter]['input'] = $val_tmp;
									break;
								case '9':
									$results[$model_name][$result_counter]['frequency'] = $val_tmp;
									break;
								case '10':
									$results[$model_name][$result_counter]['input_current_max'] = $val_tmp;
									break;
								case '11':
									$results[$model_name][$result_counter]['standby_power'] = $val_tmp;
									break;
								case '12':
									$results[$model_name][$result_counter]['output_voltage'] = $val_tmp;
									break;
								case '13':
									$results[$model_name][$result_counter]['output'] = $val_tmp;
									break;
								case '14':
									$results[$model_name][$result_counter]['duty_cycle_intermittent'] = $val_tmp;
									break;
								case '15':
									$results[$model_name][$result_counter]['duty_cycle_short_time'] = $val_tmp;
									break;
								case '16':
									$results[$model_name][$result_counter]['ambient_temperature'] = $val_tmp;
									break;
								case '17':
									$results[$model_name][$result_counter]['humidity'] = $val_tmp;
									break;
								case '18':
									$results[$model_name][$result_counter]['type_of_protection'] = $val_tmp;
									break;
								case '19':
									$results[$model_name][$result_counter]['approvals'] = $val_tmp;
									break;
								case '20':
									$results[$model_name][$result_counter]['weight_without_battery'] = $val_tmp;
									break;
								case '21':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['functionality_b'] = $val_tmp;
									break;
								case '22':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['functionality_z'] = $val_tmp;
									break;
								case '23':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['functionality_p'] = $val_tmp;
									break;
								case '24':
									$val_tmp = ($val_tmp == $str_si) ? 1 : 0;
									$results[$model_name][$result_counter]['functionality_c'] = $val_tmp;
									break;
								case '25':
									$results[$model_name][$result_counter]['application_auto'] = $val_tmp;
									break;
								case '26':
									$results[$model_name][$result_counter]['application_hoof'] = $val_tmp;
									break;
								case '27':
									$results[$model_name][$result_counter]['application_medi'] = $val_tmp;
									break;
								case '28':
									$results[$model_name][$result_counter]['application_buil'] = $val_tmp;
									break;
								case '29':
									$results[$model_name][$result_counter]['application_heal'] = $val_tmp;
									break;
								case '30':
//todo: gestione immagini
									$results[$model_name][$result_counter]['image'] = $val_tmp;
									break;

								case '31':
//todo: gestione link
									$results[$model_name][$result_counter]['file_pdf'] = $val_tmp;
									break;
								case '32':
//todo: gestione link
									$results[$model_name][$result_counter]['file_drawing'] = $val_tmp;
									break;

								case '33':
//todo: gestione link
									$results[$model_name][$result_counter]['link'] = $val_tmp;
									break;

								default:
							}
						}
						$result_counter ++;
					}
/*
pr('$results');
pr($results);
pr('$result_counter' . $result_counter);
exit();
*/

				// salvo i dati importati
					if (is_array($results[$model_name]) && !empty($results[$model_name])) {
						if ($this->$model_name->saveAll($results[$model_name])) {
							$msg_result_import[] = __('Uploaded data saved', true);
							$msg_result_import[] = sprintf(__('Record saved: %s', true), $result_counter);
						} else {
							$msg_result_import[] = __('Uploaded data NOT saved', true);
// TODO: elimino eventuali dati salvati??
						}
					} else {
						$msg_result_import[] = __('Uploaded data saved', true);
					}
				} else {
					$msg_result_import[] = __('Uploaded data is NOT valid', true);
				}

			}

		}

		if (!empty($msg_result_import)) {
			$this->Session->write('admin_import_result', implode('<br />', $msg_result_import));
			$this->redirect(array('action' => 'admin_import_result'));
		}

	}


// importazione file ProductsAccessory
	function admin_accessory() {

		$msg_result_import = array();
		$errors = null;

		$str_si = 'si';
		$model_name = 'ProductsAccessory';
		$product_type_id = ID_PRODUCT_TYPE_ACCESSORY;
		$row_start = 2;

		$this->set('product_type_selected', $product_type_id);

		$results = array();
		$result_counter = 0;
		$results[$model_name][$result_counter] = array();

		if ($this->data) {
/*
pr('$this->data');
pr($this->data);
exit();
*/
			if ($this->Importfile->save($this->data)) {
				$msg_result_import[] = __('Upload file complete', true);
				$this->data = $this->Importfile->read(null, $this->Importfile->id);
			} else {
				$errors = $this->Importfile->invalidFields();
/*
pr('Upload file error: $errors');
pr($errors);
exit();
*/
				$msg_result_import[] = __('Upload file error, please try again', true);
			}

			if (!$errors) {

		    // carico file PHPExcel
				$this->_initPHPExcel();
				$objReader = PHPExcel_IOFactory::createReader('Excel5');
				$objReader->setReadDataOnly(true);

			// leggo file xls uplodato
				$file_import_name = $this->data['Importfile']['file_name'];
				$file_import_url = WWW_ROOT . $this->data['Importfile']['file_dir']. DS . $file_import_name;
				$objPHPExcel = PHPExcel_IOFactory::load($file_import_url);

			// verifico composizione file xls e validità formale dei dati ...
				$file_import_valid = $this->_verify_file_import_format($objPHPExcel, $product_type_id);

				if ($file_import_valid) {

					$msg_result_import[] = __('Uploaded data is valid', true);

				// elimino i record esistenti
					$conditions_delete = '1 = 1';
					$this->$model_name->deleteAll($conditions_delete);

				// leggo dati dell'xls da inserire a db
					$sheetIndex = 0;
					$objWorksheet = $objPHPExcel->setActiveSheetIndex($sheetIndex);
					$highestRow = $objWorksheet->getHighestRow(); // e.g. 10
					$highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
					$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5

					for ($row = $row_start; $row <= $highestRow; ++$row) {
						for ($col = 0; $col < $highestColumnIndex; ++$col) {
							$val_tmp = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
							$val_tmp = trim($val_tmp);
//pr('$col ' . $col . ' - $row ' . $row . ' - $val_tmp ' . $val_tmp);

							switch ($col) {
								case '0':
									$results[$model_name][$result_counter]['code'] = $val_tmp;
									break;
								case '1':
									$results[$model_name][$result_counter]['power'] = $val_tmp;
									break;
								case '2':
									$results[$model_name][$result_counter]['channels'] = $val_tmp;
									break;
								case '3':
									$results[$model_name][$result_counter]['type_of_protection'] = $val_tmp;
									break;
								case '4':
									$results[$model_name][$result_counter]['colour'] = $val_tmp;
									break;
								case '5':
									$results[$model_name][$result_counter]['img'] = $val_tmp;
									break;
//todo: gestione link
								case '6':
									$results[$model_name][$result_counter]['file_pdf'] = $val_tmp;
									break;
								case '7':
//todo: gestione link
									$results[$model_name][$result_counter]['file_drawing'] = $val_tmp;
									break;
								case '8':
//todo: gestione link
									$results[$model_name][$result_counter]['link'] = $val_tmp;
									break;
								default:
							}
						}
						$result_counter ++;
					}
/*
pr('$results');
pr($results);
pr('$result_counter' . $result_counter);
exit();
*/

				// salvo i dati importati
					if (is_array($results[$model_name]) && !empty($results[$model_name])) {
						if ($this->$model_name->saveAll($results[$model_name])) {
							$msg_result_import[] = __('Uploaded data saved', true);
							$msg_result_import[] = sprintf(__('Record saved: %s', true), $result_counter);
						} else {
							$msg_result_import[] = __('Uploaded data NOT saved', true);
// TODO: elimino eventuali dati salvati??
						}
					} else {
						$msg_result_import[] = __('Uploaded data saved', true);
					}
				} else {
					$msg_result_import[] = __('Uploaded data is NOT valid', true);
				}

			}

		}

		if (!empty($msg_result_import)) {
			$this->Session->write('admin_import_result', implode('<br />', $msg_result_import));
			$this->redirect(array('action' => 'admin_import_result'));
		}

	}


// importazione file ProductsAssociation
	function admin_association() {

		$msg_result_import = array();
		$errors = null;

		$str_si = 'si';
		$model_name = 'ProductsAssociation';
		$product_type_id = ID_PRODUCT_TYPE_ASSOCIATION;
		$row_start = 2;

		$this->set('product_type_selected', $product_type_id);

		$results = array();
		$result_counter = 0;
		$results[$model_name][$result_counter] = array();

		if ($this->data) {
/*
pr('$this->data');
pr($this->data);
//exit();
*/
			if ($this->Importfile->save($this->data)) {
				$msg_result_import[] = __('Upload file complete', true);
				$this->data = $this->Importfile->read(null, $this->Importfile->id);
			} else {
				$errors = $this->Importfile->invalidFields();
/*
pr('Upload file error: $errors');
pr($errors);
exit();
*/
				$msg_result_import[] = __('Upload file error, please try again', true);
			}

			if (!$errors) {

		    // carico file PHPExcel
				$this->_initPHPExcel();
				$objReader = PHPExcel_IOFactory::createReader('Excel5');
				$objReader->setReadDataOnly(true);

			// leggo file xls uplodato
				$file_import_name = $this->data['Importfile']['file_name'];
				$file_import_url = WWW_ROOT . $this->data['Importfile']['file_dir']. DS . $file_import_name;
				$objPHPExcel = PHPExcel_IOFactory::load($file_import_url);

			// verifico composizione file xls e validità formale dei dati ...
				$file_import_valid = $this->_verify_file_import_format($objPHPExcel, $product_type_id);

				if ($file_import_valid) {

					$msg_result_import[] = __('Uploaded data is valid', true);

				// elimino i record esistenti
					$conditions_delete = '1 = 1';
					$this->$model_name->deleteAll($conditions_delete);

				// leggo dati dell'xls da inserire a db
					$sheetIndex = 0;
					$objWorksheet = $objPHPExcel->setActiveSheetIndex($sheetIndex);
					$highestRow = $objWorksheet->getHighestRow(); // e.g. 10
					$highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
					$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5

					for ($row = $row_start; $row <= $highestRow; ++$row) {
						for ($col = 0; $col < $highestColumnIndex; ++$col) {
							$val_tmp = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
							$val_tmp = trim($val_tmp);
//pr('$col ' . $col . ' - $row ' . $row . ' - $val_tmp ' . $val_tmp);

							switch ($col) {
								case '0':
									$results[$model_name][$result_counter]['product_code_from'] = $val_tmp;
									break;
								case '1':
									$results[$model_name][$result_counter]['product_line_from'] = $val_tmp;
									break;
								case '2':
									$results[$model_name][$result_counter]['product_code_to'] = $val_tmp;
									break;
								case '3':
									$results[$model_name][$result_counter]['product_line_to'] = $val_tmp;
									break;

								default:
							}
						}
						$result_counter ++;
					}
/*
pr('$results');
pr($results);
pr('$result_counter' . $result_counter);
exit();
*/

				// salvo i dati importati
					if (is_array($results[$model_name]) && !empty($results[$model_name])) {
						if ($this->$model_name->saveAll($results[$model_name])) {
							$msg_result_import[] = __('Uploaded data saved', true);
							$msg_result_import[] = sprintf(__('Record saved: %s', true), $result_counter);
						} else {
							$msg_result_import[] = __('Uploaded data NOT saved', true);
// TODO: elimino eventuali dati salvati??
						}
					} else {
						$msg_result_import[] = __('Uploaded data saved', true);
					}
				} else {
					$msg_result_import[] = __('Uploaded data is NOT valid', true);
				}

			}

		}

		if (!empty($msg_result_import)) {
			$this->Session->write('admin_import_result', implode('<br />', $msg_result_import));
			$this->redirect(array('action' => 'admin_import_result'));
		}

	}


	function admin_import_result () {
			$import_result = $this->Session->read('admin_import_result');
			$this->set('import_result', $import_result);
	}


	private function _verify_file_import_format($objPHPExcel, $product_type_id = null) {

		$result = false;
		$import_product_ctrl = array();

		if ($product_type_id == ID_PRODUCT_TYPE_LINEAR) {
			$import_product_ctrl = unserialize(IMPORT_PRODUCT_TYPE_LINEAR);
		}
		if ($product_type_id == ID_PRODUCT_TYPE_PILLAR) {
			$import_product_ctrl = unserialize(IMPORT_PRODUCT_TYPE_PILLAR);
		}
		if ($product_type_id == ID_PRODUCT_TYPE_CONTROL) {
			$import_product_ctrl = unserialize(IMPORT_PRODUCT_TYPE_CONTROL);
		}
		if ($product_type_id == ID_PRODUCT_TYPE_ROTARY) {
			$import_product_ctrl = unserialize(IMPORT_PRODUCT_TYPE_ROTARY);
		}
		if ($product_type_id == ID_PRODUCT_TYPE_ACCESSORY) {
			$import_product_ctrl = unserialize(IMPORT_PRODUCT_TYPE_ACCESSORY);
		}
		if ($product_type_id == ID_PRODUCT_TYPE_ASSOCIATION) {
			$import_product_ctrl = unserialize(IMPORT_PRODUCT_TYPE_ASSOCIATION);
		}

		if (!empty($import_product_ctrl)) {
		// leggo dati prima riga xls per verificare tracciato import
			$sheetIndex = 0;
			$objWorksheet = $objPHPExcel->setActiveSheetIndex($sheetIndex);
			$highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
			$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5

			for ($row = 1; $row < 2; ++$row) {
				for ($col = 0; $col < $highestColumnIndex; ++$col) {
					$val_tmp = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
// pr('$row ' . $row . ' - $col ' . $col . ' - $val_tmp ' . $val_tmp . ' - $import_product_ctrl[$col] ' . $import_product_ctrl[$col]);
					if ($val_tmp == $import_product_ctrl[$col]) {
						$result = true;
					} else {
						$result = false;
						break;
					}
				}
			}
		}

//TODO: controlli aggiuntivi?

		return $result;
	}

}
?>
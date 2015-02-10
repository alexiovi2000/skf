<?php
class Importfile extends AppModel {

	var $name = 'Importfile';

    var $actsAs = array (
					'Trackable',
					'DateFormatter',

					'MeioUpload.MeioUpload' => array (
						'file_name' => array (
			                'dir' => 'uploads{DS}{ModelName}{DS}{fieldName}',
			                'thumbnails' => false,
							'maxSize' => UPLOAD_MAX_FILE_SIZE_BYTE,
							'allowedMime' => array(
/*
							'application/excel','application/vnd.ms-excel','application/x-excel','application/x-msexcel'
*/

//TODO: verificare !!!
            					'application/x-msdownload',
            					'application/octet-stream',
                                'application/application/x-msdownload',
								'application/vnd.ms-excel',
								'application/msexcel',
								'application/x-msexcel',
								'application/x-ms-excel',
								'application/x-excel',
								'application/x-dos_ms_excel',
								'application/xls',
								'application/x-xls'

							),
							'allowedExt' => array('.xls', '.XLS'),
							'fields' => array (
								'dir' => 'file_dir',
								'filesize' => 'file_size',
								'mimetype' => 'file_mimetype'
							)
						)
					)

				);


// xlsx
//'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
//'.xlsx', '.XLSX'

// xls
//'application/excel','application/vnd.ms-excel','application/x-excel','application/x-msexcel'
//'.xls', '.XLS'

/*
	var $validate = array(

        'actuator_type_id' => array(

             'notempty' => array(
                'rule' => 'notempty',
                // 'required' => true,
                'message' => 'required field',
                'last' => true
            ),

           'numeric' => array(
                'rule' => 'numeric',
                // 'required' => true,
                'message' => 'only number',
                'last' => true
            ),

        ),


	);
*/



/*
	function beforeDelete() {

		$data_tmp = $this->read(null, $this->id);

		if (isset($data_tmp[$this->alias]['file_dir']) && isset($data_tmp[$this->alias]['file_name'])) {
			$file_tmp = WWW_ROOT . $data_tmp[$this->alias]['file_dir'] . DS . $data_tmp[$this->alias]['file_name'];
			if ( file_exists($file_tmp) && is_file($file_tmp) ) {
				unlink($file_tmp);
			}
		}

		return true;

	}
*/

}
?>
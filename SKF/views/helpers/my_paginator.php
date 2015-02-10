<?php
/**
 * MyPagination Helper class file.
 *
 * Extend pagination helper
 */
/**
 *
 * MyPaginationHelper encloses all methods to extend Pagination Helper class
 *
 */
class MyPaginatorHelper extends PaginatorHelper {

	var $helpers = array('Html','CropAjax','MyForm');
/**
 * Generates a plain or Ajax link with pagination parameters
 *
 * @param  string $title Title for the link.
 * @param  mixed $url Url for the action. See Router::url()
 * @param  array $options Options for the link. See #options for list of keys.
 * @return string A link with pagination parameters.
 */
	function link($title, $url = array(), $options = array()) {
		$options = array_merge(array('model' => null, 'escape' => true), $options);
		$model = $options['model'];
		unset($options['model']);

		if (!empty($this->options)) {
			$options = array_merge($this->options, $options);
		}
		if (isset($options['url'])) {
			$url = array_merge((array)$options['url'], (array)$url);
			unset($options['url']);
		}
		$url = $this->url($url, true, $model);

		$obj = isset($options['update']) ? 'CropAjax' : 'Html';
//pr($options);
		$url = array_merge(array('page' => $this->current($model)), $url);
		$url = array_merge(Set::filter($url, true), array_intersect_key($url, array('plugin'=>true)));
		return $this->{$obj}->link($title, $url, $options);
	}


    /**
    * Returns the number of the first page record
    * same as start used into the counter method
    */
    function startPageRecordNumber() {
        $paging = $this->params();
        $startRecord = 0;
        if ($paging['count'] >= 1) {
                $startRecord = (($paging['page'] - 1) * $paging['options']['limit']);
        }
        return $startRecord;
    }

}
?>
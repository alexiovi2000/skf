<?php
$class_add = isset($class_add) ? $class_add : '';
?>
<div class="row-fluid <?php echo $class_add ?>">
    <div class="span12">
        <ul class="nav nav-pills">
<?php
//pr($nav_pills_data);
//pr($nav_pills_data);
//pr('$url_selected  ' . $url_selected );

	$nav_pills_selected = isset($nav_pills_data) ? $nav_pills_data : array();

	foreach($nav_pills_selected as $key => $value) {
//pr('$value');
//pr($value );
	// inizializzo dati
		$name_tmp = $value['name'];
		$url_tmp = '/'.$value['slug'];
		$url_ctrl_tmp = $value['url_ctrl'];
//pr('$url_ctr_tmp  ' .$url_ctr_tmp );
	// verifico voce selezionata
		if ( isset($url_selected) && strpos ( $url_selected , $url_ctrl_tmp ) === 0 ) {
			$class_active_tmp = ' class="active"';
		} else {
			$class_active_tmp = '';
		}
?>
          <li<?php echo $class_active_tmp ?>><a href="<?php echo $this->Html->url($url_tmp); ?>"><?php echo $name_tmp ?></a></li>
<?php
	}
?>
        </ul>
<?php /* ?>
        <!--VERSIONE 2.0 -->
        <span style="font-weight:bold;color:#DA1E3C;">Version 2.0</span>
<?php */ ?>     
    </div>
</div>
<?php
// X caricare css / js da view in layout
	$html->css("stile-mono", null, array("inline"=>false));
?>
    <div id="mono_colonna">
    	<div id="parte_sx">
        	<div id="intestazione_sx_vuota">
        	
            </div>
        </div>

    	<div id="parte_dx">
<?php echo $this->element('public/box_login'); ?>
        </div>

    </div>

    <div class="clearing"><!-- --></div>
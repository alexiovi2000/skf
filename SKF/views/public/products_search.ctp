<div class="wide-content">
    <div class="campaign">        
        <div class="banner">
            <a class="link" href="#">
                <img alt="Knowledge gets noticed" src="http://www.skf.com/binary/21-168562/14-0961-Blank_Banner_skfcom_940x230.jpg">
                <div class="content2">
                    <h2 class="blue">Knowledge gets noticed</h2>
                    <p class="blue">See how Apple profiles SKF</p>
                    <span class="readmore">Click here</span>
                </div>
            </a>
        </div>
        <div class="banner">
            <a class="link" href="#">
                <img alt="Collaboration Has Power" src="http://www.skf.com/binary/21-164627/EN_Story8_Collaboration_blank_banner_942x231.jpg">                
                <div class="content2">
                    <h2 class="blue">Collaboration Has Power</h2>
                    <p class="blue">Custom-made predictive maintenance</p>
                    <span class="readmore">Click here</span>
                </div>
            </a>
        </div>
        <div class="banner">
            <a class="link" href="#">
                <img alt="Empowering our customers" src="http://www.skf.com/binary/21-154680/beyondzero_942x231_2.jpg">                
                <div class="content2">
                    <h2 class="">Empowering our customers</h2>
                    <p class="">Developing products and services that deliver significant environmental benefits. Go BeyondZero.</p>
                    <span class="readmore blue">Go to portfolio</span>
                </div>
            </a>
        </div>
        <div class="banner">
            <a class="link" href="#">
                <img alt="Wind energy" src="http://www.skf.com/binary/21-107473/12-0767-Homepage2-940x230.jpg">
                <div class="content2">
                    <h2 class="">The Power of Knowledge Engineering</h2>
                    <p class="">See how SKF combines technologies to create application-specific solutions.</p>
                    <span class="readmore">Go to case stories </span>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="product_lines">
<h2><?php echo __('Product Search', true); ?></h2>
<h6><?php echo __('description application home', true); ?></h6>
<div class="list_box six">
<?php

$items_conter = 0;

//unset($public_menu_items[ID_PRODUCT_TYPE_ACCESSORY]);
foreach($public_menu_items as $key_item => $value_item) {
	$items_conter ++;
	$menu_name = $value_item['name'];
	$menu_description = $value_item['description'];
	$menu_link = $html->url('/'.$value_item['slug']);  
?>
	<div class="product_line">
        <div class="product_line_image" id="<?=$value_item['slug']?>">
            <a href="#">
                <?php echo $html -> image('/img/skf_products_lines/'.$value_item['slug'].'.jpg', array('width' => 155, 'height' => 155, 'alt' => $menu_name, 'title' => $menu_name));?>
            </a>
        </div>
        
        <div class="product_line_name">
            <span><?php echo $menu_name; ?></span>
        </div>

	</div>
<?php
} ?>
<div id="dialog">
</div>
	<div class="product_line">
        <div id="products-search" class="product_line_image">
            <a href="#">
                <img width="67" height="67" title="Search" alt="Search" src=""></a>
        </div>        
        <div class="product_line_name">
            <span>Search</span>
        </div>

	</div>
</div>
<div id="ac_dc_nom">
	<div class="ac_dc_nomotor" id="telescopic_pillar_acdcnm">
    	<div class="product_line_title">
			<?php echo __('nome prodotto pillar', true); ?>
        </div>        
        <div class="product_line_description">
            <p><?php echo __('descrizione prodotto pillar', true); ?></p>
        </div>
        <div class="list_box three">
        	<div class="subfilter">
            	<div class="subfilter_image">
                    <a id="telescopic_ac_id" href="#">AC</a>
                </div>
                <div class="subfilter_name">
                	<span>AC</span>
                </div>
            </div>
            <div class="subfilter">
            	<div class="subfilter_image">
                    <a id="telescopic_dc_id" href="#">DC</a>
                </div>  
                <div class="subfilter_name">	
                	<span>DC</span>
                </div>
            </div>
            <div class="subfilter">
            	<div class="subfilter_image">
                    <a id="telescopic_nm_id" href="#">No motors</a>
                </div>
                <div class="subfilter_name">
                	<span>No motors</span>
                </div>
            </div>
        </div>       
	</div>
	<div class="ac_dc_nomotor" id="linear_actuators_acdcnm">
    	<div class="product_line_title">
			<?php echo __('nome prodotto linear', true); ?>
        </div>        
        <div class="product_line_description">
            <p><?php echo __('descrizione prodotto linear', true); ?></p>
        </div>
    	<div class="list_box three">
	        <div class="subfilter">
            	<div class="subfilter_image">
                	<a href="#" id="linear_ac_id">AC</a>
                </div>
                <div class="subfilter_name">
                	<span>AC</span>
                </div>
	        </div>
	        <div class="subfilter">
            	<div class="subfilter_image">
                	<a href="#" id="linear_dc_id">DC</a>
                </div>
                <div class="subfilter_name">
                	<span>DC</span>
                </div>
	        </div>
	        <div class="subfilter">
            	<div class="subfilter_image">
                	<a href="#" id="linear_nm_id">No motors</a>
                </div>
                <div class="subfilter_name">
                	<span>No motors</span>
                </div>
	        </div>
		</div> 
	</div>
	<div class="ac_dc_nomotor" id="control_unit_acdc">
    	<div class="product_line_title">
			<?php echo __('nome prodotto control', true); ?>
        </div>        
        <div class="product_line_description">
            <p><?php echo __('descrizione prodotto control', true); ?></p>
        </div>
		<div class="list_box two">
	        <div class="subfilter">
            	<div class="subfilter_image">
                	<a href="#" id="control_ac_id">AC</a>
                </div>
                <div class="subfilter_name">
                	<span>AC</span>
                </div>
	        </div>
	        <div class="subfilter">
            	<div class="subfilter_image">
                	<a href="#" id="control_dc_id">DC</a>
                </div>
                <div class="subfilter_name">
                	<span>DC</span>
                </div>
	        </div>
        </div>
	</div>
</div>
<div class="content_search_box" id="content_search_id">
  	<fieldset class="fieldset" id="fieldset_search" >
  		<h2 class="filter_title">Select</h2>
		<div class="content_fieldset">
            <p id="medical_id"></p>
            <div class="combo_search" id="medical_combo_id">
           
                <select id="value_search" class="combo">
             
                </select>
                <span class="select-arrow"></span>
            </div>
	   		<p id="motor_shape_txt"></p>
	   		<div id="motor_shape_combo">
	   
	     		<select id="motor_shape_id" class="combo">
	     
	     		</select>
                <span class="select-arrow"></span>
	  		</div>
	  		<p id="free_search_text"></p>
	   		<div id="free_search">
	     		<input type="text" id="input_searchfree" class="textfield_class">
	  		</div>
	     	<div class="pulsanti">
	    		<input type="button" class="btn_search" value="Search" id="search_btn">
                <span>Search</span>
	    	</div>
	  	</div>
        
	</fieldset>
    <div class="result">
    	<div id="table_result">
    
        </div>
        <div class="clearfix"></div>
        <div id="paging_id">  
       
        </div>
    </div>  
   	

</div>
</div>
<?php  ?>
<div class="row"></div>
<?php 
echo $this->Html->css('custom') . "\n";
include('_js_home.ctp'); 
?>

<script type="text/javascript">

$(function() {
	$(".campaign").campaign();
});

</script>
<div class="product_lines">
<h2><?php echo __('title application home', true); ?></h2>
<h6><?php echo __('description application home', true); ?></h6>
<?php
//pr('$public_menu_items');
//pr($public_menu_items);
$items_conter = 0;

//unset($public_menu_items[ID_PRODUCT_TYPE_ACCESSORY]);
foreach($public_menu_items as $key_item => $value_item) {
	$items_conter ++;
	$menu_name = $value_item['name'];
	$menu_description = $value_item['description'];
	$menu_link = $html->url('/'.$value_item['slug']);
?>

	<div class="product_line">
<?php /* ?>
		<h2><a href="<?php echo $menu_link; ?>"><?php echo $menu_name ?></a></h2>
<?php */ ?>

<?php /* ?>
        <h2><?php echo $menu_name; ?></h2>
		<p><?php echo $menu_description; ?></p>
        <p><a class="btn" href="<?php echo $menu_link; ?>"><?php echo __('go to products', true); ?> &raquo;</a></p>
<?php */ ?>

        <div class="product_line_image">
            <a href="<?php echo $menu_link; ?>">
                <?php echo $html -> image('/img/skf_products_lines/'.$value_item['slug'].'.jpg', array('width' => 155, 'height' => 155, 'alt' => $menu_name, 'title' => $menu_name));?>
            </a>
        </div>

        <div class="product_line_name">
            <a class="btn" href="<?php echo $menu_link; ?>"><?php echo $menu_name; ?></a>
        </div>

	</div>
<?php
}
?>
</div>
<?php /* ?>
<div class="row"></div>
<?php */ ?>
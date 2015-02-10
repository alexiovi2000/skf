<?php $class_add = 'product_lines_navigation'; //' hidden-desktop' ?>

<?php echo $this->element('public/_nav-pills', array('nav_pills_data' => $nav_pills_data, 'class_add' => $class_add)); ?>


<div class="product_line_title">
    <?php echo __('nome prodotto linear', true); ?>
</div>

<div class="product_line_description">
    <p><?php echo __('descrizione prodotto linear', true); ?></p>
</div>

<div id="product_container" class="row-fluid">

    <?php include('products_linear_listsvil.ctp'); ?>

</div> 

<div class="product_search_note">
    <p><?php echo __('note search product', true); ?></p>
</div>
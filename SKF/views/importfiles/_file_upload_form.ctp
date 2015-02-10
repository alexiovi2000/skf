<?php
    $title_page_tmp = $my_page_title;
    $title_form_tmp = $my_form_title;
?>

<div id="content-top">
    <h2><?php echo $title_page_tmp;?></h2>
    <span class="clearFix">&nbsp;</span>
</div>

<!--
<div id="breadcrumbs">
    <p><strong>Breadcrumbs: </strong><?php echo $html->getCrumbs(' > '); ?></p>
</div>
-->

<div id="mid-col" class="full-col">

    <div class="box">
        <h4 class="white"><?php echo $title_page_tmp; ?></h4>
        <div class="box-container">

            <?php echo $this->MyForm->create('Importfile',array('class' => 'middle-forms', 'type' => 'file'));?>
            <?php echo $this->element('admin/form_field_required'); ?>

            <div class="button_bar_form">
                <?php echo $this->MyForm->submit(__('Save', true), array()); ?>
            </div>
            <span class="clearFix">&nbsp;</span>

            <fieldset>
                <legend><?php echo $title_form_tmp;?></legend>
				<p><strong>Choose a file:</strong></p>
				<?php echo $this->Form->input('product_type_id', array('type' => 'hidden', 'value' => $product_type_selected)); ?>
				<?php echo $this->MyForm->input('file_name',array('type' =>'file','label' => 'File')); ?>
				<p>
					<br /><strong>You can upload:</strong> only Excel Spreadsheet (XLS)
					<br /><strong>MAX FILE SIZE:</strong> <?php echo UPLOAD_MAX_FILE_SIZE; ?> MB
				</p>
            </fieldset>

            <div class="button_bar_form">
                <?php echo $this->MyForm->submit(__('Save', true), array()); ?>
            </div>
            <span class="clearFix">&nbsp;</span>

            <?php echo $this->MyForm->end();?>

        </div>

    </div>

</div>
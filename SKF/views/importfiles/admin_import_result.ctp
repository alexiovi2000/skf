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

            <fieldset>
                <legend><?php echo $title_form_tmp;?></legend>
				<?php echo $import_result; ?>
            </fieldset>

        </div>

    </div>

</div>
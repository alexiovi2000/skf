<div class="paging-description">
 <p>
    <?php
    echo $this->MyPaginator->counter(array(
    'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
    ));
    ?>
</p>
</div>
<div class="paging">
        	<?php echo $this->MyPaginator->first('<< ' .__('first',true) . ' ', array(), null, array('class'=>'disabled'));?>
            <?php echo $this->MyPaginator->prev('< '.__('previous', true) . ' ', array(), null, array('class'=>'disabled'));?>
          	&nbsp;&nbsp;&nbsp;<?php echo $this->MyPaginator->numbers();?>&nbsp;&nbsp;&nbsp;
        	<?php echo $this->MyPaginator->next(' ' . __('next', true). ' >', array(), null, array('class' => 'disabled'));?>
            <?php echo $this->MyPaginator->last(' ' . __('last',true). ' >>', array('class'=>'disabled'));?>
</div>
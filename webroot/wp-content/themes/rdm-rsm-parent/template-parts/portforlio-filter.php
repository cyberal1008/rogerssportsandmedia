<?php

?>
<div id="grid-filter-head">
    <span id="grid-filter-head-accent">FILTER</span>
    <span id="grid-filter-head-total"><?php echo (isset($args['total']) ? $args['total'] : ''); ?></span>
    <span id="grid-filter-head-unit"><?php echo (isset($args['unit-text']) ? $args['unit-text'] : 'results'); ?></span>
</div>
<?php 
if(isset($args['filters']) ) :
?>
<div class="grid-filters">
    <?php
    foreach($args['filters'] as $id=>$options) :
    ?>
    <div class="col-sm-12 col-md-6 col-lg-3 filter-wrap">
        <div class="select" tabindex="1" id="<?php echo $id ?>">
        <?php 
        $count = 0;
        foreach($options as $v=>$t) : 
        ?>
            <input class="selectopt" name="<?php echo $id ?>" type="radio" id="<?php echo $id.'-'.$v ?>" <?php echo ($count === 0 ? " checked" : "") ?>>
            <label for="<?php echo $id.'-'.$v ?>" class="option"><?php echo $t; ?></label>
        <?php
        $count++;
        endforeach; 
        ?>
        </div>
    </div>
    <?php
    endforeach;
    ?>
</div>
<?php
endif;
?>

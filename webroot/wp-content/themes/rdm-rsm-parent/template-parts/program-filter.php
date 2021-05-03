<?php
print_r($args);
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
    <div class="select" tabindex="1" id="<?php echo $id ?>">
    <?php 
    $count = 0;
    foreach($options as $v=>$t) : 
    ?>
        <input class="selectopt" name="<?php echo $id ?>" type="radio" id="<?php echo $id.'-'.$v ?>" <?php echo ($count === 0 ? " checked" : "") ?>>
        <label for="<?php echo $id.'-'.$v ?>" class="option"><?php echo $t ?></label>
    <?php
    $count++;
    endforeach; 
    ?>
    </div>
    <?php
    endforeach;
    ?>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown button
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
        </div>
    </div>
</div>
<?php
endif;
?>

<?php 
if(isset($args['filters']) ) :
?>
<div class="grid-filters filters grid four alt">
    <?php
    foreach($args['filters'] as $id=>$options) :
    ?>
	    <div class="filter-wrap">
	        <div class="select" tabindex="1" id="<?php echo $id ?>">
	        <?php 
	        $count = 0;
	        foreach($options as $v=>$t) : 
	        ?>
	            <input class="selectopt" name="<?php echo $id ?>" type="radio" value="<?php echo $v ?>" id="<?php echo $id.'-'.$v ?>" <?php echo ($count === 0 ? " checked" : "") ?>>
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
    <div class="input-wrap">
		<button id="progsubmit" type="submit" class="button" value="Apply" role="button" aria-label="Apply">Apply</button>
	</div>
</div>
<?php
endif;
?>

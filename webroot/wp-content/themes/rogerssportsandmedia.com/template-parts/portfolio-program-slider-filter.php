<?php 
if(isset($args['filters']) ) :
	$slug = isset($args['slug']) ? $args['slug'] : '';
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
	        	if ($id == 'shows-category') {
	        		if (isset($args['slug'])) {
	        			$checked = $v == $slug ? true : false;
	        		} else {
	        			$checked = $count === 0 ? true : false;
	        		}
	        	} else {
	        		$checked = $count === 0 ? true : false;
	        	}
	        ?>
	        	<input class="selectopt" name="<?php echo $id ?>" type="radio" value="<?php echo $v ?>" id="<?php echo $id.'-'.$v ?>" <?php echo ($checked == true ? " checked" : "") ?>>
	            
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
		<button id="progsubmit" type="submit" class="button progsubmit" value="Apply" role="button" aria-label="Apply">Apply</button>
	</div>
</div>
<?php
endif;
?>

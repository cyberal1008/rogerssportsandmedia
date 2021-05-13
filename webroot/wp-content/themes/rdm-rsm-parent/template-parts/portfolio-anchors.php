<?php
if ( ! isset( $args ) ) {
	return '';
}

foreach($args as $anchor => $text){
?>
<div class="portfolio-anchor">
    <a href="#<?php echo ($anchor) ?>">
        <?php echo ($text) ?>
    </a>
</div>
<?php
}
?>
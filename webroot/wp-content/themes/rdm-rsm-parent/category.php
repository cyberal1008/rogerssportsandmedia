<?php
/**
 * Category template.
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */

get_header();
?>
<div class="cat-header">
	<p class="cat-page-title text-center"><?php html_entity_decode( single_cat_title() ); ?></p>
	<?php if ( ! is_paged() ) { ?>
		<?php if ( category_description() ) : ?>
			<div class="cat-page-desc text-center"><?php echo category_description(); ?></div>
		<?php endif; ?>
	<?php } ?>
</div>
<div class="container">
	
</div>
<?php
get_footer();

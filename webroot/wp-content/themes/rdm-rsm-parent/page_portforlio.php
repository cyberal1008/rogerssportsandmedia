<?php
/**
 * Template Name: Portfolio
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */

get_header(); ?>
    <div class="container portfolio-page" id="main">
		<?php
		if ( get_the_title() === 'Television' ) {
			get_template_part( 
				'template-parts/portforlio', 
				'television', 
				array(
					'page_id' => get_the_ID(),
				));
		} ?>

		<?php
		if ( get_post_field( 'post_name' ) === 'radio-podcasts' ) {
			get_template_part( 
				'template-parts/portforlio', 
				'radio', 
				array(
					'page_id' => get_the_ID(),
				));
		} ?>
    	</div>

<?php
get_footer();


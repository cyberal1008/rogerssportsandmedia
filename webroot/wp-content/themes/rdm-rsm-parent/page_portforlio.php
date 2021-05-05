<?php
/**
 * Template Name: Portfolio
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */

get_header();

?>
    <div class="portfolio-header jumbotron j-main d-flex justify-content-center align-items-center">
        <div>
	        <?php global $post;
	        if ( $post->post_parent ) { ?>
                <div class="text-center parent-url">
                    <a href="<?php echo get_permalink( $post->post_parent ); ?>">
				        <?php echo get_the_title( $post->post_parent ); ?>
                    </a>
                </div>
	        <?php } ?>
            <div class="display-3 j-title"><?php echo esc_html( get_the_title() ); ?></div>
        </div>
    </div>
    <div class="container portfolio-page" id="main">
		<?php
		if ( stripos( get_the_title(), 'television' ) !== false ) {
			get_template_part(
				'template-parts/portfolio',
				'television',
				array(
					'page_id' => get_the_ID(),
				) );
		} ?>
    </div>

<?php
get_footer();


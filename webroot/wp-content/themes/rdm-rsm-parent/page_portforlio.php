<?php
/**
 * Template Name: Portfolio
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */

get_header(); ?>
    <header class="portfolio-header jumbotron j-main d-flex justify-content-center align-items-center">
        <h1 class="display-3 j-title"><?php echo esc_html(get_the_title()) ; ?></h1>
    </header>
    <div class="container portfolio-page" id="main">
		<?php
		if ( stripos (get_the_title(), 'television' ) !== false ){
			get_template_part( 
				'template-parts/portfolio', 
				'television', 
				array(
					'page_id' => get_the_ID(),
				));
		} ?>
    </div>

<?php
get_footer();


<?php
/**
 * Template Name: Radio & Podcasts
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */

get_header(); ?>
	<div  class="container page" id="main">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 single-article-container" role="main">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				endwhile;
			?>
			</div> 
			<div class="col-sm-12 col-md-12 col-lg-12 page-program-grid">
			<?php
				get_template_part( 
					'template-parts/program', 
					'filter', 
					array(
						'total' => 104,
						'unit-text' => 'stations and podcasts',
						'filters' => array(
							'radio-category' => array(
								'all' => "Featured Stations and Podcasts",
								'all-stations' => "All Stations",
								'all-podcasts' => "All Podcasts",
							),
							'region' => array(
								'all' => "All regions",
								'toronto' => "Toronto",
								'ottwa' => "Ottwa",
								'calgary' => "Calgary",
							),
						),
					));
			?>
			</div>
		</div>
	</div>

<?php
get_footer();


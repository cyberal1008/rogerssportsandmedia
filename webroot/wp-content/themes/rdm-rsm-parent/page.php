<?php
/**
 * The template for displaying all pages.
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */

get_header(); ?>
	<div  class="container" id="main">
		<div class="row">
			<div class="col-sm-12 col-md-11 col-lg-8 single-article-container" role="main">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				endwhile;
			?>
			</div> 
			<div class="col-sm-12 col-md-12 col-lg-4 single-article-sidebar">
				<?php get_sidebar(); ?>
			</div> 
		</div>
	</div>

<?php
get_footer();


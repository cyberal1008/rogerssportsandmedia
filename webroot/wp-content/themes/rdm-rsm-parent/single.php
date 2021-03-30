<?php
/**
 * The template for displaying all single posts.
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */

get_header(); ?>

<div class="container" id="main">
	<div class="row">
		<div class="col-sm-12 col-md-11 col-lg-8 single-article-container" role="main">
	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', get_post_format() );

		the_post_navigation();

		endwhile;
	?>
	</div> 
	<aside class="col-sm-12 col-md-12 col-lg-4 single-article-sidebar">
	<?php get_sidebar(); ?>
</div> 
	</div> 
</div> 
<?php
get_footer();


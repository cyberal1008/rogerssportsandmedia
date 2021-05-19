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
		<div class="back-cat">
		<?php
		$categories = get_the_category();
		if ( ! empty( $categories ) ) {
			$category_name = '&lsaquo; ' . esc_html( $categories[0]->name );
			$category_link = get_category_link( $categories[0]->cat_ID );
		}
		?>
		<a href="<?php echo $category_link; ?>" class=""><?php echo $category_name; ?></a>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-11 col-lg-8 single-article-container mx-auto" role="main">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', get_post_format() );

				endwhile;
			?>
			</div> 
		</div> 
		<?php
		$post_meta = get_post_meta( get_the_ID(), 'blog', true );
		$zone      = $post_meta['blog_meta']['whats_happening'];
		$zone      = ( function_exists( 'z_get_zone' ) && z_get_zone( $zone ) ) ? $zone : '';
		get_template_part( 'template-parts/content', 'happening', $zone );
		// get_template_part( 'template-parts/content', 'join-our-team' );
		?>

	</div> 
</div> 
<?php
get_footer();

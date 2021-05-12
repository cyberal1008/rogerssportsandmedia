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
		<?php if ( category_description() ) : ?>
			<div class="cat-page-desc text-center"><?php echo category_description(); ?></div>
		<?php endif; ?>
</div>
<div class="container">
	<?php
	$category  = get_the_category();
	$the_query = new WP_Query(
		array(
			'post__in'       => get_option( 'sticky_posts' ),
			'post_date'      => 'DESC',
			'posts_per_page' => 1,
			'cat'            => '' . $category[0]->cat_ID . '',
		)
	);
	?>
	<?php if ( get_option( 'sticky_posts' ) ) : ?>
		<?php if ( $the_query->have_posts() ) : ?>
			<?php
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				$featured_img_url   = get_the_post_thumbnail_url( get_the_ID(), 'wide-577' );
				$categories         = get_the_category();
				$call_to_action     = get_post_meta( get_the_ID(), 'call-to-action', true );
				$call_to_action_url = get_post_meta( get_the_ID(), 'call-to-action-url', true );
				?>
					<div class="container mb-5">
						<div class="row">
							<div class="col-md order-md-1">
								<div class="card-body">
									<p class="cat-date"><?php echo get_the_date( get_option( 'date_format' ) ); ?>
										<?php
										if ( ! empty( $categories ) ) {
											echo ' / ' . esc_html( $categories[0]->name );
										}
										?>
									</p>
									<h4 class="card-title-gb"><a href="<?php echo get_permalink( $post->id ); ?>"><?php the_title(); ?></a></h4>
									<?php
									if ( ! empty( $call_to_action ) ) {
										?>
										<a href="<?php echo $call_to_action_url; ?>" class="card-button"><?php echo $call_to_action; ?></a>
									<?php } ?>
								</div>
							</div>
							<div class="col-md order-first order-md-2">
								<div class="img-square-wrapper">
									<div class="card-rectangle-one"></div>
									<img class="card-img-one" src="<?php echo $featured_img_url; ?>" alt="<?php the_title(); ?>">
								</div>
							</div>
						</div>
					</div>
				<?php
			endwhile;
		endif;
	endif;
	?>

	<div class="row justify-content-between">

	</div>
</div>
<?php
get_footer();

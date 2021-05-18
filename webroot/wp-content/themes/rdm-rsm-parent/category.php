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
	global $post;
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
				$featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'wide-577' );
				$categories       = get_the_category();
				$post_meta        = get_post_meta( get_the_ID(), 'blog', true );
				?>
					<div class="container mb-5">
						<div class="row">
							<div class="col-md order-md-1">
								<div class="card-body">
									<p class="cat-date date-mobile"><?php echo get_the_date( get_option( 'date_format' ) ); ?>
										<?php
										if ( ! empty( $categories ) ) {
											echo ' / ' . esc_html( $categories[0]->name );
										}
										?>
									</p>
									<h4 class="card-title-gb"><a href="<?php echo get_permalink( $post->id ); ?>"><?php the_title(); ?></a></h4>
									<?php
									if ( ! empty( $post_meta['blog_meta']['buttontext'] ) ) {
										?>
										<a href="<?php echo $post_meta['blog_meta']['buttonurl']; ?>" class="card-button"><?php echo $post_meta['blog_meta']['buttontext']; ?></a>
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

		<div class="row">
			<?php
			$paged     = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$the_query = new WP_Query(
				array(
					'post__not_in'   => get_option( 'sticky_posts' ),
					'post_type'      => 'post',
					'orderby'        => 'date',
					'post_date'      => 'DESC',
					'post_status'    => 'publish',
					'posts_per_page' => 10,
					'paged'          => $paged,
					'cat'            => '' . $category[0]->cat_ID . '',
				)
			);
			?>
		<?php if ( $the_query->have_posts() ) : ?>
			<?php
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				$featured_img_url   = get_the_post_thumbnail_url( get_the_ID(), 'wide-577' );
				$featured_img_url_m = get_the_post_thumbnail_url( get_the_ID(), 'square-375' );
				$categories         = get_the_category();
				$post_meta          = get_post_meta( get_the_ID(), 'blog', true );
				?>
					<div class="col-lg-6 col-md-12 mb-4 box-post">
						<div class="card mb-5 card-gb ">
							<div class="cat-date-next">
								<p class="cat-date date-mobile"><?php echo get_the_date( get_option( 'date_format' ) ); ?>
									<?php
									if ( ! empty( $categories ) ) {
										echo ' / ' . esc_html( $categories[0]->name );
									}
									?>
								</p>
							</div>
							<div class="img-shadow">
								<div class="cat-card-rectangle"></div>                          
								<img class="card-img-next small-img" src="<?php echo $featured_img_url_m; ?>">
								<img class="card-img-next large-img" src="<?php echo $featured_img_url; ?>">
							</div>
							<div class="card-body">
								<h4 class="card-title-next"><a href="<?php echo get_permalink( $post->id ); ?>"><?php the_title(); ?></a></h4>
								<?php
								if ( ! empty( $post_meta['blog_meta']['buttontext'] ) ) {
									?>
									<a href="<?php echo $post_meta['blog_meta']['buttonurl']; ?>" class="card-button"><?php echo $post_meta['blog_meta']['buttontext']; ?></a>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php
			endwhile;
			?>
			<div class="pagination">
				<div class="wrap">
			<?php
			echo paginate_links(
				array(
					'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
					'total'        => $the_query->max_num_pages,
					'current'      => max( 1, get_query_var( 'paged' ) ),
					'format'       => '?paged=%#%',
					'show_all'     => false,
					'type'         => 'plain',
					'end_size'     => 2,
					'mid_size'     => 1,
					'prev_next'    => true,
					'prev_text'    => sprintf( '<i></i> %1$s', __( '<<', 'text-domain' ) ),
					'next_text'    => sprintf( '%1$s <i></i>', __( '>>', 'text-domain' ) ),
					'add_args'     => false,
					'add_fragment' => '',
				)
			);
			?>
				</div>
			</div>
			<?php
			wp_reset_postdata();
			?>
			<?php else : ?>
				<p>
					<?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?>
				</p>

		<?php endif; ?>
		</div>
	</div>
</div>
<?php
get_footer();

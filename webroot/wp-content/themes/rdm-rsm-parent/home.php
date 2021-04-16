<?php
	/**
	 * The template for displaying home page.
	 *
	 * @package Rogers Digital Media
	 * @subpackage rdm-rsm-parent
	 * @since Ver 1.0
	 */

	get_header();?>

<div class="container">

	<header class="jumbotron my-4 paral paralsec j-main">
		<h1 class="display-3 j-title"><?php echo get_theme_mod( 'desktop_vid_link_vid_title' ); ?></h1>
		<p class="lead j-desc"><?php echo get_theme_mod( 'desktop_vid_link_vid_desc' ); ?></p>
		<a href="<?php echo get_theme_mod( 'desktop_vid_link_button_url' ); ?>" class="btn btn-primary btn-lg j-button"><?php echo get_theme_mod( 'desktop_vid_link_button_text' ); ?></a>
	</header>
	<div class="row justify-content-between">
		<?php $the_query = new WP_Query( array( 'post_type' => 'post' ) ); ?>
		<?php if ( $the_query->have_posts() ) : ?>
			<?php
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				?>
				<?php $featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>
				<div class="col-lg-3 col-md-6 mb-4">
					<div class="card mb-2">
						<img class="card-img-top" src="<?php echo $featured_img_url; ?>" alt="">
						<div class="card-body">
							<h4 class="card-title"><?php the_title(); ?></h4>
							<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
							<a href="<?php echo esc_url( get_permalink() ); ?>" class="solid-btn">View</a>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		<?php else : ?>
				<p>
					<?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?>
				</p>
		<?php endif; ?>
		</div>
	</div>

	<?php
	get_footer();

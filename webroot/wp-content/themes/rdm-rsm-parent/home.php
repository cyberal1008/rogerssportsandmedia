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
	<header class="jumbotron j-main">
		<h1 class="display-3 j-title"><?php echo get_theme_mod( 'desktop_vid_link_vid_title' ); ?></h1>
		<p class="lead j-desc"><?php echo get_theme_mod( 'desktop_vid_link_vid_desc' ); ?></p>
		<a href="<?php echo get_theme_mod( 'desktop_vid_link_button_url' ); ?>" class="btn btn-primary btn-lg j-button"><?php echo get_theme_mod( 'desktop_vid_link_button_text' ); ?></a>
	</header>

	<?php
		$string = get_theme_mod( 'post_ids' );
	if ( $string ) {
		$ids_array = explode( ', ', $string );
		$args      = array( 'ids_array' => $ids_array );

		$args_array = array(
			'post_type'      => 'post',
			'posts_per_page' => 3,
			'post_status'    => 'publish',
			'post__in'       => $args['ids_array'],
			'orderby'        => 'post__in',
		);
	} else {
		$args_array = array(
			'post_type'      => 'post',
			'posts_per_page' => 3,
			'post_status'    => 'publish',
		);
	}
		get_template_part( 'template-parts/content', 'happening', $args_array );
	?>

	<div class="join-our-team my-5">    
		<div class="container">
			<div class="row">
				<div class="col-md-5 my-auto">
					<div class="jumbotron jot-main">
						<h1 class="display-3 jot-title">BE PART OF SOMETHING BIG</h1>
						<p class="lead jot-desc">Win with Rogers Sports & Media, let’s connect</p>
						<a href="https://jobs.rogers.com/go/Sports-and-Media/386638/?sortColumn=sort_shifttype&sortDirection=desc" target="_blank" class="btn btn-primary btn-lg jot-button">VIEW OPEN POSITIONS</a>
					</div>
				</div>
				<div class="col-md-7">
					<div class="jot-img-wrapper">
						<div class="jot-card-rectangle"></div>
						<img class="jot-card-img" src="<?php bloginfo( 'template_directory' ); ?>/assets/images/join-our-team-577x433.jpeg" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();

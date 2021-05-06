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
	get_template_part(
		'template-parts/content',
		'about',
		array(
			'title'       => 'WHO WE ARE',
			'description' => 'We&quot;re reimaging the future of sports and media by innovating at the intersection of data, technology,  sports, and entertainment.',
			'more'        => array(
				'url'  => get_home_url( null, './who-we-are' ), // @todo replace with blog id when available
				'text' => 'Discover RSM',
			),
			'image_url'   => get_theme_mod( 'image_url_logos' )
		) );
	?>

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
		get_template_part( 'template-parts/content', 'join-our-team' );
	?>
</div>

<?php
get_footer();

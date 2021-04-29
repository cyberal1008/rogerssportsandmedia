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
		$string    = get_theme_mod( 'post_ids' );
		$ids_array = explode( ', ', $string );
		$args      = array( 'ids_array' => $ids_array );
		get_template_part( 'template-parts/content', 'happening', $args );
	?>
</div>

<?php
get_footer();

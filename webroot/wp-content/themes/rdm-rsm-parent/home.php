<?php
	/**
	 * The template for displaying home page.
	 *
	 * @package Rogers Digital Media
	 * @subpackage rdm-rsm-parent
	 * @since Ver 1.0
	 */

	get_header();
	$home_hero_btn_url  = get_theme_mod( 'desktop_vid_link_button_url' );
	$home_hero_btn_text = get_theme_mod( 'desktop_vid_link_button_text' );
?>

<div class="container">
	<?php
	get_template_part(
		'template-parts/content',
		'about',
		array(
			'title'       => get_theme_mod( 'wwa_title' ),
			'description' => get_theme_mod( 'wwa_description' ),
			'more'        => array(
				'url'  => get_theme_mod( 'wwa_cta_url' ),
				'text' => get_theme_mod( 'wwa_cta_text' ),
			),
			'image_url'   => get_theme_mod( 'image_url_logos' ),
		)
	);
	?>
	<?php
	get_template_part(
		'template-parts/content',
		'products',
		array(
			'title'       => get_theme_mod( 'wwd_title' ),
			'description' => get_theme_mod( 'wwd_description' ),
			'more'        => array(
				'url'  => get_theme_mod( 'wwd_cta_url' ),
				'text' => get_theme_mod( 'wwd_cta_text' ),
			),
		)
	);
	?>

	<?php
		$zone = get_theme_mod( 'post_zone' );// 'happening-home';
		$zone = ( function_exists( 'z_get_zone' ) && z_get_zone( $zone ) ) ? $zone : '';
		get_template_part( 'template-parts/content', 'happening', $zone );
	?>
</div>

<?php
get_footer();

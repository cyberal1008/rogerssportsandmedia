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

	<div class="who-we-are mt-5">
		<div class="container">
			<div class="wwa-elements">
				<div class="wwa-element-one"></div>
				<div class="wwa-element-two"></div>
			</div>
			<div class="row py-5">
				<div class="col-md-6 my-auto">
					<div class="jumbotron wwa-main">
						<h1 class="display-3 wwa-title">WHO WE ARE</h1>
						<p class="lead wwa-desc">We’re reimaging the future of sports and media by innovating at the intersection of data, technology,  sports, and entertainment.</p>
						<a href="./who-we-are/" class="card-button">Discover RSM</a>
					</div>
				</div>
				<div class="col-md-6 my-auto">
					<div class="wwa-img-wrapper">
						<img class="wwa-card-img" src="<?php echo get_theme_mod( 'image_url_logos' ); ?>" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php

		$zone = z_get_zone( 'homepage' ) ? 'homepage' : '';
		get_template_part( 'template-parts/content', 'happening', $zone );
		get_template_part( 'template-parts/content', 'join-our-team' );
	?>
</div>

<?php
get_footer();

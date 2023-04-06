<?php
/**
 * The Header
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

$lang = 'en';

?><!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
	<?php do_action( 'rdm_newrelic_header' ); ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="facebook-domain-verification" content="wu23xn0vfi7xr89rxgr8z05yiqs4vh" />
	<title>
	<?php
	/**
	 * Detect Yoast SEO Plugin.
	 */
	if ( defined( 'WPSEO_VERSION' ) ) {
		wp_title( '' );
	} else {
		/**
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;

		wp_title( '|', true, 'right' );

		// Add the blog name.
		bloginfo( 'name' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			echo " | $site_description";
		}
	}
	?>
	</title>

	<link rel="profile" href="//gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php echo get_option( 'siteurl' ) . '/xmlrpc.php'; ?>" />
	<link rel="shortcut icon" href="<?php echo dirname( get_bloginfo( 'stylesheet_url' ) ); ?>/assets/images/favicon.ico">
	<!-- <script type="text/javascript" src="/wp-content/themes/node_modules/jquery/dist/jquery.min.js"></script> -->
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/scripts/popper.min.js"></script>

	<link rel="stylesheet" href="https://use.typekit.net/aws7pih.css">
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

	<?php facebook_pixel_code(); ?>

	<?php wp_head(); ?>

	<?php require_once 'views/portfolio-chapters.html'; ?>
	<?php require_once 'views/solutions-modal.html'; ?>

	<?php
	if ( is_page() && ( get_post_field( 'post_name' ) === 'television-and-streaming' || get_post_field( 'post_name' ) === 'upfront' ) ) {
		include_once 'views/television-modal.html';
	} elseif ( is_page() && get_post_field( 'post_name' ) === 'radio-podcasts' ) {
		include_once 'views/radio-modal.html';
	}
	?>
</head>
<body <?php body_class(); ?>>

<?php
if ( is_home() ) {
	get_template_part(
		'template-parts/header',
		'media',
		array(
			'image_url'          => get_theme_mod( 'desktop_vid_link_image_url' ),
			'hero_title'         => get_theme_mod( 'desktop_vid_link_vid_title' ),
			'hero_desc'          => get_theme_mod( 'desktop_vid_link_vid_desc' ),
			'home_hero_btn_url'  => get_theme_mod( 'desktop_vid_link_button_url' ),
			'home_hero_btn_text' => get_theme_mod( 'desktop_vid_link_button_text' ),

			'image_url_2'          => get_theme_mod( 'desktop_2_vid_link_image_url' ),
			'hero_title_2'         => get_theme_mod( 'desktop_2_vid_link_vid_title' ),
			'hero_desc_2'          => get_theme_mod( 'desktop_2_vid_link_vid_desc' ),
			'home_hero_btn_url_2'  => get_theme_mod( 'desktop_2_vid_link_button_url' ),
			'home_hero_btn_text_2' => get_theme_mod( 'desktop_2_vid_link_button_text' ),

			'image_url_3'          => get_theme_mod( 'desktop_3_vid_link_image_url' ),
			'hero_title_3'         => get_theme_mod( 'desktop_3_vid_link_vid_title' ),
			'hero_desc_3'          => get_theme_mod( 'desktop_3_vid_link_vid_desc' ),
			'home_hero_btn_url_3'  => get_theme_mod( 'desktop_3_vid_link_button_url' ),
			'home_hero_btn_text_3' => get_theme_mod( 'desktop_3_vid_link_button_text' ),
		)
	);
} elseif ( is_front_page() ) {
	get_template_part(
		'template-parts/header',
		'home'
	);
} elseif ( is_page() && is_page_template( 'page_portfolio.php' ) ) {
	$page_meta  = get_post_meta( get_the_ID(), RSM\Broadcast\PageMeta::METADATA_SLUG, true );
	$image_uri  = '';
	$video_uri  = '';
	$hero_title = esc_html( get_the_title() );
	if ( isset( $page_meta['broadcast'] ) ) {
		if ( isset( $page_meta['broadcast']['image_uri'] ) ) {
			$image_uri = $page_meta['broadcast']['image_uri'];
		}
		if ( isset( $page_meta['broadcast']['image_uri'] ) ) {
			$video_uri = $page_meta['broadcast']['video_uri'];
		}
	}
	get_template_part(
		'template-parts/header',
		'media',
		array(
			'image_url'  => $image_uri,
			'video_url'  => $video_uri,
			'hero_title' => $hero_title,
		)
	);
} elseif ( is_category() || is_page() || is_404() ) {
	get_template_part( 'template-parts/header', 'nomedia' );
} elseif ( is_single() ) {
	get_template_part( 'template-parts/header', 'nomedia-blog' );
}
?>
<header class="nav-down header-container ">
			<nav class="navbar navbar-expand-md navbar-light fixed-top nav-bg" role="navigation">
				<div class="nav-logo d-flex justify-content-center align-content-center align-items-center"
					 itemscope itemtype="https://schema.org/Organization">
					 <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img src="<?php echo dirname( get_bloginfo( 'stylesheet_url' ) ); ?>/assets/images/Logo-RSM.svg" width="120"  alt="<?php esc_url( bloginfo( 'name' ) ); ?>">
					  </a>
				</div>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'RSM' ); ?>">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="main-nav d-flex gb-w align-items-center justify-content-center">
					<div class="navbar-main">
						<?php
							wp_nav_menu(
								array(
									'theme_location'  => 'primary',
									'depth'           => 2,
									'container'       => 'div',
									'container_class' => 'collapse navbar-collapse bg-mob',
									'container_id'    => 'navbarSupportedContent',
									'menu_class'      => 'nav navbar-nav navbar-nav-scroll',
									'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
									'walker'          => new WP_Bootstrap_Navwalker(),
								)
							);
							?>
					</div>
				</div>
				<div class="nav-social">
					<ul class="social-icons">
						<li><a class="header-social" target="_blank" href="https://twitter.com/RogersMediaPR" aria-label="View Rogers Sports and Media on Twitter">
							<i class="icon fa-brands fa-square-twitter"></i>
						</a></li>
						<li><a class="header-social" target="_blank" href="https://ca.linkedin.com/company/rogers-sports-and-media" aria-label="View Rogers Sports and Media on LinkedIn">
							<i class="icon fa-brands fa-linkedin"></i>
						</a></li>
						<li><a class="header-social" target="_blank" href="https://www.instagram.com/rogerssportsandmedia/" aria-label="View Rogers Sports and Media on Instagram">
							<i class="icon fa-brands fa-square-instagram"></i>
						</a></li>
					</ul>
				</div>

			</nav>
	</header>

	<?php 
	if ( ! is_page() || ! is_page_template( 'page-contactus.php' ) ) { ?>
		<a href="#partner" class="button fixedbtn" role="region" aria-label="Advertise with Us">
			Advertise With Us
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/character.svg" class="char static" alt="yellow square-shaped character" loading="lazy">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/character-alt.svg" class="char hover" alt="yellow square-shaped character waving" loading="lazy">
		</a>
	<?php } ?>

<?php if ( is_single() ) { ?>
	<div class="wrapper pt-5">
<?php } else if (!is_home() && !is_front_page()){ ?>
	<div class="wrapper ">
<?php } ?>

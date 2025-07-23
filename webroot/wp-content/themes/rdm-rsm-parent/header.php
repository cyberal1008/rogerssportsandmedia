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
<?php wp_body_open(); ?>
<header>
	<div class="fixed-top">
		<div class="tw:bg-black">
			<div class="tw:hidden tw:md:block wrapper">
				<div class="tw:flex tw:flex-row tw:justify-between">
					<div>&nbsp;</div>
					<ul class="tw:flex tw:flex-row tw:md:justify-center tw:md:items-center tw:justify-between tw:md:gap-x-16 tw:text-white" style="padding: 8px; height: 40px; margin-bottom: 0px;">
						<li><a class="tw:text-sm tw:font-semibold" href="/about-us">About Us</a></li>
						<li><a class="tw:text-sm tw:font-semibold" href="/the-latest">The Latest</a></li>
						<li><a class="tw:text-sm tw:font-semibold" href="/contact-us">Contact Us</a></li>
						<li class="tw:hidden tw:md:inline">
							<a style="border-radius: 0px; padding-top: 8px; padding-bottom: 8px; font-size: 14px" class="tw:btn-primary tw:text-sm" href="https://go.rogerssportsandmedia.com/sign-up/with-email">Advertise with Us</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="nav-down header-container nav-bg">
			<nav class="navbar navbar-expand-md navbar-light wrapper" role="navigation">
				<div class="md:tw-w-1/4 nav-logo d-flex align-content-center align-items-center" itemscope itemtype="https://schema.org/Organization">
					<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img src="<?php echo dirname( get_bloginfo( 'stylesheet_url' ) ); ?>/assets/images/rsmlogostackedwhite.png"  alt="<?php esc_url( bloginfo( 'name' ) ); ?>" height="36" width="136" />
					</a>
				</div>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'RSM' ); ?>">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="main-nav d-flex gb-w justify-content-end">
					<div class="navbar-main">
						<?php
							wp_nav_menu(
								array(
									'theme_location'  => 'primary',
									'depth'           => 2,
									'container'       => 'div',
									'container_class' => 'collapse navbar-collapse bg-mob',
									'container_id'    => 'navbarSupportedContent',
									'menu_class'      => 'nav navbar-nav',
									'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
									'walker'          => new WP_Bootstrap_Navwalker(),
								)
							);
							?>
					</div>
				</div>
			</nav>
		</div>
	</div>
</header>
<?php
if ( is_front_page() ) {
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
} elseif ( is_page_template( 'page-legal.php' ) || is_404() ) {
	get_template_part( 'template-parts/header', 'nomedia' );
} elseif ( is_single() ) {
	get_template_part( 'template-parts/header', 'nomedia-blog' );
}
?>
	<?php 
	if ( ! is_page() || ! is_page_template( 'page-contactus.php' ) ) { ?>
		<a href="<?php echo get_home_url(); ?>/contact-us" class="button fixedbtn" role="region" id="advertise-btn" aria-label="Contact Us">Contact Us</a>
		<script>
			const target = document.getElementById("hero-carousel");
			const trigger = document.getElementById("advertise-btn");
			function toggleAdvertiseBtn() {
				if (target) {
					const rect = target.getBoundingClientRect();
					const distanceFromBottom = window.innerHeight - rect.bottom;
					if (distanceFromBottom >= 100) {
						trigger.style.display = "block";
					} else {
						trigger.style.display = "none";
					}
				} else {
					trigger.style.display = "block";
				}
			}
			window.addEventListener("scroll", toggleAdvertiseBtn);
			window.addEventListener("load", toggleAdvertiseBtn);
		</script>
	<?php } ?>

<?php 
	if ( is_singular('event') ) { ?>
		<div class="wrapper pt-5">
<?php
	} else if (
		!is_home() &&
		!is_front_page() &&
		!is_page_template( 'page_whatwedo.php' ) &&
		!is_page_template( 'page_upfront.php' ) &&
		!is_page_template( 'page_sitemap.php' ) &&
		!is_page_template( 'page_advanced-solutions.php' ) &&
		!is_page_template( 'page_creative-solutions.php' ) &&
		!is_page_template( 'page_ooh.php' ) &&
		!is_page_template( 'page_sports.php' ) &&
		!is_page_template( 'page_tvstreaming.php' ) &&
		!is_page_template( 'page_tv.php' ) &&
		!is_page_template( 'page_disneyplus.php' ) &&
		!is_page_template( 'page_tsc.php' ) &&
		!is_page_template( 'page_whoweare.php' ) &&
		!is_page_template( 'page_contactus.php' ) &&
		!is_page_template( 'page_podcasts.php' ) &&
		!is_page_template( 'page_tubi.php' ) &&
		!is_page_template( 'page_sportsnetplus.php' ) &&
		!is_page_template( 'page_aboutus.php' ) &&
		!is_page_template( 'page_hgtv.php' ) &&
		!is_page_template( 'page_upfront_2025.php' ) &&
		!is_singular('post') && !is_category()
	) { ?>
		<div class="wrapper">
<?php
	} ?>

<?php
/**
 * The Header
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

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
	<script type="text/javascript" src="/wp-content/themes/node_modules/jquery/dist/jquery.min.js"></script>


	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<header class="nav-down header-container">
		<div class="">
			<nav class="navbar navbar-expand-md navbar-light bg-light" role="navigation">
			  <div class="container navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'your-theme-slug' ); ?>">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="nav-logo d-flex justify-content-center align-content-center align-items-center"
					 itemscope itemtype="https://schema.org/Organization">
					<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_url( bloginfo( 'name' ) ); ?></a>
				</div>
				<div class="main-nav d-flex w-75 align-items-center ">
					<div class="navbar-main">
						<?php
							wp_nav_menu(
								array(
									'theme_location'  => 'primary',
									'depth'           => 2,
									'container'       => 'div',
									'container_class' => 'collapse navbar-collapse',
									'container_id'    => 'bs-example-navbar-collapse-1',
									'menu_class'      => 'nav navbar-nav',
									'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
									'walker'          => new WP_Bootstrap_Navwalker(),
								)
							);
							?>
					</div>
				</div>
				</div>
			</nav>
		</div>
	</header>
<div class="wrapper">

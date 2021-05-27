<?php
/**
 * The 404 Page
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */

get_header();

get_template_part(
	'template-parts/content',
	'header',
	array(
		'title'    => '&nbsp;',
		'subtitle' => '404 Error',
	)
);
?>
<div class="container">
	<section id="primary" class="col-sm-12 pb-5 d-flex justify-content-center">
		<div id="main" class="site-main pb-5" role="main">
			<section class="error-404 not-found">
				<header class="error-header">
					<h1 class="page-title"><?php esc_html_e( 'We couldn’t find that page.', 'rdm-rsm-parent' ); ?></h1>
				</header>

				<div class="page-content">
					<p><?php esc_html_e( 'Not to worry, please head over to the' ); ?> <a href="/">home page</a>, read some of latest news below or <a href="/contact-us">contact us</a> <?php esc_html_e( 'if the problem still persists.' ); ?></p>
				</div>
			</section>
		</div>
	</section>
	<?php
	$zone = get_theme_mod( 'post_zone' );// 'happening-home';
	$zone = ( function_exists( 'z_get_zone' ) && z_get_zone( $zone ) ) ? $zone : '';
	get_template_part( 'template-parts/content', 'happening', $zone );
	get_template_part( 'template-parts/content', 'join-our-team' );
	?>
</div>
<?php
get_footer();

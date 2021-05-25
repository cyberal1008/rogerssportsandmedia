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
		'title'    => 'error',
		'subtitle' => '404',
	)
);

?>
<div class="container">
	<section id="primary" class="col-sm-12 pb-5 d-flex justify-content-center">
		<div id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="error-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'rdm-rsm-parent' ); ?></h1>
				</header>

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below?', 'wp-bootstrap-starter' ); ?></p>

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

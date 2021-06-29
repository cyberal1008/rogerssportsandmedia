<?php
/**
 * The Footer
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */

?>
</div>
<footer class="page-footer">

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<?php
			if ( is_active_sidebar( 'footer-2' ) ) {
				dynamic_sidebar( 'footer-2' );
			}
			?>
			<ul class="social-icons">
				<li><a class="footer-social" target="_blank" href="https://mobile.twitter.com/RogersMedia?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><img src="<?php bloginfo( 'template_directory' ); ?>/assets/images/icon-twitter.svg" width="30"  alt=""></a></li>
				<li><a class="footer-social" target="_blank" href="https://ca.linkedin.com/company/rogers-sports-and-media"><img src="<?php bloginfo( 'template_directory' ); ?>/assets/images/icon-linkedin.svg" width="30"  alt=""></a></li>
				<li><a class="footer-social" target="_blank" href="https://www.instagram.com/rogerssportsandmedia/"><img src="<?php bloginfo( 'template_directory' ); ?>/assets/images/icon-instagram.svg" width="30"  alt=""></a></li>
			</ul>
		</div>
		<div class="col-md-4">
			<div class="site-info-links">
				<?php
				if ( is_active_sidebar( 'footer-1' ) ) {
					dynamic_sidebar( 'footer-1' );
				}
				?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="row ">
				<div class="col-md-12">
					<div class="site-info-links">
						<?php
						if ( is_active_sidebar( 'footer-3' ) ) {
							dynamic_sidebar( 'footer-3' );
						}
						?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="site-info-links">
						<?php
						if ( is_active_sidebar( 'footer-4' ) ) {
							dynamic_sidebar( 'footer-4' );
						}
						?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="site-info-links">
						<?php
						if ( is_active_sidebar( 'footer-5' ) ) {
							dynamic_sidebar( 'footer-5' );
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="site-info-links">
				<div class="footer-legal-heading">
				Legal
				</div>
				<?php
				if ( is_active_sidebar( 'footer-6' ) ) {
					dynamic_sidebar( 'footer-6' );
				}
				?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-lg-2">
			<div class="footer-logo" itemscope itemtype="https://schema.org/Organization">
				<a class="footer-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo dirname( get_bloginfo( 'stylesheet_url' ) ); ?>/assets/images/Logo-RSM.svg" width="120"  alt="<?php esc_url( bloginfo( 'name' ) ); ?>">
				</a>
			</div>
		</div>
		<div class="footer-copyright d-flex col-md-9 col-lg-10">
			<div class="site-info">
				&copy; <?php echo date( 'Y' ); ?> <?php echo '<a href="' . home_url() . '">' . get_bloginfo( 'name' ) . '</a>'; ?>. All rights reserved.
			</div >
		</div>
	</div>
</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>

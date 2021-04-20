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
	<div class="mt-5 pt-5 pb-5 pl-3 pr-3 footer">
		<div class="footer-container">
			<div class="row justify-content-between">
				<div class="col-lg-1 col-md-4 mb-2 ">
					<div class="footer-logo" itemscope itemtype="https://schema.org/Organization">
						<a class="footer-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img src="<?php echo dirname( get_bloginfo( 'stylesheet_url' ) ); ?>/assets/images/Logo-RSM.svg" width="120"  alt="<?php esc_url( bloginfo( 'name' ) ); ?>">
						</a>
					</div>
				</div>
				<div class="col-lg-5 col-md-8 mb-4 about-company">
					<?php
					if ( is_active_sidebar( 'footer-2' ) ) {
						dynamic_sidebar( 'footer-2' );
					}
					?>
				  
				</div>
				<div class="col-lg-3 col-md-6 mb-4 links">
					<?php
					if ( is_active_sidebar( 'footer-3' ) ) {
						dynamic_sidebar( 'footer-3' );
					}
					?>
				</div>
				<div class="col-lg-3 col-md-6 mb-4 links">
					<?php
					if ( is_active_sidebar( 'footer-4' ) ) {
						dynamic_sidebar( 'footer-4' );
					}
					?>
				</div>
			</div>
			<div class="row">
				<div class="footer-copyright d-flex ">
				 <div class="site-info">
					&copy; <?php echo date( 'Y' ); ?> <?php echo '<a href="' . home_url() . '">' . get_bloginfo( 'name' ) . '</a>'; ?> All rights resurved.
				</div >
					<div class="site-info-links">
					<?php
					if ( is_active_sidebar( 'footer-1' ) ) {
						dynamic_sidebar( 'footer-1' );
					}
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>

</body>
</html>

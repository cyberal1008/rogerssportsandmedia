<?php
/**
 * The Footer
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

?>
</div> 
<footer class="page-footer d-flex align-items-center">

	<!-- Footer Logo -->
	<div class="footer-logo d-flex align-items-center">
			<div class="nav-logo">
				
			</div>
	</div>

	<div class="footer-secondary-wrapper d-flex d-flex  align-items-center">
		<!-- Footer Copyright -->
		<div class="footer-copyright d-flex d-flex  align-items-center">
			 <div class="site-info">
				&copy; <?php echo date( 'Y' ); ?> <?php echo '<a href="' . home_url() . '">' . get_bloginfo( 'name' ) . '</a>'; ?>
			</div>
		</div>

	</div>

</footer>

<?php wp_footer(); ?>

</body>
</html>

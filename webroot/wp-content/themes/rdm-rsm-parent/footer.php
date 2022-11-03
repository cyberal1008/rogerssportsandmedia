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
				<li><a class="footer-social" target="_blank" href="https://twitter.com/RogersMediaPR" aria-label="View Rogers Sports and Media on Twitter"><img src="<?php bloginfo( 'template_directory' ); ?>/assets/images/Tweet.png" width="30"  alt=""></a></li>
				<li><a class="footer-social" target="_blank" href="https://ca.linkedin.com/company/rogers-sports-and-media" aria-label="View Rogers Sports and Media on LinkedIn"><img src="<?php bloginfo( 'template_directory' ); ?>/assets/images/Linked.png" width="30"  alt=""></a></li>
				<li><a class="footer-social" target="_blank" href="https://www.instagram.com/rogerssportsandmedia/" aria-label="View Rogers Sports and Media on Instagram"><img src="<?php bloginfo( 'template_directory' ); ?>/assets/images/Insta.png" width="30"  alt=""></a></li>
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
<script type="text/javascript"> _linkedin_partner_id = "3613641"; window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || []; window._linkedin_data_partner_ids.push(_linkedin_partner_id); </script><script type="text/javascript"> (function(l) { if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])}; window.lintrk.q=[]} var s = document.getElementsByTagName("script")[0]; var b = document.createElement("script"); b.type = "text/javascript";b.async = true; b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js"; s.parentNode.insertBefore(b, s);})(window.lintrk); </script> <noscript> <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=3613641&fmt=gif" /> </noscript>
</body>
</html>

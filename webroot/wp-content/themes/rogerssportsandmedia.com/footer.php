</div><!-- portfolio -->
</div><!-- wrapper -->
<footer id="primary">
	<div class="wrapper">
		<a class="footer-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img src="<?php echo dirname( get_bloginfo( 'stylesheet_url' ) ); ?>/assets/images/Logo-RSM.svg" width="120" class="logo" alt="<?php esc_url( bloginfo( 'name' ) ); ?>">
		</a>
		<div class="grid">

			<div class="item">
				<div class="footer-nav-title">
					<a href="#">Who We Are</a>
				</div>
				<p>We're reimaging the future of sports and media by innovating at the intersection of data, technology, and audience engagement.</p>
				<ul>
						<li><a href="#">Join Our Team</a></li>
						<li><a href="#">What's Happening</a></li>
						<li><a href="#">Ad Specs</a></li>
						<li><a href="#">Contact Us</a></li>
				</ul>
			</div>
				
			<div class="item">
				<?php
				if ( is_active_sidebar( 'footer-2' ) ) {
					dynamic_sidebar( 'footer-2' );
				}
				?>
			</div>

			<div class="item">
				<?php
				if ( is_active_sidebar( 'footer-3' ) ) {
					dynamic_sidebar( 'footer-3' );
				}
				?>
				<div class="nav-social">
					<ul class="social-icons">
						<li><a class="footer-social" target="_blank" href="https://twitter.com/RogersMediaPR" aria-label="View Rogers Sports and Media on Twitter">
							<i class="icon fa-brands fa-square-twitter"></i>
						</a></li>
						<li><a class="footer-social" target="_blank" href="https://ca.linkedin.com/company/rogers-sports-and-media" aria-label="View Rogers Sports and Media on LinkedIn">
							<i class="icon fa-brands fa-linkedin"></i>
						</a></li>
						<li><a class="footer-social" target="_blank" href="https://www.instagram.com/rogerssportsandmedia/" aria-label="View Rogers Sports and Media on Instagram">
							<i class="icon fa-brands fa-square-instagram"></i>
						</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="copyright">&copy; <?php echo date('Y'); ?> Rogers Sports & Media. All rights reserved.</div>
	</div>
</footer>

<script src="https://kit.fontawesome.com/8ded1e9203.js" crossorigin="anonymous"></script>
<?php wp_footer(); ?>
<?php linkedin_pixel_code(); ?>
</body>
</html>

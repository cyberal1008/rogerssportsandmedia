</div><!-- portfolio -->
</div><!-- wrapper -->
<footer id="primary">
	<div class="wrapper">

		<div class="grid top">
			<div class="item">
				<a class="footer-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo dirname( get_bloginfo( 'stylesheet_url' ) ); ?>/assets/images/Logo-RSM.svg" width="120" class="logo" alt="<?php esc_url( bloginfo( 'name' ) ); ?>">
				</a>
			</div>
			<div class="item form-item">
				<form action="https://mcdjql80kmghrjj6lg68bbtqbgv1.pub.sfmc-content.com/a2l1t0y0d2x" id="SubForm" class="formContainer default" onsubmit="return validate()" autocomplete="off">
					<div class="container"> 
						<div class="form-title">Subscribe to our Newsletter</div>
						  <div class="row">
							<div class="custColumn">  
							  	<input type="text" id="email" placeholder="Email Address*" name="email">
							  	<p class="errormsg" id="emailerrormsg">Email Address is required</p>
							  	<p class="errormsg" id="invalidEmailMsg">Email Address is not valid</p>
							 	<p class="errormsg" id="corpEmailErrMsg">You can not submit your request here</p>
							</div>
							
							<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
							<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
							 <div class="column">
							  	<input type="hidden" name="submitted" value="submitted">
							  	<button type="submit" class="subscribebtn button" value="submit">Subscribe</button>
						  	</div>
						</div>
						  
					</div>
					<div class="custColumn">
						<label> By subscribing you are agreeing to our <a href="https://www.rogers.com/consumer/privacy-crtc" target="_blank"> Privacy Policy.</a></label>  
					</div>
				</form>
			</div>
		</div>

		<div class="grid">

			<div class="item">
				<?php
				if ( is_active_sidebar( 'footer-1' ) ) {
					dynamic_sidebar( 'footer-1' );
				}
				?>
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
		<div class="grid">
			<div class="copyright">&copy; <?php echo date('Y'); ?> Rogers Sports & Media. All rights reserved.</div>
		</div>
	</div>
</footer>

<script src="https://kit.fontawesome.com/8ded1e9203.js" data-search-pseudo-elements crossorigin="anonymous"></script>
<?php wp_footer(); ?>
<?php linkedin_pixel_code(); ?>
</body>
</html>

<?php
$jot_image_url = get_theme_mod( 'image_url_join' );
if ( strpos( $jot_image_url, '://' ) == false && substr( $jot_image_url, 0, 2 ) !== '//' && substr( $jot_image_url, 0, 1 ) !== '/' ) {
	$jot_image_url = '/' . $jot_image_url;
}
?>
<div class="join-our-team my-4">
	<div class="container">
		<div class="row">
			<div class="col-md-5 my-auto">
				<div class="jumbotron jot-main">
					<h1 class="display-3 jot-title">Total TV Upfront</h1>
					<p class="lead jot-desc">Watch the Presentation</p>
					<a href="https://rogersupfront.gallery.video" target="_blank" class="btn btn-primary btn-lg jot-button">Watch Now</a>
				</div>
			</div>
			<div class="col-md-7">
				<div class="jot-img-wrapper">
					<div class="jot-card-rectangle"></div>
					<img class="jot-card-img" src="<?php echo $jot_image_url; ?>" alt="">
				</div>
			</div>
		</div>
	</div>
</div>

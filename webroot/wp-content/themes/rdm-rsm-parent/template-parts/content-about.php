<?php
/** @var array $args */

if ( empty( $args['title'] ) ||
	 empty( $args['description'] ) ) {
	return '';
}
?>

<div class="about">
	<div class="container about-container pt-3">
		<div class="row ml-2 ml-md-0<?php echo empty( $args['image_url'] ) ? ' justify-content-sm-center' : ''; ?>">
			<div class="col-md-6 mb-5 my-md-auto<?php echo empty( $args['image_url'] ) ? ' text-center' : ''; ?>">
				<div class="about-container-main">
					<h2 class="about-container-title" id="portfolio-about"><?php echo esc_html( $args['title'] ); ?></h2>
					<p class="lead about-container-desc"><?php echo esc_html( $args['description'] ); ?></p>
					<?php
					if ( ! empty( $args['more'] ) && ! empty( $args['more']['url'] ) && ! empty( $args['more']['text'] ) ) {
						?>
						<a href="<?php echo esc_attr( $args['more']['url'] ); ?>"
						   class="card-button"><?php echo esc_html( $args['more']['text'] ); ?></a>
						<?php
					}
					?>

				</div>
			</div>
			<?php
			if ( ! empty( $args['image_url'] ) ) {
				?>
				<div class="col-md-6 my-auto">
					<div class="about-container-img-wrapper">
						<img class="about-container-card-img" src="<?php echo esc_attr( $args['image_url'] ); ?>" alt="">
					</div>
				</div>
				<?php
			}
			?>

		</div>
	</div>
	<div class="circle-container-quarter">
		<div class="circle">
			<div class="quarter"></div>
			<div class="cut"></div>
		</div>
	</div>
</div>



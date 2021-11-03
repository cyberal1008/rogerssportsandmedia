<?php
/** @var array $args */

if ( empty( $args['title'] ) ||
	 empty( $args['description'] ) ) {
	return '';
}
?>

<div class="section" id="section">
	<div class="container section-container pt-3">
		<div class="row ml-2 ml-md-0<?php echo empty( $args['image_url'] ) ? ' justify-content-sm-center' : ''; ?>">
            <?php
                if ( ! empty( $args['image_url'] ) ) {
                    ?>
                    <div class="col-md-6 my-auto">
                        <div class="section-container-img-wrapper">
                            <img class="section-container-card-img" src="<?php echo esc_attr( $args['image_url'] ); ?>" alt="">
                        </div>
                    </div>
                    <?php
                }
            ?>

			<div class="col-md-6 mb-5 my-md-auto<?php echo empty( $args['image_url'] ) ? ' text-center' : ''; ?>">
				<div class="section-container-main">
					<h2 class="section-container-title" id="portfolio-about"><?php echo esc_html( $args['title'] ); ?></h2>
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
			
		</div>
	</div>
</div>



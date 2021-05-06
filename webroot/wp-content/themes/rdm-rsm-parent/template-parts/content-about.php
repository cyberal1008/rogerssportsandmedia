<?php
/** @var array $args */

if ( empty ( $args['title'] ) ||
     empty ( $args['description'] ) ) {
	return '';
}
?>

<div class="about">
    <div class="container">
        <div class="about-elements">
            <div class="about-element-one"></div>
            <div class="about-element-two"></div>
        </div>
        <div class="row py-5">
            <div class="col-md-6 my-auto">
                <div class="jumbotron about-main">
                    <h1 class="display-3 about-title"><?php echo esc_html( $args['title'] ); ?></h1>
                    <p class="lead about-desc"><?php echo esc_html( $args['description'] ); ?></p>
					<?php
					if ( ! empty ( $args['more'] ) && ! empty ( $args['more']['url'] ) && ! empty ( $args['more']['text'] ) ) {
						?>
                        <a href="<?php echo esc_attr( $args['more']['url'] ); ?>"
                           class="card-button"><?php echo esc_html( $args['more']['text'] ); ?></a>
						<?php
					} ?>

                </div>
            </div>
			<?php
			if ( ! empty ( $args['image_url'] ) ) {
				?>
                <div class="col-md-6 my-auto">
                    <div class="about-img-wrapper">
                        <img class="about-card-img" src="<?php echo esc_attr( $args['image_url'] ); ?>" alt="">
                    </div>
                </div>
				<?php
			} ?>

        </div>
    </div>
</div>


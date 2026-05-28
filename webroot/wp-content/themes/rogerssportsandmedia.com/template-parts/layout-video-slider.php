<?php
$slider_title            = get_sub_field( 'title' );
$slider_background_color = get_sub_field( 'background_color' );
$slider_text_color       = get_sub_field( 'text_color' );
$slider_videos           = get_sub_field( 'videos' );
$count                   = isset( $args['count'] ) ? $args['count'] : 1;

if ( empty( $slider_videos ) ) {
	return;
}
?>
<section class="programming" style="background-color: <?php echo $slider_background_color; ?>; color: <?php echo $slider_text_color; ?>; margin: 0; padding: 50px 0;">
	<div class="portfolio-main">
		<div class="portfolio-page">
			<div class="inner wrapper">
				<?php if ( $slider_title ) : ?>
					<h2 class="flex-section-title" style="color: <?php echo $slider_text_color; ?>"><?php echo $slider_title; ?></h2>
				<?php endif; ?>

				<?php
				get_template_part(
					'template-parts/videos',
					'slider',
					array(
						'slider_name'   => 'videos-slider-' . $count,
						'slider_videos' => $slider_videos,
						'text_color'    => $slider_text_color,
					)
				);
				?>
			</div>
		</div>
	</div>
</section>

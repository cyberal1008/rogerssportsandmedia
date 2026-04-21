<?php
$slider_title            = get_sub_field( 'title' );
$slider_button_link      = get_sub_field( 'button_link' );
$slider_background_color = get_sub_field( 'background_color' );
$slider_text_color       = get_sub_field( 'text_color' );
$slider_shows            = get_sub_field( 'shows' );
$count                   = isset( $args['count'] ) ? $args['count'] : 1;

if ( empty( $slider_shows ) ) {
	return;
}
?>
<section class="programming" style="background-color: <?php echo $slider_background_color; ?>; color: <?php echo $slider_text_color; ?>; margin: 0; padding: 50px 0;">
	<div class="portfolio-main">
		<div class="portfolio-page">
			<div class="inner wrapper">
				<div class="top md:tw-space-x-12" style="gap: 10px 30px; justify-content: start;">
					<?php if ( $slider_title ) : ?>
						<div class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-mb-4 md:tw-mb-4" style="color: <?php echo $slider_text_color; ?>"><?php echo $slider_title; ?></div>
					<?php endif; ?>
					<?php if ( $slider_button_link ) : ?>
						<a href="<?php echo $slider_button_link['url']; ?>" class="button" aria-label="<?php echo $slider_button_link['title'] ? $slider_button_link['title'] : 'Download TV Schedule'; ?>" target="<?php echo $slider_button_link['target'] ? $slider_button_link['target'] : '_self'; ?>"><?php echo $slider_button_link['title'] ? $slider_button_link['title'] : 'Download TV Schedule'; ?></a>
					<?php endif; ?>
				</div>

				<?php
				get_template_part(
					'template-parts/shows',
					'slider',
					array(
						'slider_name'  => 'shows-slider-' . $count,
						'filter'       => false,
						'slider_shows' => $slider_shows,
						'text_color'   => $slider_text_color,
					)
				);
				?>
			</div>
		</div>
	</div>
</section>

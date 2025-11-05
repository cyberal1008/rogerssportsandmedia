<?php

$default_image = get_template_directory_uri() . 'assets/images/missing-image-portrait.png';

if ( ! isset( $args ) || empty( $args['slider_slides'] ) || empty( $args['slider_name'] ) ) {
	return '';
}
$slider_slides = $args['slider_slides'];
$slider_name = $args['slider_name'];
$text_color = empty( $args['text_color'] ) ? '#000' : $args['text_color'];
?>
<div class="slider" style="opacity: 1;">
	<div class="swiper <?php echo $slider_name; ?>-slider presentation-slider">
		<div class="swiper-wrapper">
			<?php
			foreach ( $slider_slides as $slide ) :
				$slide_image = $slide['slide_image']; //size 1522 x 855 px

				if( !empty( $slide_image ) ) {
					$img_tag = '<img src="' . esc_url($slide_image['url']) . '" alt="' . esc_attr($slide_image['alt']) . '" width="1522" height="855" />';
				}
				?>
				<div class="swiper-slide">
					<div class="inner">
						<div class="imgbox">
							<?php echo $img_tag; ?>
						</div>
					</div>
				</div>
			<?php endforeach; wp_reset_query(); ?>
		</div>
	</div>
	<div class="navi">
		<div class="swiper-button-prev <?php echo $slider_name; ?>-prev"><i class="icon fa-solid fa-sharp fa-chevron-left"></i></div>
		<div class="swiper-button-next <?php echo $slider_name; ?>-next"><i class="icon fa-solid fa-sharp fa-chevron-right"></i></div>
	</div>
</div>
<?php

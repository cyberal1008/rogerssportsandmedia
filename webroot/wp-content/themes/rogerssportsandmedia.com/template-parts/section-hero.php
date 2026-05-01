<?php
if ( is_category() ) :
	$term              = get_queried_object();
	$component_type    = get_field( 'component_type', $term )    ?: 'static';
	$hero_image        = get_field( 'hero_image', $term );
	$hero_mobile_image = get_field( 'hero_mobile_image', $term );
	$hero_title        = get_field( 'hero_title', $term );
	$slider_images     = get_field( 'slider_images', $term );
else :
	$component_type    = get_field( 'component_type' )    ?: 'static';
	$hero_image        = get_field( 'hero_image' );
	$hero_mobile_image = get_field( 'hero_mobile_image' );
	$hero_title        = get_field( 'hero_title' );
	$slider_images     = get_field( 'slider_images' );
endif;

if ( $component_type === 'wipe_slider' ) :
	if ( ! empty( $slider_images ) ) :
		get_template_part( 'template-parts/layout-hero-wipe-slider', null, array( 'slides' => $slider_images ) );
	endif;
	return;
endif;
?>
<section class="tw-relative">
	<?php if ( $hero_image ) : ?>
		<img src="<?php echo esc_url( $hero_mobile_image['url'] ?? $hero_image['url'] ); ?>"
		     alt="<?php echo esc_attr( $hero_image['alt'] ); ?>"
		     class="md:tw-hidden" style="width: 100%;">
	<?php endif; ?>
	<?php if ( $hero_image ) : ?>
		<img src="<?php echo esc_url( $hero_image['url'] ); ?>"
		     alt="<?php echo esc_attr( $hero_image['alt'] ); ?>"
		     class="tw-hidden md:tw-block" style="width: 100%;">
	<?php endif; ?>
	<?php if ( ! empty( $hero_title ) ) : ?>
		<div class="tw-absolute tw-inset-0 tw-flex tw-items-center tw-justify-center tw-text-center">
			<div class="tw-text-white tw-text-4xl md:tw-text-5xl tw-font-bold"><?php echo $hero_title; ?></div>
		</div>
	<?php endif; ?>
</section>

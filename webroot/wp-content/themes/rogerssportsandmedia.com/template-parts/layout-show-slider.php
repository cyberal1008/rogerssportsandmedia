<?php
$slider_title            = get_sub_field( 'title' );
$slider_button_link      = get_sub_field( 'button_link' );
$slider_background_color = get_sub_field( 'background_color' );
$slider_text_color       = get_sub_field( 'text_color' );
$slider_text_size        = get_sub_field( 'text_size' );
$slider_text_size_mobile = get_sub_field( 'text_size_mobile' );
$slider_shows            = get_sub_field( 'shows' );
$count                   = isset( $args['count'] ) ? $args['count'] : 1;

// Optional second button shown below the slider. Uses the default ".button"
// styling; editors can override its background, text color, and text size.
$bottom_button_link      = get_sub_field( 'bottom_button_link' );
$bottom_button_bg        = get_sub_field( 'bottom_button_bg_color' );
$bottom_button_color     = get_sub_field( 'bottom_button_text_color' );
$bottom_button_size      = get_sub_field( 'bottom_button_text_size' );

$bottom_button_style = '';
if ( $bottom_button_bg )    $bottom_button_style .= 'background-color:' . $bottom_button_bg . ';';
if ( $bottom_button_color ) $bottom_button_style .= 'color:' . $bottom_button_color . ';';
if ( $bottom_button_size )  $bottom_button_style .= 'font-size:' . (int) $bottom_button_size . 'px;';

if ( empty( $slider_shows ) ) {
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
				<?php if ( $slider_button_link ) : ?>
					<div style="text-align: center; margin-bottom: clamp(24px, 3vw, 40px);">
						<a href="<?php echo $slider_button_link['url']; ?>" class="button" aria-label="<?php echo $slider_button_link['title'] ? $slider_button_link['title'] : 'Download TV Schedule'; ?>" target="<?php echo $slider_button_link['target'] ? $slider_button_link['target'] : '_self'; ?>"><?php echo $slider_button_link['title'] ? $slider_button_link['title'] : 'Download TV Schedule'; ?></a>
					</div>
				<?php endif; ?>

				<?php
				get_template_part(
					'template-parts/shows',
					'slider',
					array(
						'slider_name'  => 'shows-slider-' . $count,
						'filter'       => false,
						'slider_shows' => $slider_shows,
						'text_color'        => $slider_text_color,
						'text_size'         => $slider_text_size,
						'text_size_mobile'  => $slider_text_size_mobile,
					)
				);
				?>

				<?php if ( $bottom_button_link ) : ?>
					<div style="text-align: center; margin-top: clamp(24px, 3vw, 40px);">
						<a href="<?php echo esc_url( $bottom_button_link['url'] ); ?>" class="button" style="<?php echo esc_attr( $bottom_button_style ); ?>" aria-label="<?php echo esc_attr( $bottom_button_link['title'] ? $bottom_button_link['title'] : 'Download TV Schedule' ); ?>" target="<?php echo esc_attr( $bottom_button_link['target'] ? $bottom_button_link['target'] : '_self' ); ?>"><?php echo esc_html( $bottom_button_link['title'] ? $bottom_button_link['title'] : 'Download TV Schedule' ); ?></a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

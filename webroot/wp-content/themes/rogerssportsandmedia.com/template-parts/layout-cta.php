<?php
/**
 * Flexible Layout: CTA
 *
 * Mirrors the inline "Upfront CTA" block on page_upfront_2025.php so the same
 * pattern is usable from the flex builder.
 */

$title            = get_sub_field( 'title' );
$image            = get_sub_field( 'image' );
$link             = get_sub_field( 'link' );
$background_color = get_sub_field( 'background_color' ) ?: '#000';
$text_color       = get_sub_field( 'text_color' ) ?: '#fff';

if ( empty( $image ) || empty( $link['url'] ) ) {
	return;
}

$image_url = ! empty( $image['ID'] )
	? ( wp_get_original_image_url( $image['ID'] ) ?: $image['url'] )
	: $image['url'];
$alt       = $image['alt'] ?? '';
$target    = $link['target'] ?: '_self';
?>

<section class="upfront-cta-section" style="background-color: <?php echo esc_attr( $background_color ); ?>; text-align: center;">
	<div class="wrapper" style="text-align: center;">
		<?php if ( $title ) : ?>
			<h2 class="upfront-cta-title tw-text-3xl md:tw-text-4xl tw-font-bold" style="color: <?php echo esc_attr( $text_color ); ?>; text-align: center;"><?php echo esc_html( $title ); ?></h2>
		<?php endif; ?>
		<a
			href="<?php echo esc_url( $link['url'] ); ?>"
			target="<?php echo esc_attr( $target ); ?>"
			<?php echo $target === '_blank' ? 'rel="noopener noreferrer"' : ''; ?>
			style="display: block; width: fit-content; margin: 0 auto; line-height: 0;"
		>
			<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>" width="800" style="max-width: 100%; height: auto; display: block;" />
		</a>
	</div>
</section>

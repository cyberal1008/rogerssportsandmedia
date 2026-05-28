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

<style>
.upfront-cta-section .upfront-cta-link {
	transition: transform 0.3s ease;
	color: inherit;
	text-decoration: none;
}
.upfront-cta-section .upfront-cta-link:hover,
.upfront-cta-section .upfront-cta-link:focus-visible {
	transform: scale(1.06);
}
.upfront-cta-section .upfront-cta-link .flex-section-title {
	margin-bottom: clamp(16px, 2vw, 24px);
}
</style>

<section class="upfront-cta-section" style="background-color: <?php echo esc_attr( $background_color ); ?>; text-align: center; padding-top: clamp(22px, 2.25vw, 32px); padding-bottom: clamp(22px, 2.25vw, 32px);">
	<div class="wrapper" style="text-align: center;">
		<a
			class="upfront-cta-link"
			href="<?php echo esc_url( $link['url'] ); ?>"
			target="<?php echo esc_attr( $target ); ?>"
			<?php echo $target === '_blank' ? 'rel="noopener noreferrer"' : ''; ?>
			style="display: inline-block; line-height: 0;"
		>
			<?php if ( $title ) : ?>
				<h2 class="flex-section-title" style="color: <?php echo esc_attr( $text_color ); ?>;"><?php echo esc_html( $title ); ?></h2>
			<?php endif; ?>
			<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>" width="800" style="max-width: 100%; height: auto; display: block; margin: 0 auto;" />
		</a>
	</div>
</section>

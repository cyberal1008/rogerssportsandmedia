<?php
/**
 * Shared Logo Marquee
 *
 * Continuous, slow horizontal auto-scroll (CSS animation) that pauses on hover
 * and respects prefers-reduced-motion. Replaces the old per-page Swiper logo
 * carousels (`.logo-slider` / `.logo-slider-mobile`). Styles live in
 * assets/styles/custom.css under "Unified logo marquee".
 *
 * Args (via get_template_part 3rd param):
 *   - logos: array of ACF image arrays (each with 'url' + 'alt'), or an array
 *            of chunks (arrays of image arrays) — both are flattened. Required.
 */

$logos = isset( $args['logos'] ) ? $args['logos'] : array();

// Flatten: accept a flat gallery array or a chunked array-of-arrays.
$flat = array();
foreach ( (array) $logos as $logo ) {
	if ( isset( $logo['url'] ) ) {
		$flat[] = $logo;
	} elseif ( is_array( $logo ) ) {
		foreach ( $logo as $inner ) {
			if ( isset( $inner['url'] ) ) {
				$flat[] = $inner;
			}
		}
	}
}

if ( empty( $flat ) ) {
	return;
}

// Duplicate the set so the -50% translate loops seamlessly.
$count = count( $flat );
$track = array_merge( $flat, $flat );

// Optional extra class(es) on the container (e.g. for per-page spacing).
$extra_class = isset( $args['class'] ) ? ' ' . trim( $args['class'] ) : '';
?>
<div class="logo-marquee<?php echo esc_attr( $extra_class ); ?>" style="--logo-marquee-count: <?php echo (int) $count; ?>;" role="region" aria-label="Brand logos">
	<div class="logo-marquee__track">
		<?php foreach ( $track as $i => $logo ) : $dupe = $i >= $count; ?>
			<div class="logo-marquee__item"<?php echo $dupe ? ' aria-hidden="true"' : ''; ?>>
				<img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php echo esc_attr( $dupe ? '' : ( $logo['alt'] ?? '' ) ); ?>">
			</div>
		<?php endforeach; ?>
	</div>
</div>

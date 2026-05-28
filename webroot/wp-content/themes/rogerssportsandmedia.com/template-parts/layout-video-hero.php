<?php
/**
 * Flexible Layout: Video Hero
 *
 * Full-bleed video sized to (viewport height - site nav height) on every
 * breakpoint. Uses object-fit: cover so the video keeps its native aspect
 * ratio and crops to the container instead of stretching.
 */

$video  = get_sub_field( 'video_file' );
$poster = get_sub_field( 'poster' );

if ( empty( $video['url'] ) ) {
	return;
}

$uid        = uniqid( 'vhero_' );
$video_url  = esc_url( $video['url'] );
$mime       = ! empty( $video['mime_type'] ) ? esc_attr( $video['mime_type'] ) : 'video/mp4';
$poster_url = '';
if ( ! empty( $poster['ID'] ) ) {
	$original   = wp_get_original_image_url( $poster['ID'] );
	$poster_url = esc_url( $original ?: $poster['url'] );
}
?>

<style>
#<?php echo esc_attr( $uid ); ?>.video-hero {
	position: relative;
	width: 100vw;
	margin-left: calc(50% - 50vw);
	/* --vh-nav is set by the inline script below from the live header height. */
	height: calc(100vh - var(--vh-nav, 66px));
	overflow: hidden;
	background: #000;
	display: block;
}

/* Mobile: match the story slider's portrait aspect (3/4) instead of filling
   the full viewport height — keeps hero proportional to other cards. */
@media (max-width: 767px) {
	#<?php echo esc_attr( $uid ); ?>.video-hero {
		height: auto;
		aspect-ratio: 3 / 4;
	}
}

#<?php echo esc_attr( $uid ); ?> .video-hero__video {
	position: absolute;
	inset: 0;
	width: 100%;
	height: 100%;
	object-fit: cover;
	object-position: center center;
	display: block;
}
</style>

<section
	id="<?php echo esc_attr( $uid ); ?>"
	class="video-hero"
	aria-label="Featured video"
>
	<video
		class="video-hero__video"
		autoplay
		muted
		loop
		playsinline
		preload="auto"
		<?php if ( $poster_url ) : ?>poster="<?php echo $poster_url; ?>"<?php endif; ?>
	>
		<source src="<?php echo $video_url; ?>" type="<?php echo $mime; ?>">
	</video>
</section>

<script>
(function () {
	var hero = document.getElementById('<?php echo esc_js( $uid ); ?>');
	if (!hero) return;

	function measure() {
		var header = document.querySelector('header');
		var h = header ? Math.round(header.getBoundingClientRect().height) : 0;
		hero.style.setProperty('--vh-nav', h + 'px');
	}

	measure();
	window.addEventListener('resize', measure);
	window.addEventListener('orientationchange', measure);

	// Track header size changes (e.g. mobile menu open, scroll-shrink).
	if (typeof ResizeObserver !== 'undefined') {
		var header = document.querySelector('header');
		if (header) new ResizeObserver(measure).observe(header);
	}
})();
</script>

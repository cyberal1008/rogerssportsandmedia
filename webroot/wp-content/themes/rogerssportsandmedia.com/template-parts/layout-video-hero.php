<?php
/**
 * Flexible Layout: Video Hero
 *
 * Full-bleed video sized to (viewport height - site nav height) on every
 * breakpoint. Uses object-fit: cover so the video keeps its native aspect
 * ratio and crops to the container instead of stretching.
 */

$video        = get_sub_field( 'video_file' );
$video_mobile = get_sub_field( 'video_file_mobile' );
$poster       = get_sub_field( 'poster' );

if ( empty( $video['url'] ) ) {
	return;
}

$uid        = uniqid( 'vhero_' );
$video_url  = esc_url( $video['url'] );
$mime       = ! empty( $video['mime_type'] ) ? esc_attr( $video['mime_type'] ) : 'video/mp4';

$video_url_mobile = ! empty( $video_mobile['url'] ) ? esc_url( $video_mobile['url'] ) : '';
$mime_mobile      = ! empty( $video_mobile['mime_type'] ) ? esc_attr( $video_mobile['mime_type'] ) : 'video/mp4';

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
		preload="metadata"
		data-src="<?php echo $video_url; ?>"
		data-type="<?php echo $mime; ?>"
		<?php if ( $video_url_mobile ) : ?>data-src-mobile="<?php echo $video_url_mobile; ?>" data-type-mobile="<?php echo $mime_mobile; ?>"<?php endif; ?>
		<?php if ( $poster_url ) : ?>poster="<?php echo $poster_url; ?>"<?php endif; ?>
	>
		<noscript><source src="<?php echo $video_url; ?>" type="<?php echo $mime; ?>"></noscript>
	</video>
</section>

<script>
(function () {
	var hero = document.getElementById('<?php echo esc_js( $uid ); ?>');
	if (!hero) return;

	// Load the video source via JS so the (large) file isn't fetched until we
	// know the device + connection. On phones we use the lighter mobile file
	// when provided, and on data-saver / very slow links we skip the video
	// entirely and leave the poster image in place.
	(function loadVideo() {
		var v = hero.querySelector('.video-hero__video');
		if (!v || v.dataset.loaded) return;

		var conn = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
		if (conn && (conn.saveData || /(^|-)2g$/.test(conn.effectiveType || ''))) {
			return; // honour Data Saver / 2G — poster only, no heavy download
		}

		var isMobile = window.matchMedia('(max-width: 767px)').matches;
		var src  = (isMobile && v.dataset.srcMobile)  ? v.dataset.srcMobile  : v.dataset.src;
		var type = (isMobile && v.dataset.typeMobile) ? v.dataset.typeMobile : v.dataset.type;
		if (!src) return;

		var source = document.createElement('source');
		source.src = src;
		source.type = type;
		v.appendChild(source);
		v.dataset.loaded = '1';
		v.load();

		var p = v.play();
		if (p && p.catch) { p.catch(function () {}); } // ignore autoplay rejection; poster stays
	})();

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

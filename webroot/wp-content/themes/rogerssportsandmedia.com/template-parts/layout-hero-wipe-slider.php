<?php
/**
 * Flexible Layout: Hero Wipe Slider
 *
 * Can be called directly from page_flexible.php (hero_wipe_slider layout)
 * or delegated to from layout-hero.php when component_type = wipe_slider.
 * Each slide uses hero_image (desktop) + hero_mobile_image (mobile).
 */

// Accept slides passed as args (from layout-hero.php) or fetch from ACF sub_field
$slides = $args['slides'] ?? get_sub_field( 'slider_images' );

if ( empty( $slides ) ) {
	return;
}

$uid            = uniqid( 'hws_' );
$has_any_mobile = ! empty( array_filter( $slides, fn( $s ) => ! empty( $s['hero_mobile_image'] ) ) );
?>

<style>
.hws {
	position: relative;
	width: 100%;
	aspect-ratio: 32 / 15;
	background: #000;
	overflow: hidden;
}

.hws__slide {
	position: absolute;
	inset: 0;
	transform-origin: bottom left;
	transform: scale(0);
	opacity: 0;
	will-change: transform, opacity;
}

.hws__slide-inner {
	position: absolute;
	inset: 0;
	background-image: var(--img-desktop);
	background-size: cover;
	background-position: center center;
	transform-origin: center center;
	transform: scale(1);
}

/* Mobile: swap to desktop image, cover by default */
@media (max-width: 767px) {
	.hws {
		aspect-ratio: 16 / 9;
	}
	.hws__slide-inner {
		background-image: var(--img-desktop);
		background-size: cover;
	}
	/* When a dedicated mobile image is set, show it in full without cropping */
	.hws__slide--has-mobile .hws__slide-inner {
		background-image: var(--img-mobile);
		background-size: contain;
		background-repeat: no-repeat;
	}
	.hws.hws--has-mobile {
		aspect-ratio: unset;
		height: 100vw;
	}
}

.hws__black {
	position: absolute;
	inset: 0;
	background: #000;
	transform-origin: bottom left;
	transform: scale(0);
	pointer-events: none;
}

.hws__strip {
	position: absolute;
	inset: 0;
	background: rgba(0, 0, 0, 0.5);
	pointer-events: none;
	opacity: 0;
}

@keyframes hws-bl-scale-in {
	0%   { transform: scale(0.05); opacity: 0; }
	10%  { opacity: 1; }
	100% { transform: scale(1.0);  opacity: 1; }
}

@keyframes hws-center-zoom {
	from { transform: scale(1.0); }
	to   { transform: scale(1.05); }
}

@keyframes hws-black-in {
	0%   { transform: scale(0.05); }
	100% { transform: scale(1.0); }
}

@property --t-eat {
	syntax: '<number>';
	inherits: false;
	initial-value: 0;
}

@keyframes hws-black-eat {
	from { --t-eat: 0; }
	to   { --t-eat: 1; }
}

.hws__slide.enter {
	transform: scale(1);
	opacity: 1;
}

.hws__slide.enter .hws__slide-inner {
	animation: hws-center-zoom var(--t-zoom) ease-in-out forwards;
}

.hws__black.wipe {
	animation: hws-black-in var(--t-scale) linear forwards;
}

.hws__black.unwipe {
	--t-pct: calc(var(--t-eat) * 100%);
	--inv-pct: calc((1 - var(--t-eat)) * 100%);
	--fe: min(140px, var(--t-pct), var(--inv-pct));
	transform: scale(1);
	clip-path: polygon(
		0 0, 100% 0, 100% 100%,
		calc(var(--t-pct) + var(--fe)) 100%,
		calc(var(--t-pct) + var(--fe)) calc(var(--inv-pct) - var(--fe)),
		0 calc(var(--inv-pct) - var(--fe))
	);
	animation: hws-black-eat var(--t-scale) linear forwards;
}

.hws__strip.unwipe {
	--t-pct: calc(var(--t-eat) * 100%);
	--inv-pct: calc((1 - var(--t-eat)) * 100%);
	opacity: 1;
	clip-path: polygon(
		0 0, 100% 0, 100% 100%,
		var(--t-pct) 100%,
		var(--t-pct) var(--inv-pct),
		0 var(--inv-pct)
	);
	animation: hws-black-eat var(--t-scale) linear forwards;
}

/* Shared overlays — siblings of .hws__black, not inside each slide */
.hws__logos {
	position: absolute;
	bottom: 28px;
	right: 28px;
	z-index: 9999;
	display: flex;
	align-items: center;
	gap: 12px;
	opacity: 0;
	transition: opacity 0.35s ease;
	pointer-events: none;
}

.hws__logos img {
	display: block;
	max-height: 84px;
	max-width: 240px;
	width: auto;
	object-fit: contain;
}

.hws__logos.visible {
	opacity: 1;
}

.hws__button {
	position: absolute;
	bottom: 28px;
	left: 28px;
	z-index: 9999;
	opacity: 0;
	transition: opacity 0.35s ease;
}

.hws__button a {
	display: inline-block;
	padding: 10px 28px;
	border: 2px solid #fff;
	color: #fff;
	text-decoration: none;
	font-size: 14px;
	font-weight: 600;
	letter-spacing: 0.04em;
	white-space: nowrap;
}

.hws__button a:hover {
	background: #fff;
	color: #000;
}

.hws__button.visible {
	opacity: 1;
}
</style>

<section class="hws<?php echo $has_any_mobile ? ' hws--has-mobile' : ''; ?>" id="<?php echo esc_attr( $uid ); ?>" style="--t-scale: 1s; --t-zoom: 4.3s;">

	<?php foreach ( $slides as $slide ) :
		$desktop          = $slide['hero_image']        ?? null;
		$mobile           = $slide['hero_mobile_image'] ?? null;
		$logos_raw        = is_array( $slide['logos'] ?? null ) ? $slide['logos'] : [];
		$button           = $slide['button']            ?? null;
		$button_arialabel = $slide['button_arialabel']  ?? '';

		if ( empty( $desktop ) ) continue;

		$desktop_url = esc_url( $desktop['url'] );
		$mobile_url  = $mobile ? esc_url( $mobile['url'] ) : null;
		$alt         = esc_attr( $desktop['alt'] ?? '' );
		$slide_class = $mobile ? ' hws__slide--has-mobile' : '';

		$btn_data = $button ? [
			'url'    => $button['url'],
			'title'  => $button['title'],
			'target' => $button['target'] ?: '_self',
			'aria'   => $button_arialabel ?: $button['title'],
		] : null;

		$logos_data = array_values( array_filter( array_map(
			fn( $i ) => isset( $i['logo']['url'] ) ? [ 'url' => $i['logo']['url'], 'alt' => $i['logo']['alt'] ?? '' ] : null,
			$logos_raw
		) ) );
	?>
	<div class="hws__slide<?php echo $slide_class; ?>"
	     data-button="<?php echo esc_attr( wp_json_encode( $btn_data ) ); ?>"
	     data-logos="<?php echo esc_attr( wp_json_encode( $logos_data ) ); ?>">
		<div class="hws__slide-inner"
		     style="--img-desktop: url('<?php echo $desktop_url; ?>');<?php echo $mobile_url ? " --img-mobile: url('{$mobile_url}');" : ''; ?>"
		     role="img" aria-label="<?php echo $alt; ?>"></div>
	</div>
	<?php endforeach; ?>

	<div class="hws__black"></div>
	<div class="hws__strip"></div>
	<div class="hws__button"></div>
	<div class="hws__logos"></div>

</section>

<script>
(function () {
	var hws = document.getElementById('<?php echo esc_js( $uid ); ?>');
	if ( ! hws ) return;

	var black   = hws.querySelector('.hws__black');
	var strip   = hws.querySelector('.hws__strip');
	var btnEl   = hws.querySelector('.hws__button');
	var logosEl = hws.querySelector('.hws__logos');
	var slides  = Array.from(hws.querySelectorAll('.hws__slide'));
	if ( slides.length < 2 ) return;

	var style      = getComputedStyle(hws);
	var tScale     = parseFloat(style.getPropertyValue('--t-scale')) * 1000;
	var tZoom      = parseFloat(style.getPropertyValue('--t-zoom'))  * 1000;
	var layer = 10;
	var PAD        = 28;
	var overlayEls = [btnEl, logosEl];
	var contactBtn = document.getElementById('advertise-btn');

	// ── Populate overlays from active slide data attributes ──────────
	function updateOverlays(slide) {
		var btnData   = JSON.parse(slide.dataset.button || 'null');
		var logosData = JSON.parse(slide.dataset.logos  || '[]');

		// Button
		while (btnEl.firstChild) { btnEl.removeChild(btnEl.firstChild); }
		if (btnData && btnData.url) {
			var a = document.createElement('a');
			a.href = btnData.url;
			a.setAttribute('aria-label', btnData.aria);
			a.target = btnData.target;
			a.textContent = btnData.title;
			btnEl.appendChild(a);
			btnEl.style.display = '';
		} else {
			btnEl.style.display = 'none';
		}

		// Logos
		while (logosEl.firstChild) { logosEl.removeChild(logosEl.firstChild); }
		if (logosData.length) {
			logosData.forEach(function (l) {
				var img = document.createElement('img');
				img.src = l.url;
				img.alt = l.alt;
				logosEl.appendChild(img);
			});
			logosEl.style.display = '';
		} else {
			logosEl.style.display = 'none';
		}
	}

	// ── Keep overlays above the fold when hero extends below it ──────
	function positionOverlays() {
		var rect      = hws.getBoundingClientRect();
		var offScreen = rect.bottom <= 0 || rect.top >= window.innerHeight;

		// Hide the floating contact button while the hero is on screen
		if (contactBtn) {
			contactBtn.style.display = (window.innerHeight - rect.bottom >= 100) ? 'block' : 'none';
		}

		overlayEls.forEach(function (el) {
			el.style.visibility = offScreen ? 'hidden' : '';
		});

		if (offScreen) return;

		if (rect.bottom > window.innerHeight) {
			// Hero bottom below fold — fix overlays to viewport
			btnEl.style.position = 'fixed';
			btnEl.style.bottom   = PAD + 'px';
			btnEl.style.left     = (rect.left + PAD) + 'px';
			btnEl.style.right    = '';

			logosEl.style.position = 'fixed';
			logosEl.style.bottom   = PAD + 'px';
			logosEl.style.right    = (window.innerWidth - rect.right + PAD) + 'px';
			logosEl.style.left     = '';
		} else {
			// Hero bottom in view — restore to absolute within container
			btnEl.style.position = '';
			btnEl.style.bottom   = '';
			btnEl.style.left     = '';

			logosEl.style.position = '';
			logosEl.style.bottom   = '';
			logosEl.style.right    = '';
		}
	}

	window.addEventListener('scroll', positionOverlays, { passive: true });
	window.addEventListener('resize', positionOverlays);
	// Override any load-time show from the parent theme's header script
	window.addEventListener('load', positionOverlays);

	// ── Animation loop ────────────────────────────────────────────────
	function reset(el) {
		el.classList.remove('enter', 'wipe', 'unwipe');
		void el.offsetWidth;
	}

	// One cycle: hold for holdTime (zoom playing), wipe-in over current slide,
	// place next slide underneath, wipe-out to reveal it, recurse.
	function runCycle(index, isFirst) {
		var slide = slides[index];

		if (isFirst) {
			layer += 2;
			slide.style.zIndex = layer;
			reset(slide);
			slide.classList.add('enter');
			updateOverlays(slide);
			positionOverlays();

			setTimeout(function () {
				overlayEls.forEach(function (el) { el.classList.add('visible'); });
			}, 100);
		} else {
			// Slide was entered tScale ago (when prev wipe-out started); just show overlays
			overlayEls.forEach(function (el) { el.classList.add('visible'); });
		}

		// Time remaining until zoom completes / wipe-in should start
		var holdTime = isFirst ? tZoom : tZoom - tScale;

		setTimeout(function () {
			overlayEls.forEach(function (el) { el.classList.remove('visible'); });
		}, Math.max(holdTime - 350, 100));

		// Wipe-IN: black scales up from bottom-left to cover current slide
		setTimeout(function () {
			black.style.zIndex = layer + 1;
			reset(black);
			black.classList.add('wipe');

			// Once covered, place next slide underneath and wipe-OUT
			setTimeout(function () {
				var nextIndex = (index + 1) % slides.length;
				var nextSlide = slides[nextIndex];

				layer += 2;
				nextSlide.style.zIndex = layer;
				reset(nextSlide);
				nextSlide.classList.add('enter');
				updateOverlays(nextSlide);
				positionOverlays();

				// Keep black above the new slide for the reveal
				black.style.zIndex = layer + 1;
				reset(black);
				// Snap to fully-covering before unwipe so scale animates from 1, not 0
				black.style.transform = 'scale(1)';
				void black.offsetWidth;
				black.style.transform = '';
				black.classList.add('unwipe');

				// Half-opacity strip ahead of the cut, sibling so it isn't clipped by black's clip-path
				strip.style.zIndex = layer + 1;
				reset(strip);
				strip.classList.add('unwipe');

				// Clean up the old slide while black retreats
				setTimeout(function () {
					slide.classList.remove('enter');
					slide.style.zIndex = '';
				}, tScale + 50);

				// Continue with the just-revealed slide
				setTimeout(function () {
					runCycle(nextIndex, false);
				}, tScale);
			}, tScale);
		}, holdTime);
	}

	runCycle(0, true);
})();
</script>

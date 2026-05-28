<?php
/**
 * Flexible Layout: Story Slider
 *
 */

$eyebrow_prefix       = get_sub_field( 'eyebrow_prefix' ) ?: 'STORY';
$autoplay_ms          = (int) ( get_sub_field( 'autoplay_ms' ) ?: 6000 );
$select_label         = get_sub_field( 'select_label' ) ?: 'Select A Story';
$background_color     = get_sub_field( 'background_color' );
$section_title        = get_sub_field( 'section_title' );
$section_title_color  = get_sub_field( 'section_title_color' ) ?: '#ffffff';
$slides               = get_sub_field( 'slides' );

if ( empty( $slides ) ) {
	return;
}

$uid   = uniqid( 'sts_' );
$total = count( $slides );
?>

<style>
#<?php echo esc_attr( $uid ); ?>.story-slider,
#<?php echo esc_attr( $uid ); ?>.story-slider * {
	box-sizing: border-box;
}

#<?php echo esc_attr( $uid ); ?>.story-slider {
	--sts-peek-px: clamp(56px, 7vw, 120px);
	--sts-radius: clamp(28px, 2.6vw, 48px);
	--sts-nav-h: clamp(44px, 4.5vw, 64px);
	position: relative;
	width: 100%;
	margin: 0 auto;
	color: #fff;
	font-family: inherit;
	isolation: isolate;
	padding-top: calc(var(--sts-nav-h) / 2);
	padding-bottom: calc(var(--sts-nav-h) / 2);
	opacity: 0;
	transition: opacity 0.3s ease;
}

#<?php echo esc_attr( $uid ); ?>.story-slider.is-ready {
	opacity: 1;
}

#<?php echo esc_attr( $uid ); ?> .story-slider__swiper {
	position: relative;
	width: 100%;
	height: auto;
	aspect-ratio: 32 / 13;
	min-height: 440px;
	max-height: 70vh;
	overflow: hidden;
}

#<?php echo esc_attr( $uid ); ?> .story-slider__swiper .swiper-wrapper {
	align-items: stretch;
	height: 100%;
	min-height: inherit;
}

#<?php echo esc_attr( $uid ); ?> .story-slider__slide {
	position: relative;
	width: calc(100% - var(--sts-peek-px) * 2);
	height: auto;
	align-self: stretch;
	border-radius: var(--sts-radius);
	overflow: hidden;
	transition: filter 0.45s ease;
	filter: brightness(0.35);
}

#<?php echo esc_attr( $uid ); ?> .story-slider__slide.swiper-slide-active {
	filter: brightness(1);
}

#<?php echo esc_attr( $uid ); ?> .story-slider__bg {
	position: absolute;
	inset: 0;
	background-image: var(--sts-bg-desktop);
	background-size: cover;
	background-position: center top;
	background-repeat: no-repeat;
	z-index: 1;
}

#<?php echo esc_attr( $uid ); ?> .story-slider__overlay {
	position: absolute;
	inset: 0;
	background:
		linear-gradient(90deg, rgba(0,0,0,0.92) 0%, rgba(0,0,0,0.4) 22%, rgba(0,0,0,0.15) 52%, rgba(0,0,0,0.02) 82%, rgba(0,0,0,0) 100%),
		linear-gradient(180deg, rgba(0,0,0,0) 55%, rgba(0,0,0,0.55) 100%);
	z-index: 2;
}

#<?php echo esc_attr( $uid ); ?> .story-slider__inner {
	position: relative;
	z-index: 3;
	display: grid;
	grid-template-columns: minmax(0, 1.2fr) minmax(0, 1fr);
	gap: clamp(24px, 5vw, 80px);
	align-items: center;
	height: 100%;
	padding: clamp(24px, 5vw, 72px) clamp(16px, 2.5vw, 36px);
	max-width: 1600px;
	margin: 0 auto;
	opacity: 0;
	pointer-events: none;
}

#<?php echo esc_attr( $uid ); ?> .swiper-slide-active .story-slider__inner {
	opacity: 1;
	pointer-events: auto;
}

/* Staggered fade-in for text elements once the slide has finished centering */
#<?php echo esc_attr( $uid ); ?> .story-slider__slide .story-slider__eyebrow,
#<?php echo esc_attr( $uid ); ?> .story-slider__slide .story-slider__title,
#<?php echo esc_attr( $uid ); ?> .story-slider__slide .story-slider__body,
#<?php echo esc_attr( $uid ); ?> .story-slider__slide .story-slider__cta,
#<?php echo esc_attr( $uid ); ?> .story-slider__slide .story-slider__counter {
	opacity: 0;
	transition: opacity 0s;
}

#<?php echo esc_attr( $uid ); ?> .story-slider__slide.swiper-slide-active .story-slider__eyebrow {
	opacity: 1;
	transition: opacity 0.5s ease 0.1s;
}
#<?php echo esc_attr( $uid ); ?> .story-slider__slide.swiper-slide-active .story-slider__title {
	opacity: 1;
	transition: opacity 0.5s ease 0.25s;
}
#<?php echo esc_attr( $uid ); ?> .story-slider__slide.swiper-slide-active .story-slider__body {
	opacity: 1;
	transition: opacity 0.5s ease 0.4s;
}
#<?php echo esc_attr( $uid ); ?> .story-slider__slide.swiper-slide-active .story-slider__cta {
	opacity: 1;
	transition: opacity 0.5s ease 0.55s;
}
#<?php echo esc_attr( $uid ); ?> .story-slider__slide.swiper-slide-active .story-slider__counter {
	opacity: 1;
	transition: opacity 0.6s ease 0.7s;
}

@media (prefers-reduced-motion: reduce) {
	#<?php echo esc_attr( $uid ); ?> .story-slider__slide .story-slider__eyebrow,
	#<?php echo esc_attr( $uid ); ?> .story-slider__slide .story-slider__title,
	#<?php echo esc_attr( $uid ); ?> .story-slider__slide .story-slider__body,
	#<?php echo esc_attr( $uid ); ?> .story-slider__slide .story-slider__cta,
	#<?php echo esc_attr( $uid ); ?> .story-slider__slide .story-slider__counter {
		transition: none !important;
	}
	#<?php echo esc_attr( $uid ); ?> .story-slider__slide.swiper-slide-active .story-slider__eyebrow,
	#<?php echo esc_attr( $uid ); ?> .story-slider__slide.swiper-slide-active .story-slider__title,
	#<?php echo esc_attr( $uid ); ?> .story-slider__slide.swiper-slide-active .story-slider__body,
	#<?php echo esc_attr( $uid ); ?> .story-slider__slide.swiper-slide-active .story-slider__cta,
	#<?php echo esc_attr( $uid ); ?> .story-slider__slide.swiper-slide-active .story-slider__counter {
		opacity: 1;
	}
}

#<?php echo esc_attr( $uid ); ?> .story-slider__text {
	max-width: 640px;
	display: flex;
	flex-direction: column;
	gap: clamp(6px, 0.8vw, 12px);
}

#<?php echo esc_attr( $uid ); ?> .story-slider__eyebrow {
	font-size: clamp(12px, 1vw, 14px);
	letter-spacing: 0.18em;
	font-weight: 600;
	text-transform: uppercase;
	line-height: 1.1;
	opacity: 1;
}

#<?php echo esc_attr( $uid ); ?> .story-slider__title {
	font-size: clamp(34px, 4.4vw, 64px);
	font-weight: 700;
	line-height: 1.1;
	letter-spacing: -0.015em;
	text-transform: uppercase;
	margin: 0;
	color: #fff;
	text-shadow: 0 2px 16px rgba(0, 0, 0, 0.5);
	-webkit-text-stroke: 1.2px #fff;
	paint-order: stroke fill;
	opacity: 1;
}

#<?php echo esc_attr( $uid ); ?> .story-slider__body {
	font-size: clamp(15px, 1.1vw, 18px);
	font-weight: 600;
	line-height: 1.1;
	opacity: 1;
	max-width: 56ch;
}

#<?php echo esc_attr( $uid ); ?> .story-slider__cta {
	align-self: flex-start;
	display: inline-block;
	padding: 12px 28px;
	margin-top: 4px;
	border: 2px solid #fff;
	color: #fff;
	text-decoration: none;
	font-size: 14px;
	font-weight: 600;
	letter-spacing: 0.04em;
	line-height: 1.1;
	white-space: nowrap;
	transition: background-color 0.2s ease, color 0.2s ease;
}

#<?php echo esc_attr( $uid ); ?> .story-slider__cta:hover,
#<?php echo esc_attr( $uid ); ?> .story-slider__cta:focus-visible {
	background-color: #fff;
	color: #000;
}

#<?php echo esc_attr( $uid ); ?> .story-slider__counter {
	justify-self: end;
	width: min(100%, 380px);
	padding: clamp(24px, 2.5vw, 36px);
	border-radius: 24px;
	background: rgba(20, 20, 20, 0.55);
	backdrop-filter: blur(12px);
	-webkit-backdrop-filter: blur(12px);
	border: 1px solid rgba(255, 255, 255, 0.08);
	text-align: center;
	display: flex;
	flex-direction: column;
	align-items: center;
	gap: 12px;
}

#<?php echo esc_attr( $uid ); ?> .story-slider__counter-figure {
	display: inline-flex;
	align-items: flex-start;
	font-weight: 600;
	font-size: clamp(48px, 6vw, 84px);
	line-height: 1;
	letter-spacing: -0.02em;
	opacity: 1;
	margin-bottom: 0;
}

#<?php echo esc_attr( $uid ); ?> .story-slider__counter-prefix,
#<?php echo esc_attr( $uid ); ?> .story-slider__counter-num,
#<?php echo esc_attr( $uid ); ?> .story-slider__counter-suffix {
	font-size: 1em;
	line-height: 1;
	-webkit-text-stroke: 2.2px #fff;
	paint-order: stroke fill;
}

#<?php echo esc_attr( $uid ); ?> .story-slider__counter-prefix {
	margin-right: 0.02em;
}

#<?php echo esc_attr( $uid ); ?> .story-slider__counter-suffix {
	margin-left: 0.02em;
	vertical-align: baseline;
	top: 0;
}

#<?php echo esc_attr( $uid ); ?> .story-slider__counter-numblock {
	display: inline-flex;
	flex-direction: column;
	align-items: stretch;
	line-height: 1;
}


#<?php echo esc_attr( $uid ); ?> .story-slider__counter-unit {
	font-size: clamp(12px, 1.5vw, 20px);
	letter-spacing: 0.18em;
	font-weight: 600;
	text-transform: uppercase;
	opacity: 1;
	line-height: 1.1;
	text-align: center;
	margin-top: -6px;
	-webkit-text-stroke: 1.2px #fff;
	paint-order: stroke fill;
}

#<?php echo esc_attr( $uid ); ?> .story-slider__counter-desc {
	font-size: clamp(13px, 0.95vw, 15px);
	font-weight: 600;
	line-height: 1.1;
	opacity: 1;
	max-width: 32ch;
}

/* Arrows */
#<?php echo esc_attr( $uid ); ?> .story-slider__arrow {
	position: absolute;
	top: 50%;
	z-index: 5;
	width: 48px;
	height: 48px;
	border-radius: 50%;
	border: 1px solid transparent;
	background: transparent;
	color: #fff;
	cursor: pointer;
	display: inline-flex;
	align-items: center;
	justify-content: center;
	padding: 0;
	transition: background-color 0.2s ease, border-color 0.2s ease;
}

#<?php echo esc_attr( $uid ); ?> .story-slider__arrow svg {
	width: 22px;
	height: 22px;
	transition: transform 0.2s ease;
}

#<?php echo esc_attr( $uid ); ?> .story-slider__arrow:hover,
#<?php echo esc_attr( $uid ); ?> .story-slider__arrow:focus-visible {
	background: rgba(0, 0, 0, 0.55);
	border-color: #fff;
}

#<?php echo esc_attr( $uid ); ?> .story-slider__arrow:hover svg,
#<?php echo esc_attr( $uid ); ?> .story-slider__arrow:focus-visible svg {
	transform: scale(1.1);
}

#<?php echo esc_attr( $uid ); ?> .story-slider__arrow--prev {
	left: calc(var(--sts-peek-px) / 2);
	transform: translate(-50%, -50%);
}

#<?php echo esc_attr( $uid ); ?> .story-slider__arrow--next {
	right: calc(var(--sts-peek-px) / 2);
	transform: translate(50%, -50%);
}

#<?php echo esc_attr( $uid ); ?> .sr-only {
	position: absolute;
	width: 1px;
	height: 1px;
	padding: 0;
	margin: -1px;
	overflow: hidden;
	clip: rect(0, 0, 0, 0);
	white-space: nowrap;
	border: 0;
}

/* Tablet */
@media (max-width: 1023px) {
	#<?php echo esc_attr( $uid ); ?>.story-slider {
		--sts-peek-px: clamp(40px, 6vw, 80px);
	}
	#<?php echo esc_attr( $uid ); ?> .story-slider__swiper {
		aspect-ratio: 4 / 5;
		min-height: 0;
	}
	#<?php echo esc_attr( $uid ); ?> .story-slider__inner {
		grid-template-columns: 1fr;
		gap: clamp(20px, 4vw, 40px);
		align-content: center;
		justify-items: center;
		text-align: center;
	}
	#<?php echo esc_attr( $uid ); ?> .story-slider__text { align-items: center; }
	#<?php echo esc_attr( $uid ); ?> .story-slider__body { text-align: center; }
	#<?php echo esc_attr( $uid ); ?> .story-slider__counter { justify-self: center; }
}

/* Mobile: portrait card, full image height, peek + spacing kept */
@media (max-width: 767px) {
	#<?php echo esc_attr( $uid ); ?> .story-slider__swiper {
		aspect-ratio: 3 / 4;
		min-height: 0;
		/* Drop the desktop 70vh cap on mobile — iOS Safari's inconsistent
		   vh handling can clip the slide shorter than the aspect ratio
		   wants, cropping the bottom of the background image. */
		max-height: none;
	}
	#<?php echo esc_attr( $uid ); ?> .story-slider__bg { background-image: var(--sts-bg-mobile); }
	#<?php echo esc_attr( $uid ); ?> .story-slider__overlay {
		background: linear-gradient(180deg, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.4) 30%, rgba(0,0,0,0) 50%, rgba(0,0,0,0) 100%);
	}
	#<?php echo esc_attr( $uid ); ?> .story-slider__arrow { display: none; }
	#<?php echo esc_attr( $uid ); ?> .story-slider__counter { display: none; }
	#<?php echo esc_attr( $uid ); ?> .story-slider__inner {
		align-content: start;
		align-items: start;
		justify-items: start;
		text-align: left;
	}
	#<?php echo esc_attr( $uid ); ?> .story-slider__text { align-items: flex-start; }
	#<?php echo esc_attr( $uid ); ?> .story-slider__body { text-align: center; align-self: stretch; }
	#<?php echo esc_attr( $uid ); ?> .story-slider__title { text-align: center; align-self: stretch; }
}

@media (prefers-reduced-motion: reduce) {
	#<?php echo esc_attr( $uid ); ?> .swiper-wrapper { transition: none !important; }
}
</style>

<section
	class="story-slider<?php echo $total < 2 ? ' story-slider--single' : ''; ?>"
	id="<?php echo esc_attr( $uid ); ?>"
	role="region"
	aria-roledescription="carousel"
	aria-label="Story slider"
	<?php if ( $background_color ) : ?>style="background-color: <?php echo esc_attr( $background_color ); ?>;"<?php endif; ?>
>
	<?php if ( $section_title ) : ?>
		<h2 class="flex-section-title" style="color: <?php echo esc_attr( $section_title_color ); ?>;"><?php echo esc_html( $section_title ); ?></h2>
	<?php endif; ?>
	<div class="swiper story-slider__swiper">
		<div class="swiper-wrapper">
			<?php foreach ( $slides as $i => $slide ) :
				$index_human = $i + 1;
				$eyebrow     = ! empty( $slide['eyebrow_override'] )
					? $slide['eyebrow_override']
					: sprintf( '%s %02d', $eyebrow_prefix, $index_human );

				$title       = $slide['title'] ?? '';
				$body        = $slide['body'] ?? '';
				$button      = $slide['button'] ?? null;
				$image       = $slide['image'] ?? null;
				$mobile      = $slide['mobile_image'] ?? null;

				$title_size   = isset( $slide['title_size'] ) && $slide['title_size'] !== '' ? (int) $slide['title_size'] : 0;
				$body_size    = isset( $slide['body_size'] ) && $slide['body_size'] !== '' ? (int) $slide['body_size'] : 0;
				$eyebrow_size = isset( $slide['eyebrow_size'] ) && $slide['eyebrow_size'] !== '' ? (int) $slide['eyebrow_size'] : 0;
				$text_width   = isset( $slide['text_max_width'] ) && $slide['text_max_width'] !== '' ? (int) $slide['text_max_width'] : 0;

				$title_style   = $title_size   ? 'font-size:' . $title_size . 'px;' : '';
				$body_style    = $body_size    ? 'font-size:' . $body_size . 'px;' : '';
				$eyebrow_style = $eyebrow_size ? 'font-size:' . $eyebrow_size . 'px;' : '';
				$text_style    = $text_width   ? 'max-width:' . $text_width . 'px;' : '';

				$stat_prefix = $slide['stat_prefix'] ?? '';
				$stat_number = $slide['stat_number'] ?? '';
				$stat_suffix = $slide['stat_suffix'] ?? '';
				$stat_unit   = $slide['stat_unit'] ?? '';
				$stat_desc   = $slide['stat_description'] ?? '';

				$has_stat = $stat_number !== '' || $stat_prefix !== '' || $stat_unit !== '' || $stat_desc !== '';

				if ( empty( $image ) ) {
					continue;
				}

				// Prefer the un-scaled original (bypasses WP's 2560px auto-scale cap)
				// so slider backgrounds stay crisp on Retina displays.
				$desktop_raw = ! empty( $image['ID'] )  ? wp_get_original_image_url( $image['ID'] )  : '';
				$mobile_raw  = ! empty( $mobile['ID'] ) ? wp_get_original_image_url( $mobile['ID'] ) : '';

				$desktop_url = esc_url( $desktop_raw ?: $image['url'] );
				$mobile_url  = ! empty( $mobile['url'] )
					? esc_url( $mobile_raw ?: $mobile['url'] )
					: $desktop_url;
				$alt         = esc_attr( $image['alt'] ?? '' );
			?>
			<div
				class="swiper-slide story-slider__slide"
				role="group"
				aria-roledescription="slide"
				aria-label="<?php echo esc_attr( sprintf( '%d of %d', $index_human, $total ) ); ?>"
				style="--sts-bg-desktop: url('<?php echo $desktop_url; ?>'); --sts-bg-mobile: url('<?php echo $mobile_url; ?>');"
			>
				<div class="story-slider__bg" role="img" aria-label="<?php echo $alt; ?>"></div>
				<div class="story-slider__overlay" aria-hidden="true"></div>

				<div class="story-slider__inner">
					<div class="story-slider__text"<?php echo $text_style ? ' style="' . esc_attr( $text_style ) . '"' : ''; ?>>
						<div class="story-slider__eyebrow"<?php echo $eyebrow_style ? ' style="' . esc_attr( $eyebrow_style ) . '"' : ''; ?>><?php echo esc_html( $eyebrow ); ?></div>
						<h2 class="story-slider__title"<?php echo $title_style ? ' style="' . esc_attr( $title_style ) . '"' : ''; ?>><?php echo esc_html( $title ); ?></h2>
						<div class="story-slider__body"<?php echo $body_style ? ' style="' . esc_attr( $body_style ) . '"' : ''; ?>><?php echo wp_kses_post( $body ); ?></div>

						<?php if ( ! empty( $button['url'] ) ) : ?>
							<a
								class="story-slider__cta"
								href="<?php echo esc_url( $button['url'] ); ?>"
								target="<?php echo esc_attr( $button['target'] ?: '_self' ); ?>"
								<?php echo ( $button['target'] ?? '' ) === '_blank' ? 'rel="noopener noreferrer"' : ''; ?>
							><?php echo esc_html( $button['title'] ?: 'Read more' ); ?></a>
						<?php endif; ?>
					</div>

					<?php if ( $has_stat ) : ?>
					<aside class="story-slider__counter" aria-label="Stat callout">
						<div class="story-slider__counter-figure">
							<?php if ( $stat_prefix !== '' ) : ?>
								<span class="story-slider__counter-prefix"><?php echo esc_html( $stat_prefix ); ?></span>
							<?php endif; ?>
							<span class="story-slider__counter-numblock">
								<span
									class="story-slider__counter-num"
									data-target="<?php echo esc_attr( $stat_number ); ?>"
								><?php echo esc_html( $stat_number ); ?></span>
							</span>
							<?php if ( $stat_suffix !== '' ) : ?>
								<span class="story-slider__counter-suffix"><?php echo esc_html( $stat_suffix ); ?></span>
							<?php endif; ?>
						</div>
						<?php if ( $stat_unit !== '' ) : ?>
							<div class="story-slider__counter-unit"><?php echo esc_html( $stat_unit ); ?></div>
						<?php endif; ?>
						<?php if ( $stat_desc !== '' ) : ?>
							<div class="story-slider__counter-desc"><?php echo wp_kses_post( $stat_desc ); ?></div>
						<?php endif; ?>
					</aside>
					<?php endif; ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>

		<?php if ( $total > 1 ) : ?>
			<button class="story-slider__arrow story-slider__arrow--prev" type="button" aria-label="Previous slide">
				<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M15 6l-6 6 6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
			</button>
			<button class="story-slider__arrow story-slider__arrow--next" type="button" aria-label="Next slide">
				<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M9 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
			</button>
		<?php endif; ?>
	</div>

	<div class="story-slider__live sr-only" aria-live="polite"></div>
</section>

<script>
(function () {
	var root = document.getElementById('<?php echo esc_js( $uid ); ?>');
	if (!root) return;

	function reveal() { root.classList.add('is-ready'); }

	function whenSwiperReady(cb) {
		if (typeof window.Swiper !== 'undefined') { cb(); return; }
		if (document.readyState === 'complete') {
			reveal();
			return;
		}
		window.addEventListener('load', function () {
			if (typeof window.Swiper !== 'undefined') cb();
			else reveal();
		});
	}

	whenSwiperReady(init);

	function init() {
	var swiperEl   = root.querySelector('.story-slider__swiper');
	var prevBtn    = root.querySelector('.story-slider__arrow--prev');
	var nextBtn    = root.querySelector('.story-slider__arrow--next');
	var liveRgn    = root.querySelector('.story-slider__live');
	var autoplayMs = <?php echo (int) $autoplay_ms; ?>;
	var total      = <?php echo (int) $total; ?>;
	var reduce     = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var hasBeenVisible = false;

	function resetCountersIn(scope) {
		if (!scope) return;
		scope.querySelectorAll('.story-slider__counter-num').forEach(function (node) {
			var original = node.getAttribute('data-target') || node.textContent;
			var target = parseTarget(original);
			if (!isNaN(target)) node.textContent = formatNum(0, original);
		});
	}

	resetCountersIn(root);

	var instance = new Swiper(swiperEl, {
		slidesPerView: 'auto',
		centeredSlides: true,
		loop: total > 1,
		spaceBetween: 16,
		speed: 700,
		watchSlidesProgress: true,
		grabCursor: true,
		a11y: { enabled: true },
		keyboard: { enabled: true, onlyInViewport: true },
		autoplay: !reduce && total > 1 ? {
			delay: autoplayMs,
			disableOnInteraction: false,
			pauseOnMouseEnter: true
		} : false,
		navigation: total > 1 ? {
			nextEl: nextBtn,
			prevEl: prevBtn
		} : false,
		pagination: false,
		breakpoints: {
			0:    { spaceBetween: 14 },
			768:  { spaceBetween: 14 },
			1024: { spaceBetween: 18 }
		},
		on: {
			init: function () {
				reveal();
				announce(this);
			},
			slideChange: function () {
				announce(this);
				var active = this.slides[this.activeIndex];
				if (active) {
					resetCountersIn(active);
					if (hasBeenVisible) runCounterAfterFade(active);
				}
			}
		}
	});

	// Run the counter only once the slider scrolls into view, and wait for
	// the stat card to finish fading in before starting the count.
	function runCounterAfterFade(slide) {
		if (!slide) return;
		var counter = slide.querySelector('.story-slider__counter');
		if (!counter) { runCounter(slide); return; }

		var op = parseFloat(getComputedStyle(counter).opacity || '0');
		if (op >= 0.99) { runCounter(slide); return; }

		var done = false;
		var finish = function () {
			if (done) return;
			done = true;
			counter.removeEventListener('transitionend', handler);
			runCounter(slide);
		};
		var handler = function (e) {
			if (e.propertyName !== 'opacity' || e.target !== counter) return;
			finish();
		};
		counter.addEventListener('transitionend', handler);
		// Fallback: CSS fade is delay 0.7s + duration 0.6s = 1.3s; use 1500ms buffer.
		setTimeout(finish, 1500);
	}

	function markVisibleAndRun() {
		if (hasBeenVisible) return;
		hasBeenVisible = true;
		runCounterAfterFade(instance.slides[instance.activeIndex]);
	}

	if ('IntersectionObserver' in window) {
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					markVisibleAndRun();
					io.disconnect();
				}
			});
		}, { threshold: 0.1, rootMargin: '0px 0px -10% 0px' });
		io.observe(root);
	} else {
		markVisibleAndRun();
	}

	function announce(sw) {
		if (!liveRgn) return;
		var slide = sw.slides[sw.activeIndex];
		if (!slide) return;
		var title = slide.querySelector('.story-slider__title');
		var label = 'Slide ' + (sw.realIndex + 1) + ' of ' + total;
		if (title) label += ': ' + title.textContent.trim();
		liveRgn.textContent = label;
	}

	function parseTarget(str) {
		if (str === null || str === undefined || str === '') return NaN;
		var cleaned = String(str).replace(/,/g, '').trim();
		if (!/^-?\d+(\.\d+)?$/.test(cleaned)) return NaN;
		return parseFloat(cleaned);
	}

	function formatNum(n, originalStr) {
		var str      = String(originalStr).trim();
		var hasComma = str.indexOf(',') !== -1;
		var dotIdx   = str.indexOf('.');
		var decimals = dotIdx === -1 ? 0 : str.length - dotIdx - 1;
		if (hasComma) {
			return n.toLocaleString('en-US', {
				minimumFractionDigits: decimals,
				maximumFractionDigits: decimals
			});
		}
		return decimals > 0 ? n.toFixed(decimals) : String(Math.round(n));
	}

	function runCounter(slide) {
		if (!slide) return;
		var nodes = slide.querySelectorAll('.story-slider__counter-num');
		nodes.forEach(function (node) {
			var original = node.getAttribute('data-target') || node.textContent;
			var target   = parseTarget(original);

			if (isNaN(target)) {
				node.textContent = original;
				return;
			}

			if (reduce) {
				node.textContent = formatNum(target, original);
				return;
			}

			var duration = 1200;
			var startTs  = null;

			function step(ts) {
				if (startTs === null) startTs = ts;
				var t = Math.min(1, (ts - startTs) / duration);
				var eased = 1 - Math.pow(1 - t, 3);
				node.textContent = formatNum(target * eased, original);
				if (t < 1) window.requestAnimationFrame(step);
				else node.textContent = formatNum(target, original);
			}
			window.requestAnimationFrame(step);
		});
	}
	} // end init
})();
</script>

<?php
/**
 * Floating right-rail dot navigator for flexible page sections.
 * Desktop only (≥1024px). Pairs with .flex-section wrappers emitted by
 * page_flexible.php.
 */

// Sections is the ordered list of flex-section numbers to render dots for
// (skips non-navigable layouts like spacing). Falls back to a sequential
// range if the caller still passes the legacy `count` arg.
if ( isset( $args['sections'] ) && is_array( $args['sections'] ) ) {
	$sections = array_values( array_map( 'intval', $args['sections'] ) );
} elseif ( isset( $args['count'] ) ) {
	$sections = range( 1, (int) $args['count'] );
} else {
	$sections = array();
}

if ( count( $sections ) < 2 ) {
	return;
}
?>

<style>
.flex-section-nav {
	display: none;
}

@media (min-width: 1024px) {
	.flex-section-nav {
		display: flex;
		flex-direction: column;
		gap: 16px;
		position: fixed;
		top: 50%;
		right: 18px;
		transform: translateY(-50%);
		z-index: 999;
		padding: 14px 10px;
		pointer-events: auto;
		background: rgba(20, 20, 20, 0.45);
		backdrop-filter: blur(12px) saturate(140%);
		-webkit-backdrop-filter: blur(12px) saturate(140%);
		border: 1px solid rgba(255, 255, 255, 0.12);
		border-radius: 999px;
		box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
	}

	.flex-section-nav__dot {
		appearance: none;
		display: block;
		width: 11px;
		height: 11px;
		padding: 0;
		border-radius: 50%;
		border: 1.5px solid rgba(255, 255, 255, 0.9);
		background: transparent;
		cursor: pointer;
		transition: background-color 0.25s ease, transform 0.25s ease, border-color 0.25s ease;
	}

	.flex-section-nav__dot:hover,
	.flex-section-nav__dot:focus-visible {
		background: rgba(255, 255, 255, 0.55);
		outline: none;
		transform: scale(1.15);
	}

	.flex-section-nav__dot.is-active {
		background: #fff;
		border-color: #fff;
		transform: scale(1.2);
	}

	.flex-section {
		scroll-margin-top: var(--flex-nav-offset, 106px);
	}
}
</style>

<nav class="flex-section-nav" aria-label="Page sections">
	<?php foreach ( $sections as $index => $section_num ) : $human = $index + 1; ?>
		<button
			type="button"
			class="flex-section-nav__dot"
			data-target="flex-section-<?php echo (int) $section_num; ?>"
			aria-label="Go to section <?php echo (int) $human; ?>"
		></button>
	<?php endforeach; ?>
</nav>

<script>
(function () {
	var nav = document.querySelector('.flex-section-nav');
	if (!nav) return;

	var dots = Array.prototype.slice.call(nav.querySelectorAll('.flex-section-nav__dot'));
	var sections = dots
		.map(function (dot) { return document.getElementById(dot.getAttribute('data-target')); })
		.filter(Boolean);
	if (!sections.length) return;

	function navOffset() {
		var header = document.querySelector('header');
		return header ? Math.round(header.getBoundingClientRect().height) : 0;
	}

	function syncOffset() {
		document.documentElement.style.setProperty('--flex-nav-offset', navOffset() + 'px');
	}
	syncOffset();
	window.addEventListener('resize', syncOffset);
	if (typeof ResizeObserver !== 'undefined') {
		var header = document.querySelector('header');
		if (header) new ResizeObserver(syncOffset).observe(header);
	}

	dots.forEach(function (dot, idx) {
		dot.addEventListener('click', function () {
			var target = sections[idx];
			if (!target) return;
			var y = target.getBoundingClientRect().top + window.pageYOffset - navOffset();
			window.scrollTo({ top: y, behavior: 'smooth' });
		});
	});

	function setActive(idx) {
		dots.forEach(function (d, i) { d.classList.toggle('is-active', i === idx); });
	}

	// Use a thin horizontal band near the top of the viewport (just under the
	// nav) to decide which section is "current". The most-recently-crossed
	// section wins.
	function update() {
		var probeY = navOffset() + 8;
		var activeIdx = 0;
		for (var i = 0; i < sections.length; i++) {
			var rect = sections[i].getBoundingClientRect();
			if (rect.top <= probeY) activeIdx = i;
		}
		setActive(activeIdx);
	}

	update();
	window.addEventListener('scroll', update, { passive: true });
	window.addEventListener('resize', update);
})();
</script>

<?php
/**
 * Template Name: Out of Home
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/favicon.png" />
    <title><?php echo get_the_title(); ?> | Rogers Sports & Media</title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.css">
</head>
<?php get_header(); ?>

<!-- SKIP -->
<a role="banner" href="#content" class="skip-to-content button" aria-label="Skip to main content" tabindex="0">Skip to main content</a>

<main id="content" role="main">

	<!-- HERO -->
	<?php
	get_template_part(
		'template-parts/section-hero', null,
		array(
			'subtitle'		=> 'What We Do',
			'title'     => $hero_title ? $hero_title : get_the_title(),
		)
	);
	?>

	<!-- ANCHORS -->
	<section class="anchors desktop">
		<div class="wrapper">
			<div class="anchor-list">
				<a href="#our-difference" aria-label="The RSM Difference">The RSM Difference</a>
				<a href="#solutions" aria-label="Solutions">Solutions</a>
				<a href="#highlights" aria-label="Highlights">Highlights</a>
				<a href="#trends" aria-label="What's Happening">What's Happening</a>
				<a href="#partner" aria-label="Partner With Us">Partner With Us</a>
			</div>
		</div>
	</section>

	<!-- INTRO -->
	<?php
	$intro_title = get_field('intro_title');
	$intro_content = get_field('intro_content');
	?>
	<section class="our-difference alt nomargin">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/semicircles-red.svg" alt="decorative red semicircles" class="deco top-left">
		<div class="wrapper">
			<div class="topblock">
				<?php if ($intro_title) : ?>
					<h2 class="title"><?php echo $intro_title; ?></h2>
				<?php endif; ?>
				<?php echo $intro_content; ?>
			</div>
		</div>
	</section>

	<!-- ICON COLUMNS - ACCORDIONS -->
	<?php
	get_template_part(
		'template-parts/section-icon-columns-accordions', null,
		array(
			'deco'   => array(
				'url' => get_stylesheet_directory_uri() . '/assets/home/images/diamond-dots-green.svg',
				'class'    => 'deco top-right',
				'alt'     => 'decorative green diamond beside dot pattern'
			),
		)
	);
	?>

	<!-- SOLUTIONS -->
	<?php
	if( have_rows('solutions') ) : 
		$sol_section_title = get_field('sol_section_title');
		?>
		<section id="solutions" class="solutions">
			<div class="inner wrapper">
				<?php if ($sol_section_title) : ?>
					<h2 class="title"><?php echo $sol_section_title; ?></h2>
				<?php endif; ?>

				<div class="swiper sol-slider">
					<div class="swiper-wrapper grid two">
						
						<?php while( have_rows('solutions') ) : the_row(); 
							$image = get_sub_field('image');
							$title = get_sub_field('title');
							$content = get_sub_field('content');
							?>
							<div class="swiper-slide">
								<div class="item">
									<?php if ($image) : ?>
										<div class="imgbox">
											<img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>"  loading="lazy">
										</div>
									<?php endif; ?>
									<div class="txtbox">
										<?php if ($title) : ?>
											<p class="name"><?php echo $title; ?></p>
										<?php endif; ?>
										<?php echo $content; ?>
									</div>
								</div>
							</div>
						<?php endwhile; ?>

					</div>
					<div class="swiper-pagination"></div>
				</div>

			</div>
		</section>
	<?php endif; ?>

	<!-- HIGHLIGHTS -->
	<?php if( have_rows('highlights') ) : ?>
		<section id="highlights" class="stat-rows">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/square-lines-yellow.svg" alt="yellow square beside decorative diagonal lines" class="deco" loading="lazy">
			<div class="wrapper">
				<?php while( have_rows('highlights') ) : the_row(); 
					$large_text = get_sub_field('large_text');
					$underline_color = get_sub_field('underline_color');
					$small_text = get_sub_field('small_text');
					$large_text_location = get_sub_field('large_text_location');
					?>
					<div class="stat-row">
						<p class="stat <?php echo $large_text_location == 'top' ? '' : 'alt'; ?>">
							<?php if ($large_text_location == 'top') : ?>
							<span class="focus <?php echo $underline_color; ?>"><?php echo $large_text; ?></span>
							<span class="desc"><?php echo $small_text; ?></span>
						<?php else : ?>
							<span class="desc"><?php echo $small_text; ?></span>
							<span class="focus <?php echo $underline_color; ?>"><?php echo $large_text; ?></span>
						<?php endif; ?>
						</p>
					</div>
				<?php endwhile; ?>
			</div>
		</section>
	<?php endif; ?>

	<!-- WHAT'S HAPPENING -->
	<?php
	get_template_part(
		'template-parts/section-whats-happening', null,
		array(
			'zone'		=> 'whats-happening-ooh',
			'class'     => '',
		)
	);
	?>

	<!-- PARTNER -->
	<?php get_template_part('template-parts/section-partner'); ?>
</main>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>
<?php
get_footer();
?>
</html>
<?php

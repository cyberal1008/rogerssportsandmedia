<?php
/**
 * Template Name: Disney Plus
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
	<style>
		@media (min-width: 1024px) {
			.grid.four {
				grid-template-columns:repeat(4,1fr) !important;
			}
		}
	</style>
</head>
<?php
	get_header();
?>

<!-- SKIP -->
<a role="banner" href="#content" class="skip-to-content button" aria-label="Skip to main content" tabindex="0">Skip to main content</a>

<main id="content" role="main">

	<!-- HERO -->
	<?php
	if (is_category()) : 
		$term = get_queried_object();
		$hero_image = get_field('hero_image', $term);
		$hero_mobile_image = get_field('hero_mobile_image', $term);
	else : 
		$hero_image = get_field('hero_image');
		$hero_mobile_image = get_field('hero_mobile_image');
	endif; 
	?>
	<section class="hero">
		<picture>
			<source srcset="<?php echo $hero_image['url']; ?>"
					media="(min-width: 640px)">
			<img src="<?php echo $hero_mobile_image['url']; ?>" class="bg" alt="<?php echo $hero_image['alt']; ?>" />
		</picture>
	</section>

	<!-- INTRO -->
	<?php
		$intro_title = get_field('intro_title');
		$intro_content = get_field('intro_content');
	?>
	<section class="our-difference alt nomargin">
		<div class="wrapper">
			<div class="top">
				<?php if ($intro_title) : ?>
					<h2 class="title"><?php echo $intro_title; ?></h2>
				<?php endif; ?>
				<?php echo $intro_content; ?>
			</div>
		</div>
	</section>


	<!-- COUNTERS -->
	<?php if( have_rows('highlights') ) : ?>
		<section id="highlights" class="highlights">
			<div class="wrapper">
				<div class="grid four circle-stats">
					<?php while( have_rows('highlights') ) : the_row(); 
						$number = get_sub_field('number');
						$number_text = get_sub_field('number_text');
						$text = get_sub_field('text');
						$circle_color = get_sub_field('circle_color');
						?>
						<div class="item">
							<?php if ($number) : ?> 
								<div class="stat <?php echo $circle_color ? $circle_color : ''; ?>">
									<span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span>
									<?php if ($number_text) : ?>
										<span class="sign bold"><?php echo $number_text; ?></span>
									<?php endif; ?>
								</div>
							<?php endif; ?>
							<?php if ($text) : ?>
								<p class="desc"><?php echo $text; ?></p>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>
</main>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>
<?php
get_footer();
?>
</html>
<?php

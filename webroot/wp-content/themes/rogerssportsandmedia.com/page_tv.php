<?php
/**
 * Template Name: TV
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
<?php
get_header();
global $post;
$page_meta = get_post_meta( $post->ID, RSM\Broadcast\PageMeta::METADATA_SLUG, true );
?>

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

	<section class="anchors desktop">
		<div class="wrapper">
			<div class="anchor-list">
				<a href="#highlights" aria-label="Highlights">Highlights</a>
				<a href="#featured" aria-label="Featured Products">Featured Products</a>
				<a href="#programming" aria-label="Programming">Programming</a>
				<a href="#trends" aria-label="What's Happening">What's Happening</a>
				<a href="#partner" aria-label="Partner With Us">Partner With Us</a>
			</div>
		</div>
	</section>

	<!-- INTRO -->
	<?php
	$intro_title = get_field('intro_title');
	$intro_content = get_field('intro_content');
	$brands_logos = get_field('brands_logos');
	?>
	<section class="our-difference alt nomargin">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/curve-green1.svg" alt="curved green line" class="deco btm-left">
		<div class="wrapper">
			<div class="top">
				<?php if ($intro_title) : ?>
					<h2 class="title"><?php echo $intro_title; ?></h2>
				<?php endif; ?>
				<?php echo $intro_content; ?>
			</div>
			<?php if ($brands_logos) : ?>
				<div class="swiper logo-slider">
					<div class="swiper-wrapper">
						<?php foreach ($brands_logos as $logo) : ?>
							<div class="swiper-slide">
								<img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
							</div>
						<?php endforeach; ?>
					</div>
					<div class="swiper-pagination"></div>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- COUNTERS -->
	<?php if( have_rows('highlights') ) : ?>
		<section id="highlights" class="highlights">
			<div class="wrapper">
				<div class="grid circle-stats">
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

	<!-- STRETCH BOXES-->
	<?php
	$tv_section_button = get_field('tv_section_button');
	?>
	<section id="featured" class="stretchboxes">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/triangles-green.svg" class="deco" alt="green decorative triangles" loading="lazy">
		<div class="inner wrapper">

			<?php if( have_rows('tv_left_box') ) : while( have_rows('tv_left_box') ) : the_row(); 
				$image = get_sub_field('bg_image');
				$title = get_sub_field('title');
				$description = get_sub_field('description');
				$link = get_sub_field('boxlink');
				?>
				<div class="box left">
					<div tabindex="0" class="boxlink" aria-label="<?php echo $link['title'] ? $link['title'] : 'Learn More'; ?>"></div>
					<?php if ($image) : ?>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="bg">
					<?php endif; ?>
					<div class="txt">
						<?php if ($title) : ?>
							<p class="title"><?php echo $title; ?></p>
						<?php endif; ?>
						<p class="hover">Hover for Details</p>
						<?php if ($description) : ?>
							<p class="desc"><?php echo $description; ?></p>
						<?php endif; ?>
						<span class="lined white mobile" aria-label="Learn More about <?php echo $title; ?>">Learn More</span>
					</div>
				</div>
			<?php endwhile; endif; ?>

			<?php if( have_rows('tv_right_box') ) : while( have_rows('tv_right_box') ) : the_row(); 
				$image = get_sub_field('bg_image');
				$title = get_sub_field('title');
				$description = get_sub_field('description');
				$link = get_sub_field('boxlink');
				?>
				<div class="box right">
					<div tabindex="0" class="boxlink" aria-label="<?php echo $link['title'] ? $link['title'] : 'Learn More'; ?>"></div>
					<?php if ($image) : ?>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="bg">
					<?php endif; ?>
					<div class="txt">
						<?php if ($title) : ?>
							<p class="title"><?php echo $title; ?></p>
						<?php endif; ?>
						<p class="hover">Hover for Details</p>
						<?php if ($description) : ?>
							<p class="desc"><?php echo $description; ?></p>
						<?php endif; ?>
						<span class="lined white mobile" aria-label="Learn More about <?php echo $title; ?>">Learn More</span>
					</div>
				</div>
			<?php endwhile; endif; ?>

		</div>
		<?php if ($tv_section_button) : ?>
			<div class="btn-wrap wrapper">
				<a href="<?php echo $tv_section_button['url']; ?>" class="button" aria-label="<?php echo $tv_section_button['title'] ? $tv_section_button['title'] : 'Explore Streaming Buyers Guide'; ?>"><?php echo $tv_section_button['title'] ? $tv_section_button['title'] : 'Explore Streaming Buyers Guide'; ?></a>
			</div>
		<?php endif; ?>
	</section>

	<!-- PROGRAMMING -->
	<?php
	$prog_section_title = get_field('program_section_title');
	$prog_section_button = get_field('program_section_button');
	?>	
	<section id="programming" class="programming">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/circle-yellow.svg" class="deco" alt="yellow ring decoration" loading="lazy">
		<div class="portfolio-main">
			<div class=" portfolio-page">
				<div class="inner wrapper">

					<div class="top">
						<?php if ($prog_section_title) : ?>
							<h2 class="section-title"><?php echo $prog_section_title; ?></h2>
						<?php endif; ?>
						<?php if ($prog_section_button) : ?>
							<a href="<?php echo $prog_section_button['url']; ?>" class="lined" aria-label="<?php echo $prog_section_button['title'] ? $prog_section_button['title'] : 'Download TV Schedule'; ?>" target="<?php echo $prog_section_button['target'] ? $prog_section_button['target'] : '_self'; ?>"><?php echo $prog_section_button['title'] ? $prog_section_button['title'] : 'Download TV Schedule'; ?></a>
						<?php endif; ?>
					</div>

					<?php
					get_template_part(
						'template-parts/portfolio',
						'program-slider',
						array(
							'page_meta'     => $page_meta,
						)
					);
					?>
				</div>
			</div>
		</div>
	</section>

	<!-- VIDEO SLIDER -->
	<?php get_template_part('template-parts/section-vidslider'); ?>

	<!-- CASE STUDIES -->
	<?php get_template_part('template-parts/section-case-studies'); ?>

	<!-- WHAT'S HAPPENING -->
	<?php
	get_template_part(
		'template-parts/section-whats-happening', null,
		array(
			'zone'		=> 'whats-happening-television',
			'deco'   => array(
				'url' => get_stylesheet_directory_uri() . '/assets/home/images/circle-white.svg',
				'class'    => 'deco',
				'alt'     => 'grey decorative rings'
			),
		)
	);
	?>

	<!-- PARTNER -->
	<?php get_template_part('template-parts/section-partner'); ?>
</main>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>
<?php
get_footer();
?>
</html>
<?php

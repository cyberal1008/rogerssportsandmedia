<?php
/**
 * Template Name: Creative Solutions
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
				<a href="#capabilities" aria-label="Our Capabilities">Our Capabilities</a>
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
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/triangles-green-lines.svg" alt="decorative green triangles on top of diagonal lines" class="deco top-right flush">
		<div class="wrapper">
			<div class="topblock">
				<?php if ($intro_title) : ?>
					<h2 class="title"><?php echo $intro_title; ?></h2>
				<?php endif; ?>
				<?php echo $intro_content; ?>
			</div>
		</div>
	</section>

	<!-- EXPLORE -->
	<?php
	$exp_section_title = get_field('exp_section_title');
	$exp_content = get_field('exp_content');
	$exp_button = get_field('exp_button');
	$exp_button_arialabel = get_field('exp_button_arialabel');
	?>
	<section id="capabilities" class="explore">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/circle-dots-blue-full.svg" class="deco" alt="decorative blue circles next to dot pattern" loading="lazy">
		<div class="wrapper">
			<div class="intro">
				<?php if ($exp_section_title) : ?>
					<h2 class="title"><?php echo $exp_section_title; ?></h2>
				<?php endif; ?>
				<?php echo $exp_content ? $exp_content : ''; ?>
				<?php if ($exp_button) : ?>
					<a href="<?php echo $exp_button['url']; ?>" aria-label="<?php echo $exp_button_arialabel ? $exp_button_arialabel : ''; ?>" class="button"><?php echo $exp_button['title']; ?></a>
				<?php endif; ?>
			</div>

			<!-- DESKTOP -->
			<?php if( have_rows('exp_tabs') ): ?>
				<div class="tabs">
					<div class="tablist" role="tablist" aria-label="">
						<?php while( have_rows('exp_tabs') ): the_row(); $tab_ctr++;
							$title = get_sub_field('title');
							?>
							<button class="trigger exp" role="tab" aria-selected="<?php echo $tab_ctr == 1 ? 'true' : 'false'; ?>" aria-controls="tab-content-<?php echo $tab_ctr; ?>" id="tab-<?php echo $tab_ctr; ?>" tabindex="<?php echo $tab_ctr == 1 ? '' : '-1'; ?>">
								<?php echo $title; ?>
							</button>
						<?php endwhile; ?>
					</div>
					<div class="content">
						<?php while( have_rows('exp_tabs') ): the_row(); $con_ctr++;
							$content = get_sub_field('content');
							$button = get_sub_field('button');
							$button_arialabel = get_sub_field('button_arialabel');
							$media_type = get_sub_field('media_type');
							$image = get_sub_field('image');
							?>
							<div class="tabcontent" tabindex="0" role="tabpanel" id="tab-content-<?php echo $con_ctr; ?>" aria-labelledby="tab-<?php echo $con_ctr; ?>" <?php echo $con_ctr == 1 ? '' : 'hidden'; ?>>
								<?php if ($media_type == 'video') : ?>
									<div class="playbox">
										<a role="button" class="trigger" aria-label=""><i class="icon fa-sharp fa-solid fa-play"></i></a>
										<div class="iframe-wrap">
											<?php $video_embed_code = get_sub_field('video_embed_code'); ?>
											<?php echo $video_embed_code; ?>
										</div>
									</div>
								<?php else : ?>
									<?php if ($image) : ?>
										<img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>">
									<?php endif; ?>
								<?php endif; ?>
								<?php echo $content ? $content : ''; ?>
								<?php if ($button) : ?>
									<a href="<?php echo $button['url']; ?>" class="lined" aria-label="<?php echo $button_arialabel ? $button_arialabel : ''; ?>"><?php echo $button['title'] ? $button['title'] : 'Learn More'; ?></a>
								<?php endif; ?>
							</div>
						<?php endwhile; ?>
					</div>	
				</div>

				<!-- MOBILE -->
				<div class="mobile">
					<?php 
					$mobtab_ctr = 20;
					while( have_rows('exp_tabs') ): the_row(); $mobtab_ctr++;
						$title = get_sub_field('title');
						$content = get_sub_field('content');
						$button = get_sub_field('button');
						$button_arialabel = get_sub_field('button_arialabel');
						$media_type = get_sub_field('media_type');
						$image = get_sub_field('image');
						?>
						<div class="accordion">
							<button class="accordion-trigger" id="accordion-<?php echo $mobtab_ctr; ?>" aria-expanded="false" aria-controls="accordion-<?php echo $mobtab_ctr; ?>-content">
								<?php echo $title; ?>
								<i class="fa-sharp fa-solid fa-plus-large status"></i>
							</button>
							<div class="accordion-content" id="accordion-<?php echo $mobtab_ctr; ?>-content" aria-labelledby="accordion-<?php echo $mobtab_ctr; ?>">
								<?php if ($media_type == 'video') : ?>
									<div class="playbox">
										<a role="button" class="trigger" aria-label=""><i class="icon fa-sharp fa-solid fa-play"></i></a>
										<div class="iframe-wrap">
											<?php $video_embed_code = get_sub_field('video_embed_code'); ?>
											<?php echo $video_embed_code; ?>
										</div>
									</div>
								<?php else : ?>
									<?php if ($image) : ?>
										<img src="<?php echo $image['sizes']['medium_large']; ?>" alt="<?php echo $image['alt']; ?>">
									<?php endif; ?>
								<?php endif; ?>
								<div class="txtbox">
									<?php echo $content ? $content : ''; ?>
									<?php if ($button) : ?>
										<a href="<?php echo $button['url']; ?>" class="lined" aria-label="<?php echo $button_arialabel ? $button_arialabel : ''; ?>"><?php echo $button['title'] ? $button['title'] : 'Learn More'; ?></a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>

		</div>
	</section>

	<!-- HIGHLIGHTS -->
	<?php if( have_rows('highlights') ) : ?>
		<section id="highlights" class="highlights dark">
			<img src="get_stylesheet_directory_uri() . '/assets/home/images/circle-white.svg'" alt="grey decorative rings" class="deco btm" loading="lazy">
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
								<div class="stat thick <?php echo $circle_color ? $circle_color : ''; ?>">
									<span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span>
									<?php if ($number_text) : ?>
										<span class="sign bold"><?php echo $number_text; ?></span>
									<?php endif; ?>
								</div>
							<?php endif; ?>
							<?php if ($text) : ?>
								<p class="desc big"><?php echo $text; ?></p>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>
	

	<!-- WHAT'S HAPPENING -->
	<?php
	get_template_part(
		'template-parts/section-whats-happening', null,
		array(
			'zone'		=> 'whats-happening-creative-solutions',
			'class'     => '',
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

<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>
<?php
get_footer();
?>
</html>
<?php

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
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/reskin-alt.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/custom.css">
</head>
<?php get_header(); ?>

<main id="content" role="main" class="tw-bg-gray">
	<!-- HERO -->
	<?php
		get_template_part(
			'template-parts/section-hero', null,
			array(
				'title' => get_the_title(),
			)
		);
	?>

	<!-- INTRO -->
	<?php
		get_template_part('template-parts/section-intro');
	?>

	<section class="tw-mt-12">
		&nbsp;
	</section>

	<!-- HIGHLIGHTS -->
	<?php if( have_rows('highlights') ) : ?>
		<section id="highlights" class="tw-py-12 tw-px-4 md:tw-px-16 lg:tw-px-32 xl:tw-px-40 2xl:tw-px-96 md:tw-py-28" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/bkg_red_04.png'); background-size: cover; background-position: center;">
			<div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-text-white tw-gap-y-10 md:tw-gap-x-16 tw-mb-6">
				<?php while( have_rows('highlights') ) : the_row();
					$number = get_sub_field('number');
					$number_text = get_sub_field('number_text');
					$text = get_sub_field('text');
				?>
					<div class="tw-full tw-text-center">
						<div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-1" style="-webkit-text-stroke: 2px white;">
							<span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span><?php if ($number_text) : ?><span class="sign bold"><?php echo $number_text; ?></span><?php endif; ?>
						</div>
						<?php if ($text) : ?>
							<div class="tw-text-lg"><?php echo $text; ?></div>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
		</section>
	<?php endif; ?>

	<!-- EXPLORE -->
	<?php
		$exp_section_title = get_field('exp_section_title');
		$exp_content = get_field('exp_content');
		$exp_button = get_field('exp_button');
		$exp_button_arialabel = get_field('exp_button_arialabel');
	?>
	<section id="capabilities" class="explore">
		<div class="wrapper">
			<div>
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
						<?php $tab_ctr = 0; while( have_rows('exp_tabs') ): the_row(); $tab_ctr++;
							$title = get_sub_field('title');
						?>
							<button class="trigger exp" style="font-family: var(--body-font); text-transform: none;" role="tab" aria-selected="<?php echo $tab_ctr == 1 ? 'true' : 'false'; ?>" aria-controls="tab-content-<?php echo $tab_ctr; ?>" id="tab-<?php echo $tab_ctr; ?>" tabindex="<?php echo $tab_ctr == 1 ? '' : '-1'; ?>">
								<?php echo $title; ?>
							</button>
						<?php endwhile; ?>
					</div>
					<div class="content">
						<?php $con_ctr = 0; while( have_rows('exp_tabs') ): the_row(); $con_ctr++;
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
							<button class="accordion-trigger" style="font-family: var(--body-font); text-transform: none;" id="accordion-<?php echo $mobtab_ctr; ?>" aria-expanded="false" aria-controls="accordion-<?php echo $mobtab_ctr; ?>-content">
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
	
	<section class="tw-bg-white">

		<!-- PARTNER -->
		<?php get_template_part('template-parts/section-partner'); ?>
	</section>
</main>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>
<?php
get_footer();
?>
</html>
<?php
